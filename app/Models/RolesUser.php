<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Roles_user
 * @package App\Models
 * @version October 18, 2016, 3:52 pm CST
 */
class RolesUser extends Model
{

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'role_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'role_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
