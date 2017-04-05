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
use App\Question;
use App\Awser;
use App\Category;
use App\ObjectCategory;
use Illuminate\Support\Facades\Auth;
use DB;

class SessonController extends AdminController
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

        $sessons = Article::select('*');
        if(!empty($keyword)) {
            $sessons  = $sessons->where('name','LIKE','%'.$keyword.'%')
                                ->orWhere('description','LIKE', '%'.$keyword.'%')
                                ->orWhere('content','LIKE', '%'.$keyword.'%');
        }
        if(!empty($status)) {
            $sessons = $sessons ->where('status','=', $status);
        }

        $sessons = $sessons->where('is_sesson', $this->model::IS_SESSON)->orderBy('created_at', 'DSC')->with('user')->paginate($this->model::LIMIT);

        return view('admins.sesson.index', compact('sessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trees = Category::getTreesByParent();
        return view('admins.sesson.create', compact('trees'));
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
            $attribute['is_blog'] = $request->is_blog;

            if ($request->hasFile('image')) {
                $attribute['image'] = $this->uploadFile($request->image, $this->modelName);
            }

            $sesson = $this->model->store($attribute);
            if(!empty($sesson)) {
                /*Save ObjectCategories*/
                $categories = $request->categories;
                if(!empty($categories)) {
                    foreach ($categories as $key => $category) {
                        $data['type'] = ObjectCategory::TYPE_ARTICLE;
                        $data['object_id'] = $sesson->id;
                        $data['category_id'] = $category;
                        app(ObjectCategory::class)->store($data);
                    }
                }
                return redirect()->route('admin.sesson.index')
                ->with('flashSuccess', trans('message.success.create', ['item' => $this->modelName]));
            }
        } catch (Exception $ex) {
            Log::error($ex);
            dd($ex);
            if ($ex instanceof QueryException) {
                return redirect()->route('admin.sesson.create')
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
            $sesson = $this->model->findOrFail($id);
            return view('admins.sesson.show', compact('sesson'));

        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                return redirect()->route('admin.sesson.index')
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
            $sesson = $this->model->findOrFail($id);
            $trees = Category::getTreesByParent();
            return view('admins.sesson.edit', compact('sesson', 'trees'));

        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                return redirect()->route('admin.sesson.index')
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
            $sesson = $this->model->findOrFail($id);
            $attribute = array_only($request->all(), $this->model->getFillable());
            $attribute['user_id'] = Auth::user()->id;
            $attribute['is_blog'] = $request->is_blog;

            if ($request->hasFile('image')) {
                if ($sesson->image) {
                    $this->destroyFile($sesson->image, $this->modelName);
                }

                $attribute['image'] = $this->uploadFile($request->image, $this->modelName);
            }

            if($this->model->edit($sesson, $attribute)) {
                /*Delete old ObjectCategories*/
                ObjectCategory::deleteAll($sesson->ObjectCategories);
                /*Save ObjectCategories*/
                $categories = $request->categories;
                if(!empty($categories)) {
                    foreach ($categories as $key => $category) {
                        $data['type'] = ObjectCategory::TYPE_ARTICLE;
                        $data['object_id'] = $sesson->id;
                        $data['category_id'] = $category;
                        app(ObjectCategory::class)->store($data);
                    }
                }

                return redirect()->route('admin.sesson.index')
                ->with('flashSuccess', __('message.success.update', ['item' => $this->itemMessage]));
            }
            
        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof QueryException) {
                return redirect()->route('admin.sesson.edit')
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
            $sesson = $this->model->findOrFail($id);
            $this->model->remove($sesson);

            return redirect()->route('admin.sesson.index')
                ->with('flashSuccess', __('message.success.delete', ['item' => $this->itemMessage]));

        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                return redirect()->route('admin.sesson.index')
                    ->with('flashError', __('message.danger.not_found', ['item' => $this->itemMessage]));
            }

            if ($ex instanceof QueryException) {
                return redirect()->route('admin.sesson.edit')
                    ->with('flashError', __('message.danger.delete', ['item' => $this->itemMessage]));
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
    public function getQuestion(Request $request, $id)
    {
         try {
            $sesson = $this->model::getArticle($id);
            if($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'data' => $sesson,
                    'message'=> 'Get sesson is successful!'
                ], 200);
            }
            return view('admins.sesson.question', compact('sesson'));

        } catch (Exception $ex) {
            Log::error($ex);
            if ($ex instanceof ModelNotFoundException) {
                return redirect()->route('admin.sesson.index')
                    ->with('flashError', __('message.danger.not_found', ['item' => $this->itemMessage]));
            }

            return view('errors.404');
        }
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postQuestion(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            /*Delete old questions*/
            $oldQuestions = Question::getQuestionsByArticleID($id);
            if(!empty($oldQuestions)) {
                Question::deleteAll($oldQuestions);
            }
            $contents = $request->content;
            $descriptions = $request->description;
            $isCorrects = $request->is_correct;
            $awsers = $request->awnser;

            if(!empty($contents)) {
                foreach ($contents as $key => $content) {
                    /*Save question*/
                    $question = new Question();
                    $question->content = $content;
                    $question->description = $descriptions[$key];
                    $question->article_id = $id;

                    if($question->save()) {
                        /*Save awser*/
                        if(!empty($awsers[$key])) {
                            foreach ($awsers[$key] as $k => $content) {
                                $awser = new Awser();
                                $awser->content = $content;
                                $awser->question_id = $question->id;
                                $awser->is_correct = $isCorrects[$key][$k];
                                $awser->save();
                            }
                        }
                    }
                }
            }
            DB::commit();
            
            return redirect()->route('admin.sesson.question', $id)->with('flashSuccess','Save question is success.');

           
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();
            if ($ex instanceof QueryException) {
                return redirect()->route('admin.question')
                    ->with('flashError', __('message.danger.update', ['item' => $this->itemMessage]));
            }

            return view('errors.404');
        }
    }
}
