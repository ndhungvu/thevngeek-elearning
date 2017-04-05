<?php

namespace App;

class ObjectCategory extends AbstractModel
{

    protected $table = "object_category";
    protected $fillable = [
        'type',
        'object_id',
        'description',
        'category_id',        
        'created_at',
        'updated_at'
    ];

    const TYPE_ARTICLE = 1;
    const TYPE_SESSON = 2;
    const TYPE_DOCUMENT = 3;

    public static function deleteAll($objects) {
        $ok = false;
        foreach ($objects as $key => $object) {
            $ok = $object->delete();
        }

        return $ok;
    }
}
