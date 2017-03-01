<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class CourseChapters
 * @package App\Models\Backend
 * @version November 28, 2016, 2:47 pm CST
 */
class CourseChapter extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'course_id',
        'chapter_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_id' => 'integer',
        'chapter_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * Get the CourseVideo for the Course
     */
    public function videos()
    {
        return $this->hasMany('App\Models\CourseVideo');
    }

    /**
     * Get the CourseVideo for the Course
     */
    public function files()
    {
        return $this->hasMany('App\Models\CourseFile');
    }
}
