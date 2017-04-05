<?php

namespace App\Http\Requests\Admin\User;

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
            'fullname' => 'required|max:255',
            'nickname' => 'required|max:100',
            'email' => 'required|max:100|email|unique:users',
            'password' => 'required|max:64',
            'phone' => 'max:100',
            'facebook_link' => 'nullable|max:255|url',
            'linkedin_link' => 'nullable|max:255|url',
            'github_link' => 'nullable|max:255|url',
            'stackoverflow_link' => 'nullable|max:255|url',
            'status' => 'required|in:0,1',
        ];
    }
}
