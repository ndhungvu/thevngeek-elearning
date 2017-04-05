<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\AdminController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Traits\UploadableTrait;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Article\StoreRequest;
use App\Http\Requests\Admin\Article\UpdateRequest;
use Exception;
use Log;
use App\Article;
use App\User;
use App\Category;
use App\ObjectCategory;
use Illuminate\Support\Facades\Auth;

class ArticleController extends AdminController
{
    use UploadableTrait;
    public $dataSelect = ['name', 'description', 'image', 'user_id', 'count_share', 'time_tracking'];

    public function __construct()
    {
        $this->setup(new \App\Article);

        $this->viewPrefix .= $this->modelName . '.';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $status = $request->input('status');

        $articles = Article::select('*');
        if(!empty($keyword)) {
            $articles  = $articles->where('name','LIKE','%'.$keyword.'%')
                                ->orWhere('description','LIKE', '%'.$keyword.'%')
                                ->orWhere('content','LIKE', '%'.$keyword.'%');
        }
        if(!empty($status)) {
            $articles = $articles->where('status','=', $status);
        }

        $articles = $articles->where('is_blog', $this->model::IS_BLOG)->orderBy('created_at', 'DSC')->with('user')->paginate($this->model::LIMIT);
        return view('admins.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trees = Category::getTreesByParent();
        return view('admins.article.create', compact('trees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $attribute = array_only($request->all(), $this->model->getFillable());
            $attribute['user_id'] = Auth::user()->id;
            $attribute['is_sesson'] = $request->is_sesson;
            if ($request->hasFile('image')) {
                $attribute['image'] = $this->uploadFile($request->image, $this->modelName);
            }

            $article = $this->model->store($attribute);
            if(!empty($article)) {
                /*Save ObjectCategories*/
                $categories = $request->categories;
                if(!empty($categories)) {
                    foreach ($categories as $key => $category) {
                        $data['type'] = ObjectCategory::TYPE_ARTICLE;
                        $data['object_id'] = $article->id;
                        $data['category_id'] = $category;
                        app(ObjectCategory::class)->store($data);
                    }
                }
                return redirect()->route('admin.article.index')
                ->with('flashSuccess', trans('message.success.create', ['item' => $this->modelName]));
            }
            
        } catch (Exception $ex) {
            Log::error($ex);
            dd($ex);
            if ($ex instanceof QueryException) {
                return redirect()->route('admin.article.create')
                    ->with('flashError', __('message.danger.create', ['item' => $this->modelName]));
            }

            return view('errors.404');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         try {
            $article = $this->model->findOrFail($id);
            $this->compacts['article'] = $article;

            return $this->viewRender(__FUNCTION__);

        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                return redirect()->route('admin.article.index')
                    ->with('flashError', __('message.danger.not_found', ['item' => $this->itemMessage]));
            }

            return view('errors.404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $article = $this->model::getArticle($id);
            $this->compacts['article'] = $article;

            $trees = Category::getTreesByParent();
            $this->compacts['trees'] = $trees;
            return $this->viewRender(__FUNCTION__);

        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                return redirect()->route('admin.article.index')
                    ->with('flashError', __('message.danger.not_found', ['item' => $this->itemMessage]));
            }

            return view('errors.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $article = $this->model::getArticle($id);
            $attribute = array_only($request->all(), $this->model->getFillable());
            $attribute['user_id'] = Auth::user()->id;
            $attribute['is_sesson'] = $request->is_sesson;

            if ($request->hasFile('image')) {
                if ($article->image) {
                    $this->destroyFile($article->image, $this->modelName);
                }

                $attribute['image'] = $this->uploadFile($request->image, $this->modelName);
            }

            if($this->model->edit($article, $attribute)) {
                /*Delete old ObjectCategories*/
                ObjectCategory::deleteAll($article->ObjectCategories);
                /*Save ObjectCategories*/
                $categories = $request->categories;
                if(!empty($categories)) {
                    foreach ($categories as $key => $category) {
                        $data['type'] = ObjectCategory::TYPE_ARTICLE;
                        $data['object_id'] = $article->id;
                        $data['category_id'] = $category;
                        app(ObjectCategory::class)->store($data);
                    }
                }

                return redirect()->route('admin.article.index')
                ->with('flashSuccess', __('message.success.update', ['item' => $this->itemMessage]));
            }
            
        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof QueryException) {
                return redirect()->route('admin.article.edit')
                    ->with('flashError', __('message.danger.update', ['item' => $this->itemMessage]));
            }

            return view('errors.404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $article = $this->model->findOrFail($id);
            $this->model->remove($article);

            return redirect()->route('admin.article.index')
                ->with('flashSuccess', __('message.success.delete', ['item' => $this->itemMessage]));

        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                return redirect()->route('admin.article.index')
                    ->with('flashError', __('message.danger.not_found', ['item' => $this->itemMessage]));
            }

            if ($ex instanceof QueryException) {
                return redirect()->route('admin.article.edit')
                    ->with('flashError', __('message.danger.delete', ['item' => $this->itemMessage]));
            }

            return view('errors.404');
        }
    }
}
