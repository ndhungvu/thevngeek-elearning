<?php

namespace App;

class Comment extends AbstractModel
{
    protected $fillable = [
        'content', 'type', 'status', 'object_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents($ids)
    {
        if (is_array($ids)) {
            return app(Document::class)->whereIn('id', $ids)->pluck('name', 'id')->toArray();
        }

        return app(Document::class)->select('id', 'name')->findOrFail($ids)->toArray();
    }

    public function articles($ids)
    {
        if (is_array($ids)) {
            return app(Article::class)->whereIn('id', $ids)->pluck('name', 'id')->toArray();
        }

        return app(Article::class)->select('id', 'name')->findOrFail($ids)->toArray();
    }

    public function getStatus($status)
    {
        return array_get(__('admin/comment.status'), $status);
    }

    public function getType($type)
    {
        return array_get(__('admin/comment.type'), $type);
    }

    public function getRelations($comments = [])
    {
        if ($comments) {
            $documentIds = [];
            $articleIds = [];

            foreach ($comments->items() as $comment) {
                if ($comment['type'] == 1) {
                    array_push($articleIds, $comment['object_id']);
                } else {
                    array_push($documentIds, $comment['object_id']);
                }
            }

            return [
                'documents' => $documentIds ? $this->documents($documentIds) : $documentIds,
                'articles' => $articleIds ? $this->articles($articleIds) : $articleIds,
            ];
        }

        return $comments;
    }
}
