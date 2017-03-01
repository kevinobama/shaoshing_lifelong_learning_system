<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class UserCourseBookmarks
 * @package App\Models\Backend
 * @version November 22, 2016, 2:07 pm CST
 */
class UserCourseBookmark extends Model
{


    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'course_id',
        'user_id',
        'user_name',
        'new_post_count'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_id' => 'integer',
        'user_id' => 'integer',
        'user_name' => 'string',
        'new_post_count' => 'integer',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
