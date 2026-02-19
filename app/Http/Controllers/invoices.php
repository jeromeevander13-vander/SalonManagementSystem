<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class invoices extends Controller
{
    //
    public function index() {
        return view('client.invoices'); //
    }
}
