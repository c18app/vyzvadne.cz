<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\ChallengeNoshow;
use Illuminate\Support\Facades\Auth;

class Challenge extends Model
{
    protected $fillable = ['content'];

    public function vytvoril_jmeno()
    {
        $user = User::find($this->created_by_user_id);
        if ($user) {
            return $user->name . ' (' . $user->email . ')';
        }

        return '-';
    }

    public function getChallenge()
    {
        if (Auth::user()) {
            $user = Auth::user();
            $actual = ChallengeActual::where('user_id', $user->id)->orderBy('id', 'desc')->first();

            if(!$actual) {
                $not_id_challenge_id = ChallengeNoshow::where('user_id', $user->id)->get(['challenge_id'])->pluck('challenge_id');

                $challenge = $this->whereNotIn('id', $not_id_challenge_id)->inRandomOrder()->first();

                if(!$challenge) {
                    ChallengeNoshow::where('user_id', $user->id)->where('odlozeno', true)->delete();
                    $not_id_challenge_id = ChallengeNoshow::where('user_id', $user->id)->get(['challenge_id'])->pluck('challenge_id');
                    $challenge = $this->whereNotIn('id', $not_id_challenge_id)->inRandomOrder()->first();
                }

                if(!$challenge) {
                    ChallengeNoshow::where('user_id', $user->id)->delete();
                    $not_id_challenge_id = ChallengeNoshow::where('user_id', $user->id)->get(['challenge_id'])->pluck('challenge_id');
                    $challenge = $this->whereNotIn('id', $not_id_challenge_id)->inRandomOrder()->first();
                }
                $actual = new ChallengeActual();
                $actual->user_id = $user->id;
                $actual->challenge_id = $challenge->id;
                $actual->save();
            } else {
                $challenge = $this->find($actual->challenge_id);
            }

            dump($challenge->id);

            return $challenge->content;


        }

        return $this->inRandomOrder()->first()->content;
    }
}
