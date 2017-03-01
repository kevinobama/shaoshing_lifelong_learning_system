<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class CourseFiles
 * @package App\Models\Backend
 * @version November 29, 2016, 10:21 am CST
 */
class CourseFile extends Model
{

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'course_chapter_id',
        'lesson_name',
        'url',
        'type',
        'duration'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_chapter_id' => 'integer',
        'lesson_name' => 'string',
        'url' => 'string',
        'type' => 'string',
        'duration' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
