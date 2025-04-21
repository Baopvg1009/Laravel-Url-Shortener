<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $table = 'urls';

    public static function generateShortCode()
    {
        return substr(md5(uniqid(rand(), true)), 0, 7);
    }
}
