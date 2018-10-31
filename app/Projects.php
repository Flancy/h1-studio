<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $fillable = [
        'title', 'service_name', 'description'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function projects()
    {
        return $this->belongsToMany('App\ProjectsUser')->withTimestamps();
    }
}
