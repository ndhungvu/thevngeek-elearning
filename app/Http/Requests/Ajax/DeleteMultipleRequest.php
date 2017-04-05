<?php

namespace App\Http\Requests\Ajax;

use Illuminate\Foundation\Http\FormRequest;

class DeleteMultipleRequest extends FormRequest
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
        $rules = [
            'objectAjax' => 'required',
            'dataAjax' => 'required|array',
        ];

        if (! $this->objectAjax) {
            return $rules;
        }

        return array_merge($rules, [
            'dataAjax.*' => 'exists:' . str_plural($this->objectAjax) . ',id'
        ]);
    }

    public function messages()
    {
        $ajaxMessage = __('ajax.delete_multiple');
        $messages = [
            'objectAjax.required' => $ajaxMessage['objectAjax']['required'],
            'dataAjax.required' => $ajaxMessage['dataAjax']['required'],
            'dataAjax.array' => $ajaxMessage['dataAjax']['array'],
        ];

        if (! $this->objectAjax) {
            return $messages;
        }
        foreach ($this->request->get('dataAjax') as $key => $value){
            $messages['dataAjax.'. $key .'.exists'] = trans('ajax.delete_multiple.dataAjax.exists', ['value' => $key]);
        }

        return $messages;
    }
}
