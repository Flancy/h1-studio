<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $fillable = [
        'title', 'short_description', 'description', 'photo', 'url', 'created_ad', 'updated_ad',
    ];
}
