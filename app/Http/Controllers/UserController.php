<?php

namespace App\Http\Controllers;

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
    }

    public function getAccountEdit(){
        return view('user.account_edit');
    }

}
