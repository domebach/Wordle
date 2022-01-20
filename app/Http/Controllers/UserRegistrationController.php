<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerRequest;
use App\Models\Player;
use Illuminate\Http\Request;

class UserRegistrationController extends Controller
{
    public function create(PlayerRequest $request)
    {
        // additional validation for registration
        $request->validate([
            'username' => 'unique:players,username',
        ]);

        $player = Player::create(['username' => $request['username']]);

        return response()->json(['success' => true, 'url' => route('wordle', ['player' => $player])]);
    }
}
