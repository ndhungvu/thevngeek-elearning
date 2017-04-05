<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use JavaScript;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $viewPrefix;

    protected $view;

    protected $compacts;

    protected $model;

    protected $modelName;

    protected $jsVariable;

    protected $itemMessage;

    protected $lang = array(
        'prefix' => 'message.',
        'replacements' => array(),
    );

    protected $notifyInfo;

    public function setup(Model $model)
    {
        if ($model) {
            $this->model = $model;

            $this->modelName = strtolower(class_basename($model));

            $this->itemMessage = trans('message.items.' . $this->modelName);
        }
    }

    public function viewRender($view = null, $data = [])
    {
        $view = $view ?: $this->view;

        $compacts = array_merge($data, $this->compacts);

        return view($this->viewPrefix.$view, $compacts);
    }

    public function trans($str = null, $data = [])
    {
        $replacements = array_merge($data, $this->lang['replacements']);

        return trans($this->lang['prefix'].$str, $replacements);
    }

    public function notify($content = '', $data = [], $level = 'info', $messageLang = 'message')
    {
        return [
            'level' => array_has(config('setting.level'), $level) ? $level : 'info',
            'message' => trans($messageLang . '.' . $level . '.' . $content, $data),
        ];
    }

    public function viewSetup()
    {
        if ($this->modelName) {
            $this->viewPrefix .= $this->modelName . '.';
            $this->compacts['lang'] = $this->trans($this->modelName);
            $this->compacts['itemMessage'] = $this->itemMessage;
            $this->compacts['notify'] = $this->notify('not_items_in_list');
            $this->compacts['searchLang'] = trans('admin/search');
            $this->pushJs();
        }
    }

    public function pushJs($attribute = [])
    {
        $validation = require_once __DIR__ . '/jsValidation.php';
        $ajaxValidation = require_once __DIR__ . '/jsAjaxValidation.php';

        if ($this->modelName == 'document') {
            $this->jsVariable = [
                'documentPage' => array_get($validation, 'documentPage'),
            ];
        } else {
            $this->jsVariable = [
                $this->modelName => array_get($validation, $this->modelName),
            ];
        }

        if ($attribute) {
            $this->jsVariable = array_merge($this->jsVariable, $attribute);
        }

        $this->jsVariable = array_merge($this->jsVariable, [
            'searchPage' => array_get($validation, 'searchPage'),
        ]);

        JavaScript::put($this->jsVariable);
        JavaScript::put(['ajaxMessage' => $ajaxValidation]);
    }

    public function showNotify()
    {
        if (Session::has('level') && Session::has('message')) {
            JavaScript::put([
                'notify' => [
                    'level' => Session::get('level'),
                    'message' => Session::get('message')
                ]
            ]);

            Session::forget('level');
            Session::forget('message');
        }
    }
}
