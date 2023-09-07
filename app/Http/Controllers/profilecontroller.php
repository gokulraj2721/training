<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class profilecontroller extends Controller
{
    public function profile()
    {
        return view('profile');
    }
    public function userProfile($userId)
    {
        $user = User::find($userId);

        return view('user_profile', ['user' => $user]);
    }
    public function userimage($userId)
    {
        $user = User::find($userId);

        return view('user_image', ['user' => $user]);
    }

    public function userprofileid()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('profile', compact('user'));
        }

       // return redirect()->route('login');
    }

}
