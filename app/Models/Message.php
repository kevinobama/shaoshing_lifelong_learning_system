<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Message
 * @package App\Models
 * @version November 25, 2016, 2:50 pm CST
 */
class Message extends Model
{
    public $fillable = [
        'is_banner',
        'image',
        'type_id',
        'title',
        'content',
        'content_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_banner' => 'integer',
        'image' => 'string',
        'type_id' => 'integer',
        'title' => 'string',
        'content' => 'string',
        'content_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function type()
    {
        return $this->belongsTo('App\Models\MessageType');
    }

}
