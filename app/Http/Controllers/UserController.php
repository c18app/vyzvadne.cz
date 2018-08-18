<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Challenge;
use App\ChallengeActual;
use App\ChallengeNoshow;
use App\ChallengeHistory;
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

    public function historie()
    {
        $user = Auth::user();
        $historie = ChallengeHistory::where('user_id', $user->id)->orderBy('status', 'desc')->orderBy('id', 'desc')->get();
        $vyzva = Challenge::all()->pluck('content', 'id');
        return view('user.historie', ['historie' => $historie, 'vyzva' => $vyzva]);
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

        $history = new ChallengeHistory();
        $history->user_id = $user->id;
        $history->challenge_id = $actual_challenge_id;
        $history->status = 'odlozeno';
        $history->save();

        return redirect('/');
    }

    public function splneno()
    {
        $user = Auth::user();
        $actual = ChallengeActual::where('user_id', $user->id)->orderBy('id', 'desc')->first();

        $actual_challenge_id = $actual->challenge_id;

        ChallengeActual::where('user_id', $user->id)->delete();
        $noshow = new ChallengeNoshow();
        $noshow->user_id = $user->id;
        $noshow->challenge_id = $actual_challenge_id;
        $noshow->odlozeno = false;
        $noshow->save();

        $history = new ChallengeHistory();
        $history->user_id = $user->id;
        $history->challenge_id = $actual_challenge_id;
        $history->status = 'splneno';
        $history->save();

        return redirect('/');
    }
}
