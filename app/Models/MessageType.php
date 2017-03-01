<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class MessageType
 * @package App\Models
 * @version December 6, 2016, 2:37 pm CST
 */
class MessageType extends Model
{
    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
