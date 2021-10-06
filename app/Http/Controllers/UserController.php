<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', ['users' => $users]);
    }
    public function show(User $user)
    {
        return view('admin.users.profile', ['user' => $user]);
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
            return redirect()->route('post.index');
        }
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('message', 'User Has been Deleted');

        return back();
    }
}