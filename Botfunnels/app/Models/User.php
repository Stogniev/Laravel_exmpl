<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role_id',
    ];

    /**
     *  A user may have one role.
     *
     * @return boolean
     **/

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Determine if the user has the given role.
     *
     * @return boolean
     */

    public function hasRole($role)
    {
        if (DB::table('users')->where('role_id', $role)) {
            return DB::table('roles')->where('id', $role)->value('name');
        }
        return false;
    }

    /**
     * Add role to user.
     *
     * @return boolean
     */
    public function makeEmployee($title)
    {
        $role = DB::table('roles')->where('name', $title)->value('id');

        if ($role) {
            $this->role_id = $role;
        }

        $this->save();
    }

    public function socialAccount()
    {
        return $this->hasOne(SocialAccount::class);
    }

    public function facebookPage()
    {
        return $this->hasOne(FacebookPage::class);
    }
}
