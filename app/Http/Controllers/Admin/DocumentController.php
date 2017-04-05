<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Filter\DocumentFilters;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\Document\StoreRequest;
use App\Http\Requests\Admin\Document\UpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Traits\UploadableTrait;
use Exception;
use Log;
use JavaScript;

class DocumentController extends AdminController
{
    use UploadableTrait;

    public $dataSelect = ['id', 'name', 'file', 'link', 'status', 'user_id'];

    public $relation = ['user'];

    public function __construct()
    {
        $this->setup(new \App\Document);
        $this->viewSetup();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DocumentFilters $filters)
    {
        try {
            $this->model->dataSelect = $this->dataSelect;
            $this->model->with = $this->relation;
            $this->compacts['documents'] = $this->model->orderBy('created_at')->filter($filters)->paginate(10);
            $this->compacts['searchInput'] = $filters->input();
            $this->compacts['linkFilter'] =  $this->compacts['documents']->appends($this->compacts['searchInput'])->links();
            JavaScript::put([
                'ajaxDeleteVariable' => [
                    'route' => route('deleteMultiple'),
                    'token' => csrf_token(),
                    'object' => $this->modelName,
                ],
            ]);
            $this->showNotify();
            $this->model->with = [];

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
     * @param  \App\Http\Requests\Admin\Document\StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();

        try {
            $attribute = array_only($data, $this->model->getFillable());

            if ($request->hasFile('file')) {
                $attribute['file'] = $this->uploadDocument($request->file);
            }

            $this->model->store(array_merge($attribute, [
                'user_id' => auth()->user()->id,
                'status' => 2,
            ]));

            $this->notifyInfo = [
                'level' => 'success',
                'message' => __('message.success.create', ['item' => $this->itemMessage]),
            ];

            if (isset($data['btnSubmitNew']) && $data['btnSubmitNew'] == 1) {
                return redirect()->route('admin.document.create')->with($this->notifyInfo);
            }

            return redirect()->route('admin.document.index')->with($this->notifyInfo);
        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof QueryException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.create', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.document.create')->with($this->notifyInfo);
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
            $this->model->with = $this->relation;
            $this->compacts['document'] = $this->model->findOrFail($id);

            $this->model->with = [];
            return $this->viewRender(__FUNCTION__);
        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.not_found', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.document.index')->with($this->notifyInfo);
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
            $this->compacts['document'] = $this->model->findOrFail($id);

            return $this->viewRender(__FUNCTION__);
        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.not_found', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.document.index')->with($this->notifyInfo);
            }

            return view('errors.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Document\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $document = $this->model->findOrFail($id);
            $attribute = array_only($request->all(), $this->model->getFillable());

            if ($request->hasFile('file')) {
                if ($document->file) {
                    $this->destroyFile($document->file, $this->modelName);
                }

                $attribute['file'] = $this->uploadDocument($request->file);
            }

            $this->model->edit($document, $attribute);

            $this->notifyInfo = [
                'level' => 'success',
                'message' => __('message.success.update', ['item' => $this->itemMessage]),
            ];

            return redirect()->route('admin.document.index')->with($this->notifyInfo);
        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof QueryException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.update', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.document.edit')->with($this->notifyInfo);
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
            $document = $this->model->findOrFail($id);

            if ($document->file) {
                $this->destroyFile($document->file, $this->modelName);
            }

            $comments = $this->model->getComments($document->id);
            app(Comment::class)->destroyData($comments->pluck('id')->toArray());
            $this->model->remove($document);

            $this->notifyInfo = [
                'level' => 'success',
                'message' => __('message.success.delete', ['item' => $this->itemMessage]),
            ];

            return redirect()->route('admin.document.index')->with($this->notifyInfo);

        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.not_found', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.document.index')->with($this->notifyInfo);
            }

            if ($ex instanceof QueryException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.delete', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.document.index')->with($this->notifyInfo);
            }

            return view('errors.404');
        }
    }
}
