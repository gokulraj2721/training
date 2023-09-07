<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;



class user_managenmentcontroller extends Controller
{
    public function user_management ()
    {

        $users = DB::table('users')->paginate(4);
        return view('user_management', ['users' => $users]);
    }

    public function edit_user_detailes($id){
        $user = user::where('id', '=', $id)->first();
        return view('edit', ['data' => $user]);
    }

    public function save_edit_user_detailes(Request $request, $id){


        $user = user::where('id', '=', $id)->first();
        if ($request->hasFile('photo')) {
            $fileName = time() . $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('public/images', $fileName);
            $user->photo = '/storage/images/' . $fileName;
        }

        $user->name = ($request->input('name') != null) ? $request->input('name') : " ";
        $user->email = ($request->input('email') != null) ? $request->input('email') : " ";
        $user->aadhar_id = ($request->input('aadhar_id') != null) ? $request->input('aadhar_id') : " ";
        $user->password = $request->input('password');
        $user->address = ($request->input('address') != null) ? $request->input('address') : " ";
        $user->phone = ($request->input('phone') != null) ? $request->input('phone') : " ";
        $user->dob =($request->input('dob') != null) ? $request->input('dob') : " ";
        $user->gender = ($request->input('gender') != null) ? $request->input('gender') : " ";

        $user->save();
        return redirect('user_management');
    }

    public function delete_user_detailes(Request $request, $id){
        $user = user::where('id', '=', $id)->first();
        $user->photo = $request->file('photo');
        $user->name =$request->input('name');
        $user->email = $request->input('email');
        $user->aadhar_id = $request->input('aadhar_id');
        $user->password = $request->input('password');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->dob = $request->input('dob');
        $user->gender = $request->input('gender');
        $user->delete();
        return back()->withSuccessMessage('success fully added');

    }
}
