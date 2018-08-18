<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challenge;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function homepage()
    {
        return view('index.homepage', ['vyzev_celkem' => Challenge::where('approved', true)->count()]);
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

        return redirect('/');
    }
}
