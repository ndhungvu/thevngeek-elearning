<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class AbstractModel extends Authenticatable
{
    public $incrementing = false;

    public $with = [];

    public $dataSelect = ['*'];

    private function getData()
    {
        return $this->select($this->dataSelect)->with($this->with);
    }

    public function where($condition = [], callable $callback = null)
    {
        return $this->getData()->where($callback ?: function ($query) use ($condition) {
            if ($condition) {
                $query->where($condition);
            }
        });
    }

    public function getAll()
    {
        return $this->getData()->get();
    }

    public function findOrFail($id)
    {
        return $this->getData()->findOrFail($id);
    }

    public function orderBy($column = 'id', $sort = 'desc')
    {
        return $this->getData()->orderBy($column, $sort);
    }

    public function paginateData($limit = 10)
    {
        return $this->getData()->paginate($limit);
    }

    public function store(array $attribute)
    {
        return $this->create($attribute);
    }

    public function edit(Model $entity, array $attributes)
    {
        return $entity->update($attributes);
    }

    public function remove(Model $entity)
    {
        return $entity->delete();
    }

    public function destroyData($ids = [])
    {
        return $this->destroy($ids);
    }

    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string)Uuid::uuid4();
        });
    }

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}
