<?php

namespace App\Http\Controllers\Admin;

use App\Filter\CategoryFilters;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use JavaScript;
use App\Traits\UploadableTrait;
use Exception;
use Log;
use Illuminate\Support\Facades\DB;

class CategoryController extends AdminController
{
    use UploadableTrait;

    public $dataSelect = ['id', 'name', 'description', 'image', 'parent'];

    public function __construct()
    {
        $this->setup(new \App\Category);
        $this->viewSetup();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryFilters $filters)
    {
        try {
            $this->model->dataSelect = $this->dataSelect;
            $categories = $this->model->getAll();

            $this->compacts['searchInput'] = $filters->input();
            $this->compacts['parentSearch'] = $categories->pluck('name', 'id')->toArray();
            $this->compacts['categories'] = $this->model->orderBy('created_at')->filter($filters)->paginate(10);
            $this->compacts['linkFilter'] =  $this->compacts['categories']->appends($this->compacts['searchInput'])->links();
            $this->compacts['parents'] = $this->model->getParentCategory($categories);
            JavaScript::put([
                'ajaxDeleteVariable' => [
                    'route' => route('deleteMultiple'),
                    'token' => csrf_token(),
                    'object' => $this->modelName,
                ],
            ]);
            $this->showNotify();

            return $this->viewRender(__FUNCTION__);
        } catch (Exception $ex) {
            Log::error($ex);

            return view('errors.404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $this->compacts['categories'] = $this->model->getAll()->pluck('name', 'id');
            $this->showNotify();

            return $this->viewRender(__FUNCTION__);
        } catch (Exception $ex) {
            Log::error($ex);

            return view('errors.404');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Category\StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();

        try {
            $attribute = array_only($data, $this->model->getFillable());

            if ($request->hasFile('image')) {
                $attribute['image'] = $this->uploadFile($request->image, $this->modelName);
            }

            $this->model->store($attribute);
            $this->notifyInfo = [
                'level' => 'success',
                'message' => __('message.success.create', ['item' => $this->itemMessage]),
            ];

            if (isset($data['btnSubmitNew']) && $data['btnSubmitNew'] == 1) {
                return redirect()->route('admin.category.create')->with($this->notifyInfo);
            }

            return redirect()->route('admin.category.index')->with($this->notifyInfo);
        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof QueryException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.create', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.category.create')->with($this->notifyInfo);
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
            $category = $this->model->findOrFail($id);
            $this->compacts['parent'] = $category->parent ? $this->model->findOrFail($category->parent) : null;
            $this->compacts['category'] = $category;

            return $this->viewRender(__FUNCTION__);

        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.not_found', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.category.index')->with($this->notifyInfo);
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
            $categories = $this->model->getAll();

            $this->compacts['category'] = $categories->where('id', $id)->first();
            $this->compacts['categories'] = $categories->where('id', '<>' , $id)->pluck('name', 'id');

            return $this->viewRender(__FUNCTION__);

        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.not_found', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.category.index')->with($this->notifyInfo);
            }

            return view('errors.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Category\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $category = $this->model->findOrFail($id);
            $attribute = array_only($request->all(), $this->model->getFillable());

            if ($request->hasFile('image')) {
                if ($category->image) {
                    $this->destroyFile($category->image, $this->modelName);
                }

                $attribute['image'] = $this->uploadFile($request->image, $this->modelName);
            }

            $this->model->edit($category, $attribute);
            $this->notifyInfo = [
                'level' => 'success',
                'message' => __('message.success.update', ['item' => $this->itemMessage]),
            ];

            return redirect()->route('admin.category.index')->with($this->notifyInfo);
        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof QueryException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.update', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.category.edit')->with($this->notifyInfo);
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
        DB::beginTransaction();

        try {
            $category = $this->model->findOrFail($id);
            $subCategories = $this->model->where(['parent' => $id])->get();

            foreach ($subCategories as $subCategory) {
                if ($subCategory->image) {
                    $this->destroyFile($subCategory->image, $this->modelName);
                }
            }

            if ($category->image) {
                $this->destroyFile($category->image, $this->modelName);
            }

            $this->model->destroyData($subCategories->pluck('id')->toArray());
            $this->model->remove($category);

            DB::commit();
            $this->notifyInfo = [
                'level' => 'success',
                'message' => __('message.success.delete', ['item' => $this->itemMessage]),
            ];

            return redirect()->route('admin.category.index')->with($this->notifyInfo);

        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();

            if ($ex instanceof ModelNotFoundException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.not_found', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.category.index')->with($this->notifyInfo);
            }

            if ($ex instanceof QueryException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.delete', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.category.index')->with($this->notifyInfo);;
            }

            return view('errors.404');
        }
    }
}
