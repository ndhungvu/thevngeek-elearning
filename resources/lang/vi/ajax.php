<?php

return [
    'delete_multiple' => [
        'objectAjax' => [
            'required' => 'Đối tượng xóa không hợp lệ',
        ],
        'dataAjax' => [
            'required' => 'Dữ liệu không hợp lệ',
            'array' => 'Dữ liệu phải là một mảng',
            'exists' => 'Dữ liệu :value không có trong cơ sở dữ liệu',
        ],
        'not_choice_item' => 'Không có dữ liệu được chọn',
        'confirm' => 'Bạn muốn xóa các mục này?',
    ],
];