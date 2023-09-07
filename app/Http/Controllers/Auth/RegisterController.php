<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'aadhar_id' => 'required_if:aadhar_required,yes',
        'address' => 'required_if:address_required,yes',
        'phone' => 'required_if:phone_required,yes',
        'dob' => 'required_if:dob_required,yes',
        'gender' => 'required_if:gender_required,yes',
        'photo' => 'required_if:photo_required,yes',
        'role' => 'required_if:role_required,yes',

    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = new User;

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = $request->input('password');
    $user->address = $request->input('address') == 'yes' ? $request->input('address') : '';
    $user->phone = $request->input('phone') == 'yes' ? $request->input('phone') : '';
    $user->dob = $request->input('dob') == 'yes' ? $request->input('dob') : '';
    $user->gender = $request->input('gender') == 'yes' ? $request->input('gender') : '';
    $user->photo = $request->file('photo') == 'yes' ? $request->input('photo') : '';
    $user->aadhar_id = $request->input('aadhar_required') == 'yes' ? $request->input('aadhar_id') : '';
    $user->role= $request->input('role') == 'yes' ? $request->input('role') : '';
    $user->role = 'user';

    $user->save();

    return redirect('/login')->with('success', 'Registration successful! You can now log in.');
    


}

}
