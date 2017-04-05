<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends AbstractModel
{
    use Sluggable;
    protected $fillable = [
        'name',
        'alias',
        'description',
        'content',        
        'image',
        'user_id',
        'is_blog',
        'is_sesson',
        'count_share',
        'status',
        'time_tracking',
        'created_at',
        'updated_at'
    ];

    const LIMIT = 20;
    const WAITING_STATUS = 1;
    const PUBLIC_STATUS = 2;
    const CANCEL_STATUS = 3;
    const IS_SESSON = 1;
    const IS_BLOG = 1;

    const TYPE_STATUS = [
        self::WAITING_STATUS => 'Waiting',
        self::PUBLIC_STATUS => 'Public',
        self::CANCEL_STATUS => 'Cancel'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'alias' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * belongsTo User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * hasMany Question
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'article_id')->with('awsers');
    }

    public function ObjectCategories()
    {
        return $this->hasMany(ObjectCategory::class, 'object_id');
    }

    public static function getArticle($id) {
        return app(Article::class)->where(['id'=>$id])->with(['questions','ObjectCategories'])->first();
    }

    public function getImageUrl($image)
    {
        if ($image) {
            $uploadDisk = 'uploads';

            return asset('/' . $uploadDisk . '/' . strtolower(class_basename($this)) . '/' . $image);
        }
    }
}
