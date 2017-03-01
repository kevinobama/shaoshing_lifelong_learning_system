<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    //


    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'title',
        'author',
        'subject_id',
        'price',
        'download_count',
        'download_url',
        'filesize',
        'cover_image_url',
        'forum_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'author' => 'string',
        'subject_id' => 'integer',
        'price' => 'integer',
        'download_count' => 'integer',
        'download_url' => 'string',
        'filesize' => 'float',
        'cover_image_url' => 'string',
        'forum_id' => 'integer'
    ];


    /**
     * The User has books
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User','users_books');
    }
    
    /**
     * The Book belongs to one catgory
     */
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }
    
    
    public function forum()
    {
        return $this->hasOne('App\Models\Forum');
    }


    /**
     *  Get the CourseVideo for the Course
     */
    public function userBooksByUserId()
    {
        return $this->hasMany('App\Models\Users_book')
            ->where('users_books.user_id', Auth::id());
    }

    public static $rules = [
        
    ];
}
