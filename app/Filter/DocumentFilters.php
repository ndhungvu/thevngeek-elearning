<?php

namespace App\Filter;

use App\QueryFilter;

class DocumentFilters extends QueryFilter
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
                    ->orWhere('alias', 'LIKE', '%' . $input . '%')
                    ->orWhere('file', 'LIKE', '%' . $input . '%')
                    ->orWhere('description', 'LIKE', '%' . $input . '%')
                    ->orWhere('link', 'LIKE', '%' . $input . '%');
            });
        }
    }

    public function status($input = null)
    {
        if ($input) {
            return $this->builder->where('status', $input);
        }
    }
}
