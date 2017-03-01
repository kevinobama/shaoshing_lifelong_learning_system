<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone_number','ip','last_login',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function findForPassport($userName) {
        return self::where('name', $userName)->first(); // change column name whatever you use in credentials
    }

    
    /**
     * The User has many roles
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'roles_users');// check if edu needed
    }

    /**
     * Get the comments for the blog post.
     */
    public function profile()
    {
        return $this->hasOne('App\Models\UserProfile');
    }
    
    /**
     * The User has books
     */
    public function books()
    {
        return $this->belongsToMany('App\Models\Book','users_books');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Models\Course');
    }
}
