<?php

namespace App\Http\Requests\Admin\Comment;

use App\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class UpdateRequest extends FormRequest
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
        $rule = [
            'content' => 'required',
            'status' => 'required|in:1,2,3',
            'type' => 'required|in:1,2',
        ];

        if (! (isset($this->type) && $this->type)) {
            return $rule;
        }

        if ($this->type == 1) {
            $rule = array_merge($rule, [
                'object_id' => 'required|exists:articles,id',
            ]);
        } else {
            $rule = array_merge($rule, [
                'object_id' => 'required|exists:documents,id',
            ]);
        }

        return $rule;
    }
}
