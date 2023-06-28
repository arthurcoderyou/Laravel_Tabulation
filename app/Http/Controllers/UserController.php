<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //update and show profile
    public function profile(){
        return view('account');
    }

}
