<?php

namespace App;

class Question extends AbstractModel
{
    protected $fillable = [
        'content',
        'description',
        'article_id',
        'created_at',
        'updated_at'
    ];

    /**
     * hasMany Question
     */
    public function awsers()
    {
        return $this->hasMany(Awser::class, 'question_id');
    }

    public static function getQuestionsByArticleID($article_id) {
    	return app(Question::class)->where(['article_id' => $article_id])->get();
    }

    public static function deleteAll($objects) {
    	$ok = false;
    	foreach ($objects as $key => $object) {
    		$ok = $object->delete();
    	}

    	return $ok;
    }
}
