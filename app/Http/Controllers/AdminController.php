<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('App\Http\Middleware\CheckAdmin');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
