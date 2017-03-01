<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ForumAttachment
 * @package App\Models
 * @version November 28, 2016, 9:52 am CST
 */
class ForumAttachment extends Model
{
    public $fillable = [
        'user_id',
        'post_id',
        'filename',
        'filesize'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'post_id' => 'integer',
        'filename' => 'string',
        'filesize' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
