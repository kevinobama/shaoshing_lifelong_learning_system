<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class UserCheckins
 * @package App\Models\Backend
 * @version November 23, 2016, 1:10 pm CST
 */
class UserCheckin extends Model
{

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'user_id',
        'signed_date_time',
        'signed_days'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'signed_date_time' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
