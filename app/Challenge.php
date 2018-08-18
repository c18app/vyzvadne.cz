<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

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
        return $this->inRandomOrder()->first()->content;
    }
}
