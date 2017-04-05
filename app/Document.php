<?php

namespace App;

class Document extends AbstractModel
{
    protected $fillable = [
        'id', 'name', 'alias', 'description', 'file', 'link', 'status', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getComments($ids)
    {
        if (is_array($ids)) {
            return app(Comment::class)->where('type', 2)->whereIn('object_id', $ids)->get();
        }

        return app(Comment::class)->where([
            'object_id' => $ids,
            'type' => 2,
        ])->get();
    }

    public function getStatus($status)
    {
        return array_get(__('admin/document.status'), $status);
    }
}
