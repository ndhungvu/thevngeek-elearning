<?php

$jsAttribute = trans('validation.attributes');

return [
    'searchPage' => [
        'keyword' => [
            'required' => __('validation.required', ['attribute' => $jsAttribute['keyword']]),
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['keyword'], 'max' => 255]),
        ],
    ],
    'category' => [
        'name' => [
            'required' => __('validation.required', ['attribute' => $jsAttribute['name']]),
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['name'], 'max' => 100]),
        ],
        'description' => [
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['description'], 'max' => 255]),
        ],
        'image' => [
            'accept' => __('validation.image', ['attribute' => $jsAttribute['image']]),
            'extension' => __('validation.mimes', ['attribute' => $jsAttribute['image'], 'values' => 'jpeg, jpg, gif, bmp, png']),
            'fileSize' => __('validation.max.file', ['attribute' => $jsAttribute['image'], 'max' => '10MB'])
        ],
    ],
    'user' => [
        'fullname' => [
            'required' => __('validation.required', ['attribute' => $jsAttribute['fullname']]),
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['fullname'], 'max' => 255]),
        ],
        'nickname' => [
            'required' => __('validation.required', ['attribute' => $jsAttribute['nickname']]),
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['nickname'], 'max' => 100]),
        ],
        'email' => [
            'required' => __('validation.required', ['attribute' => $jsAttribute['email']]),
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['email'], 'max' => 100]),
            'email' =>  __('validation.email', ['attribute' => $jsAttribute['email']]),
        ],
        'password' => [
            'required' => __('validation.required', ['attribute' => $jsAttribute['password']]),
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['password'], 'max' => 64]),
        ],
        'phone' => [
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['phone'], 'max' => 100]),
        ],
        'facebook_link' => [
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['facebook_link'], 'max' => 255]),
            'url' => __('validation.url', ['attribute' => $jsAttribute['facebook_link']]),
        ],
        'linkedin_link' => [
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['linkedin_link'], 'max' => 255]),
            'url' => __('validation.url', ['attribute' => $jsAttribute['linkedin_link']]),
        ],
        'github_link' => [
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['github_link'], 'max' => 255]),
            'url' => __('validation.url', ['attribute' => $jsAttribute['github_link']]),
        ],
        'stackoverflow_link' => [
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['stackoverflow_link'], 'max' => 255]),
            'url' => __('validation.url', ['attribute' => $jsAttribute['stackoverflow_link']]),
        ],
        'status' => [
            'required' => __('validation.required', ['attribute' => $jsAttribute['status']]),
        ],
    ],
    'documentPage' => [
        'name' => [
            'required' => __('validation.required', ['attribute' => $jsAttribute['name']]),
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['name'], 'max' => 255]),
        ],
        'alias' => [
            'required' => __('validation.required', ['attribute' => $jsAttribute['alias']]),
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['alias'], 'max' => 255]),
        ],
        'description' => [
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['description'], 'max' => 255]),
        ],
        'file' => [
            'extension' => __('validation.mimes', [
                'attribute' => $jsAttribute['file'],
                'values' => 'doc, docx, dot, pdf, xlsx, xls, xlm, xla, xlc, xlt, xlw, xlam, xlsb, xlsm, xltm, csv'
            ]),
            'fileSize' => __('validation.max.file', ['attribute' => $jsAttribute['file'], 'max' => '20MB'])
        ],
        'link' => [
            'max' => __('validation.max.string', ['attribute' => $jsAttribute['link'], 'max' => 255]),
            'url' => __('validation.url', ['attribute' => $jsAttribute['link']]),
        ],
    ],
    'comment' => [
        'content' => [
            'required' => __('validation.required', ['attribute' => $jsAttribute['content']]),
        ],
        'status' => [
            'required' => __('validation.required', ['attribute' => $jsAttribute['status']]),
        ],
        'type' => [
            'required' => __('validation.required', ['attribute' => $jsAttribute['type']]),
        ],
    ],
];