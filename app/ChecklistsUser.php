<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistsUser extends Model
{
    protected $table = 'checklists_user';

    protected $fillable = [
        'projects_id', 'user_id', 'type', 'description', 'status'
    ];
    
    public function projects()
    {
        return $this->belongsToMany('App\Projects')->withTimestamps();
    }
}
