<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Challenge;
use App\ChallengeActual;
use App\ChallengeNoshow;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profil()
    {
        return view('user.profil');
    }

    public function odlozit()
    {
        $user = Auth::user();
        $actual = ChallengeActual::where('user_id', $user->id)->orderBy('id', 'desc')->first();

        $actual_challenge_id = $actual->challenge_id;

        ChallengeActual::where('user_id', $user->id)->delete();
        $noshow = new ChallengeNoshow();
        $noshow->user_id = $user->id;
        $noshow->challenge_id = $actual_challenge_id;
        $noshow->odlozeno = true;
        $noshow->save();

        return redirect('/');
    }

    public function splneno()
    {
        return redirect('/');
    }
}
