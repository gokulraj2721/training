<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class addusercontroller extends Controller
{
    public function add_user()
    {
        return view('add_user');
    }

    public function addusers(Request $request)
{
    $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',

    ];

    $validator = Validator::make($request->all(), $rules);

    $user = new User();


    if ($request->hasFile('photo')) {
        $fileName = time() . $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('public/images', $fileName);
        $user->photo = '/storage/images/' . $fileName;
    }
 

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->role = 'user';
   $user->aadhar_id = $request->input('aadhar_id') == 'yes' ? $request->input('aadhar_id') : '';
    $user->password = bcrypt($request->input('password'));
    $user->address = $request->input('address');
    $user->phone = $request->input('phone');
    $user->dob = $request->input('dob');
    $user->gender = $request->input('gender');



    $user->save();
    return redirect('user_management');
    }


}
