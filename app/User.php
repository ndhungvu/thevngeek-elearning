<?php

namespace App;

use Illuminate\Notifications\Notifiable;

class User extends AbstractModel
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'nickname',
        'email',
        'password',
        'phone',
        'facebook_link',
        'linkedin_link',
        'github_link',
        'stackoverflow_link',
        'skill',
        'rank',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*Get all users*/
    public static function getAllUsers() {
        return self::get();
    }

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function getStatus($status)
    {
        return array_get(__('admin/user.status'), $status);
    }

    public function getRank($rank)
    {
        return array_get(__('admin/user.rank'), $rank);
    }

    public function getRole($role)
    {
        return array_get(__('admin/user.role'), $role);
    }
}
