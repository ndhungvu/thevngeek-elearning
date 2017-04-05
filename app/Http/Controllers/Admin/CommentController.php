<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Document;
use App\Filter\CommentFilters;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\Comment\UpdateRequest;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Exception;
use Log;
use JavaScript;

class CommentController extends AdminController
{
    public $dataSelect = ['id', 'content', 'type', 'status', 'object_id', 'user_id'];

    public $relation = ['user'];

    public function __construct()
    {
        $this->setup(new \App\Comment);
        $this->viewSetup();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CommentFilters $filters)
    {
        try {
            $this->model->dataSelect = $this->dataSelect;
            $this->model->with = $this->relation;

            $comments = $this->model->orderBy('created_at')->filter($filters)->paginate(10);
            $objects = $this->model->getRelations($comments);

            $this->compacts['documents'] = $objects['documents'];
            $this->compacts['articles'] = $objects['articles'];
            $this->compacts['comments'] = $comments;
            $this->compacts['users'] = app(User::class)->pluck('nickname', 'id');
            $this->compacts['documentAll'] = app(Document::class)->pluck('name', 'id');
            $this->compacts['articleAll'] = app(Article::class)->pluck('name', 'id');
            $this->compacts['searchInput'] = $filters->input();
            $this->compacts['linkFilter'] =  $this->compacts['comments']->appends($this->compacts['searchInput'])->links();
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $comment = $this->model->findOrFail($id);

            if ($comment->type == 1) {
                $this->compacts['object'] = $this->model->articles($comment->object_id);
            } else {
                $this->compacts['object'] = $this->model->documents($comment->object_id);
            }

            $this->compacts['comment'] = $comment;

            return $this->viewRender(__FUNCTION__);

        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.not_found', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.comment.index')->with($this->notifyInfo);
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
            $comment = $this->model->findOrFail($id);

            if ($comment->type == 1) {
                $this->compacts['object'] = $this->model->articles($comment->object_id);
            } else {
                $this->compacts['object'] = $this->model->documents($comment->object_id);
            }

            $articles = app(Article::class)->pluck('name', 'id');
            $documents = app(Document::class)->pluck('name', 'id');
            $settings = [
                'placeholder_object' => trans('admin/comment.placeholder.object'),
            ];
            JavaScript::put(compact('articles', 'documents','settings'));

            $this->compacts['comment'] = $comment;
            $this->compacts['articles'] = $articles;
            $this->compacts['documents'] = $documents;

            return $this->viewRender(__FUNCTION__);

        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.not_found', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.comment.index')->with($this->notifyInfo);
            }

            return view('errors.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Comment\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $comment = $this->model->findOrFail($id);
            $attribute = array_only($request->all(), $this->model->getFillable());

            $this->model->edit($comment, $attribute);

            $this->notifyInfo = [
                'level' => 'success',
                'message' => __('message.success.update', ['item' => $this->itemMessage]),
            ];

            return redirect()->route('admin.comment.index')->with($this->notifyInfo);
        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof QueryException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.update', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.comment.edit')->with($this->notifyInfo);
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
            $comment = $this->model->findOrFail($id);
            $this->model->remove($comment);

            $this->notifyInfo = [
                'level' => 'success',
                'message' => __('message.success.delete', ['item' => $this->itemMessage]),
            ];

            return redirect()->route('admin.comment.index')->with($this->notifyInfo);
        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.not_found', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.comment.index')->with($this->notifyInfo);
            }

            if ($ex instanceof QueryException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.delete', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.comment.index')->with($this->notifyInfo);
            }

            return view('errors.404');
        }
    }
}
