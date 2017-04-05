<?php

namespace App\Http\Controllers\Admin;

use App\Filter\UserFilters;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Exception;
use Log;
use JavaScript;

class UserController extends AdminController
{
    public $dataSelect = ['id', 'nickname', 'email', 'phone', 'rank', 'role'];

    public function __construct()
    {
        $this->setup(new \App\User);
        $this->viewSetup();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserFilters $filters)
    {
        try {
            $this->model->dataSelect = $this->dataSelect;

            $this->compacts['users'] = $this->model->orderBy('created_at')->filter($filters)->paginate(10);
            $this->compacts['searchInput'] = $filters->input();
            $this->compacts['linkFilter'] =  $this->compacts['users']->appends($this->compacts['searchInput'])->links();
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
     * @param  \App\Http\Requests\Admin\User\StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();

        try {
            $attribute = array_only($data, $this->model->getFillable());

            $this->model->store($attribute);
            $this->notifyInfo = [
                'level' => 'success',
                'message' => __('message.success.create', ['item' => $this->itemMessage]),
            ];

            if (isset($data['btnSubmitNew']) && $data['btnSubmitNew'] == 1) {
                return redirect()->route('admin.user.create')->with($this->notifyInfo);
            }

            return redirect()->route('admin.user.index')->with($this->notifyInfo);
        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof QueryException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.create', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.user.create')->with($this->notifyInfo);
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
            $this->compacts['user'] = $this->model->findOrFail($id);

            return $this->viewRender(__FUNCTION__);

        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.not_found', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.user.index')->with($this->notifyInfo);
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
            $this->compacts['user'] = $this->model->findOrFail($id);

            return $this->viewRender(__FUNCTION__);

        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.not_found', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.user.index')->with($this->notifyInfo);
            }

            return view('errors.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\User\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $user = $this->model->findOrFail($id);
            $attribute = array_only($request->all(), $this->model->getFillable());

            $this->model->edit($user, $attribute);
            $this->notifyInfo = [
                'level' => 'success',
                'message' => __('message.success.update', ['item' => $this->itemMessage]),
            ];

            return redirect()->route('admin.user.index')->with($this->notifyInfo);
        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof QueryException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.update', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.user.edit')->with($this->notifyInfo);
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
            $user = $this->model->findOrFail($id);
            $this->model->remove($user);

            $this->notifyInfo = [
                'level' => 'success',
                'message' => __('message.success.delete', ['item' => $this->itemMessage]),
            ];

            return redirect()->route('admin.user.index')->with($this->notifyInfo);

        } catch (Exception $ex) {
            Log::error($ex);

            if ($ex instanceof ModelNotFoundException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.not_found', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.user.index')->with($this->notifyInfo);
            }

            if ($ex instanceof QueryException) {
                $this->notifyInfo = [
                    'level' => 'danger',
                    'message' => __('message.danger.delete', ['item' => $this->itemMessage]),
                ];

                return redirect()->route('admin.user.index')->with($this->notifyInfo);
            }

            return view('errors.404');
        }
    }
}
