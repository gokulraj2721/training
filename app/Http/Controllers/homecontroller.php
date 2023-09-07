<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class homecontroller extends Controller
{
    public function home()
    {

            return view('home');
    }
}
