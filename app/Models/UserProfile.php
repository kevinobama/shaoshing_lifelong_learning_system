<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class UserProfiles
 * @package App\Models\Backend
 * @version November 22, 2016, 1:46 pm CST
 */
class UserProfile extends Model
{
    protected $primaryKey = 'user_id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'user_id',
        'gender',
        'avatar',
        'real_name',
        'nick_name',
        'coin',
        'level'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'gender' => 'string',
        'avatar' => 'string',
        'real_name' => 'string',
        'nick_name' => 'string',
        'coin' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
