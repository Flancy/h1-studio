<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesStorage extends Model
{
	protected $table = 'services_storage';
	  
    protected $fillable = [
        'email', 'name', 'name_service', 'description', 'file',
    ];
}
