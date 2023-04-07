<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //

    public function create(Request $request)
    {

        $request->validate([

            'userName'=>'required',
            'email'=>'unique:users,email',
            'userRole'=>'required'

        ]);

        $name = $request->userName;
        $email = $request->email;
        $userRole = $request->userRole;
        $password = env("DEFAULT_PASSWORD");
        
        User::create([
            'name' => $name,
            'email' => $email,
            'user_role' => $userRole,
            'password' => Hash::make($password),
        ]);

        return redirect()->back()->with('success','User '.$name.' is sucessfully created');

    }
}
