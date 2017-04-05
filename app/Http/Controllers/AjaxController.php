<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Http\Requests\Ajax\DeleteMultipleRequest;
use App\Traits\UploadableTrait;
use Illuminate\Http\Request;
use Exception;
use Log;
use DB;

class AjaxController extends Controller
{
    use UploadableTrait;

    public $compactsAjax;

    public function __construct(Request $request)
    {
        if (! $request->ajax()) {
            return $this->responseData(__('message.danger.ajax'), false);
        }
    }

    private function getModel($modelname = '')
    {
        switch ($modelname) {
            case 'category':
                return new \App\Category;
            case 'user':
                return new \App\User;
            case 'document':
                return new \App\Document;
            case 'comment':
                return new \App\Comment;
            default:
                return $modelname;
        }
    }

    public function responseData($message = null, $status = true, $attribute = [])
    {
        if ($attribute) {
            $this->compactsAjax = array_merge($this->compactsAjax, $attribute);
        }

        $message = ($message) ?: __('message.success.ajax');

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $this->compactsAjax,
        ]);
    }

    public function deleteMultiple(DeleteMultipleRequest $request)
    {
        $input = $request->all();
        DB::beginTransaction();

        try {
            $model = $this->getModel($input['objectAjax']);
            $data = $input['dataAjax'];

            if ($input['objectAjax'] == 'category') {
                $categoryImages = $model->select('image')->whereIn('id', $data)->pluck('image')->toArray();
                $subCategories = $model->select('image', 'id')->whereIn('parent', $input['dataAjax'])->get();

                $categoryImages = array_merge($categoryImages, $subCategories->pluck('image')->toArray());

                foreach ($categoryImages as $categoryImage) {
                    $this->destroyFile($categoryImage, $input['objectAjax']);
                }

                $data = array_merge($data, $subCategories->pluck('id')->toArray());
                $comments = $model->getComments($input['dataAjax']);
                app(Comment::class)->remove($comments->pluck('id')->toArray());
            }

            if ($input['objectAjax'] == 'document') {
                $documentFiles = $model->select('file')->whereIn('id', $data)->pluck('image')->toArray();

                foreach ($documentFiles as $documentFile) {
                    $this->destroyFile($documentFile, $input['objectAjax']);
                }
            }

            $model->destroyData($data);
            $this->compactsAjax = $data;
            DB::commit();

            return $this->responseData(trans('message.success.deleteMultiple'));
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();

            return $this->responseData(trans('message.danger.deleteMultiple'), false);
        }
    }
}
