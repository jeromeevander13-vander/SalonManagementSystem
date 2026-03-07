<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //

    public function index(){
        $user = User::where('role', 'admin')->get();
        return view('admin.dashboard', compact('user'));
    }


}
