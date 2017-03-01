<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ForumBulletins
 * @package App\Models\Backend
 * @version November 24, 2016, 11:38 am CST
 */
class ForumBulletin extends Model
{
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'title',
        'forum_id',
        'forum_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'forum_id' => 'integer',
        'forum_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
