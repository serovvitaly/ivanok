<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getLogin()
    {
        return $this->login;
    }

    public function getFullName()
    {
        return $this->name . ' @ ' . $this->login;
    }

    public function isSuperAdmin()
    {
        return (bool) $this->is_super_admin;
    }

    public function getImageUrl()
    {
        return $this->image;
    }
}
