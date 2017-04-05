<?php

namespace App\Http\Requests\Admin\Document;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'alias' => 'required|max:255',
            'description' => 'max:255',
            'file' => 'mimes:doc,docx,dot,pdf,xlsx,xls,xlm,xla,xlc,xlt,xlw,xlam,xlsb,xlsm,xltm,csv|max:20480',
            'link' => 'required_if:file,' . null . '|nullable|max:255|url',
        ];
    }
    public function messages()
    {
        $jsAttribute = trans('validation.attributes');

        return [
            'link.required_if' => trans('validation.required_if', [
                'attribute' => $jsAttribute['link'],
                'other' => $jsAttribute['file'],
                'value' => $jsAttribute['empty'],
            ]),
        ];
    }
}
