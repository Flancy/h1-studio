<?php

namespace App;

use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'full_name', 'company', 'phone', 'description', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Projects')->withTimestamps();
    }

    public function checklists()
    {
        return $this->belongsToMany('App\ChecklistsUser')->withTimestamps();
    }

    public function isAdmin() {
        return $this->roles()->where('role_id', '1')->exists();
    }
}
