<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('components.admin.roles.index', [

            'roles' => Role::all()
        ]);
    }

    public function edit(Role $role)
    {
    

        return view('components.admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        Role::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);
        return back();
    }
    public function update(Role $role)
    {
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(request('name'))->slug('-');
        if ($role->isDirty('name')) {
            session()->flash('updated', 'Role Has been Updated ' . request('name'));
            $role->save();
        } else {
            session()->flash('updated', 'Nothing Has been Updated ' . request('name'));
        }
        // return redirect()->back()->with('updated', 'Post Has been Updated');
        return back();
    }
    public function attach_permission(Role $role)
    {
        $role->permissions()->attach(request('permission'));
        return  back();

    }
  
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('message', 'Post Has been Deleted');
        return  back();
    }
}