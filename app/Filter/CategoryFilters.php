<?php

namespace App\Filter;

use App\QueryFilter;

class CategoryFilters extends QueryFilter
{
    public function input()
    {
        return parent::filters();
    }

    public function keyWord($input = null)
    {
        if ($input) {
            return $this->builder->orWhere(function ($query) use($input) {
                $query->where('name', 'LIKE', '%' . $input . '%')
                    ->orWhere('description', 'LIKE', '%' . $input . '%');
            });
        }
    }

    public function parent($input = null)
    {
        if ($input) {
            return $this->builder->where('parent', $input);
        }
    }
}
