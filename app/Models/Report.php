<?php

namespace App\Models;

use Eloquent as Model;


/**
 * Class Reports
 * @package App\Models\Backend
 * @version November 28, 2016, 3:56 pm CST
 */
class Report extends Model
{

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'user_id',
        'forum_id',
        'report_id',
        'report_module',
        'content'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'forum_id' => 'integer',
        'report_id' => 'integer',
        'report_module' => 'string',
        'content' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
