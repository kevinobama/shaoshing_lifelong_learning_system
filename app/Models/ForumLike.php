<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ForumLike
 * @package App\Models
 * @version November 28, 2016, 11:06 am CST
 */
class ForumLike extends Model
{
    public $fillable = [
        'user_id',
        'post_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'post_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
