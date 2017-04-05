<?php

namespace App\Filter;

use App\QueryFilter;

class UserFilters extends QueryFilter
{
    public function input()
    {
        return parent::filters();
    }

    public function keyWord($input = null)
    {
        if ($input) {
            return $this->builder->orWhere(function ($query) use($input) {
                $query->where('fullname', 'LIKE', '%' . $input . '%')
                    ->orWhere('nickname', 'LIKE', '%' . $input . '%')
                    ->orWhere('email', 'LIKE', '%' . $input . '%')
                    ->orWhere('phone', 'LIKE', '%' . $input . '%')
                    ->orWhere('facebook_link', 'LIKE', '%' . $input . '%')
                    ->orWhere('linkedin_link', 'LIKE', '%' . $input . '%')
                    ->orWhere('github_link', 'LIKE', '%' . $input . '%')
                    ->orWhere('stackoverflow_link', 'LIKE', '%' . $input . '%')
                    ->orWhere('skill', 'LIKE', '%' . $input . '%');
            });
        }
    }

    public function status($input = null)
    {
        if ($input) {
            return $this->builder->where('status', $input);
        }
    }

    public function rank($input = null)
    {
        if ($input) {
            return $this->builder->where('rank', $input);
        }
    }

    public function role($input = null)
    {
        if ($input) {
            return $this->builder->where('role', $input);
        }
    }
}
