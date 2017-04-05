<?php

return [
    'delete_multiple' => [
        'objectAjax' => [
            'required' => 'Object deleted invalid',
        ],
        'dataAjax' => [
            'required' => 'Data choice invalid',
            'array' => 'Data choice must is array',
            'exists' => 'Data :value choice have not into database',
        ],
        'not_choice_item' => 'Not item selected',
        'confirm' => 'Do you want delete this items',
    ],
];