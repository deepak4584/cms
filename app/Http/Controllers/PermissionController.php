<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    //
    public function index()
    {
        return view('components.admin.permissions.index', [
            'permissions' => Permission::all()


        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        Permission::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);
        return back();
    }
    public function edit(Permission $permission)
    {
        return view('components.admin.permissions.edit', ['permission' => $permission]);
    }
public function update_permission(Permission $permission)

    {
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(request('name'))->slug('-');
        if ($permission->isDirty('name')) {
            session()->flash('updated', 'Permission Has been Updated ' . request('name'));
            $permission->save();
        
        } else {
            session()->flash('updated', 'Nothing Has been Updated ' . request('name'));
        }
         return back();
    }
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return back();
    }
}