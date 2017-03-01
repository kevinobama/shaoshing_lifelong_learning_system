<?php

namespace App\Models;

use App\Helpers\Utility;
use Eloquent as Model;

/**
 * Class BadWord
 * @package App\Models
 * @version December 1, 2016, 3:03 pm CST
 */
class BadWord extends Model
{
    public $fillable = [
        'word'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'word' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public static function clean($content)
    {
        $badWords = self::select('word')->get();
        foreach ($badWords as $badWord) {
            $content = Utility::mb_replace($badWord->word, str_repeat('☻', mb_strlen($badWord->word)), $content);
        }
        return $content;
    }


}
