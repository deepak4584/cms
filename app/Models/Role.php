<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Permission;


class Role extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permisions()
    {
        return $this->belongsToMany(Permission::class);
    }
}