<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class services extends Controller
{
    //
    public function index() {
        $services = Service::where('status', 'active')->latest()->get()->groupBy('category');
        return view('services', compact('services'));
    }
}
