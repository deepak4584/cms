<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\User;


class Permission extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permission_roles()
    {
        return $this->belongsToMany(Permission_role::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}