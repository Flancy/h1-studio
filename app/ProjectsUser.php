<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectsUser extends Model
{
    protected $table = 'projects_user';
    
    public function projects()
    {
        return $this->belongsToMany('App\Projects')->withTimestamps();
    }

    public function users()
	{
	    return $this->belongsToMany('App\User')->withTimestamps();
	}
}
