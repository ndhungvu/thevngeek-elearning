<?php

namespace App\Filter;

use App\QueryFilter;

class CommentFilters extends QueryFilter
{
    public function input()
    {
        return parent::filters();
    }

    public function keyWord($input = null)
    {
        if ($input) {
            return $this->builder->orWhere(function ($query) use($input) {
                $query->where('content', 'LIKE', '%' . $input . '%');
            });
        }
    }

    public function type($input = null)
    {
        if ($input) {
            return $this->builder->where('type', $input);
        }
    }

    public function status($input = null)
    {
        if ($input) {
            return $this->builder->where('status', $input);
        }
    }

    public function userAll($input = null)
    {
        if ($input) {
            return $this->builder->where('user_id', $input);
        }
    }

    public function document($input = null)
    {
        if ($input) {
            return $this->builder->where([
                'type' => 2,
                'object_id' => $input,
            ]);
        }
    }

    public function article($input = null)
    {
        if ($input) {
            return $this->builder->where([
                'type' => 1,
                'object_id' => $input,
            ]);
        }
    }
}
