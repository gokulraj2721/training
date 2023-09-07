<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class loginController extends Controller
{
    public function add_authenticate(Request $request){
        $validator = Validator::make( $request->all(),[

            'email'=> 'required',
            'password'=>'password'
        ]);
        $email= $request->input('email');
        $password=$request->input('password');

        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            $user =User::where('email',$email)->first();
            Auth::login($user);
            return redirect('/');
        }else{
            return back()->withErrors(['Invalied email And Password']);
        }
    }

    public function  logout(){
        Auth::logout();
        return redirect( '/login');

    }
 }


