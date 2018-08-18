<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Challenge;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('App\Http\Middleware\CheckAdmin');
    }

    public function dashboard()
    {
        $users = User::orderBy('id', 'desc')->get();
        $neschvalene_vyzvy = Challenge::where('approved', false)->orderBy('id', 'asc')->get();
        return view('admin.dashboard', ['users' => $users, 'neschvalene_vyzvy' => $neschvalene_vyzvy]);
    }

    public function deleteChallenge($id)
    {
        if($challenge = Challenge::find($id)) {
            $challenge->delete();
        }

        return redirect('/admin');
    }

    public function approveChallenge($id)
    {
        if($challenge = Challenge::find($id)) {
            $challenge->approved = true;
            $challenge->save();
        }

        return redirect('/admin');
    }
}
