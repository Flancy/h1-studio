<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $fillable = [
        'projects_id', 'type', 'name', 'src'
    ];

    public function project()
    {
        return $this->hasOne('App\Projects', 'id', 'project_id');
    }
}
