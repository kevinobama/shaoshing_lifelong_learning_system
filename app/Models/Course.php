<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Support\Facades\Auth;

/**
 * Class Courses
 * @package App\Models\Backend
 * @version November 22, 2016, 1:46 pm CST
 */
class Course extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'name',
        'introduction',
        'type',
        'user_id',
        'user_name',
        'cover_image',
        'subject_id',
        'subject_name',
        'new_post_count'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'introduction' => 'string',
        'type' => 'string',
        'user_id' => 'integer',
        'user_name' => 'string',
        'cover_image' => 'string',
        'new_post_count' => 'integer',
        'forum_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];


    /**
     *  Get the CourseVideo for the Course
     */
    public function chapters()
    {
        return $this->hasMany('App\Models\CourseChapter');
    }

    /**
     *  Get the CourseVideo for the Course
     */
    public function bookmarks()
    {
        return $this->hasMany('App\Models\UserCourseBookmark');
    }

    /**
     *  Get the CourseVideo for the Course
     */
    public function bookmarksByUserId()
    {
        return $this->hasMany('App\Models\UserCourseBookmark')
            ->where('user_course_bookmarks.user_id', Auth::id());
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User','courses_users');
    }
}
