<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use Auth;

class UserController extends Controller
{
    public function __construct()
{

    $this->middleware("auth");

}

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', ['users' => $users]);
    }
    public function show(User $user)
    {

        return view('admin.users.profile', [

            'user' => $user,
            'roles' => Role::all()

        ]);
    }
    public function update(User $user, Request $request)
    {
        if (request('profile')) {

            $validatedData = request()->validate([
                'username' => 'required', 'string', 'max:255', 'alpha_dash',
                'name' => 'required', 'string', 'max:255',
                'email' => 'required', 'email', 'max:255',
                'profile' => 'file',
                'password' => 'min:8', 'max:255', 'confirmed',
            ]);
            $input = $request->all();
            if ($image = $request->file('profile')) {
                $destinationPath = 'images/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['profile'] = "$profileImage";
            } else {
                unset($input['profile']);
            }

            $user->update($input);

            back()->with('Updated', 'Post Has been Updated');
            return redirect()->route('users.index');
        }
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('message', 'User Has been Deleted');

        return back();
    }
    public function attach(User $user)
    {
        $user->roles()->attach(request('role'));
        return back();
    }
    public function detach(User $user)
    {
        $user->roles()->detach(request('role'));
        return back();
    }
}