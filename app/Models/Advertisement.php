<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Advertisements
 * @package App\Models\Backend
 * @version December 7, 2016, 11:15 am CST
 */
class Advertisement extends Model
{

    public $table = 'advertisements';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'priority',
        'image_link',
        'redirect_link',
        'content',
        'click_count',
        'is_active',
        'block',
        'module'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'priority' => 'integer',
        'image_link' => 'string',
        'redirect_link' => 'string',
        'content' => 'text',
        'click_count' => 'integer',
        'is_active' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
