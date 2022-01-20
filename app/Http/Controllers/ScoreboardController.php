<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Http\Requests\PlayerRequest;

class ScoreboardController extends Controller
{
    public function index(Player $player)
    {
        abort_if($player == null, 403, 'Given user is incorrect!');

        $playerList = Player::orderBy('highscore', 'DESC')->limit(10)->get();

        return view('scoreboard', compact('player', 'playerList'));
    }

    public function store(PlayerRequest $request)
    {
        $player = Player::where('username', $request['username'])->first();

        abort_if($player == null, 403, 'Given user is incorrect!');

        if ($request['tries'] == null) {
            return response()->json(['success' => false]);
        }
        $score = (int) $request['tries'] * 20;

        $highscore = $score > $player->highscore ? $score : $player->highscore;

        $player->update([
            'latest_score' => $score,
            'highscore' => $highscore,
        ]);

        return response()->json(['success' => true, 'url' => route('scoreboard', ['player' => $player])]);
    }
}
