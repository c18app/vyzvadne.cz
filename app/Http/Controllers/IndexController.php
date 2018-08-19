<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challenge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function homepage()
    {
        $vyzva = (new Challenge)->getChallenge();
        return view('index.homepage', ['vyzva' => $vyzva, 'vyzev_celkem' => Challenge::where('approved', true)->count()]);
    }

    public function newchallenge(Request $request, Auth $auth)
    {
        $validatedData = $request->validate([
            'content' => 'required|min:10'
        ], [
            'content.required' => 'Text výzvy musí být vyplněn',
            'content.min' => 'Text výzvy musí mít alespoň :min znaků',
        ]);

        $challenge = Challenge::create($validatedData);
        if(Auth::check()) {
            $challenge->created_by_user_id = Auth::user()->getAuthIdentifier();
            $challenge->save();
        }

        Mail::raw('Nové výzvy ke schválení', function ($message) {
            $message->subject('Výzva dne: Nové výzvy ke schválení');
            $message->to('mnosavcov@gmail.com');
        });

        return redirect('/')->with('message', 'Výzva byla přijata a nyní čeká na schválení.');
    }
}
