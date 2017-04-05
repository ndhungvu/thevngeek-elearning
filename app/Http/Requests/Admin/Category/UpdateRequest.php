<?php

namespace App\Http\Requests\Admin\Category;

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
        $id = Input::route()->parameters()['category'];

        return [
            'name' => 'required|max:100|unique:categories,name,' . $id,
            'description' => 'max:255',
            'image' => 'image|mimes:jpeg,jpg,gif,bmp,png|max:10240'
        ];
    }
}
