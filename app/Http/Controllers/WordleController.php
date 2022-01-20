<?php

namespace App\Http\Controllers;

use App\Models\Player;

class WordleController extends Controller
{
    public function index(Player $player)
    {
        abort_if($player == null, 403, 'Given user is incorrect!');

        $solutionWord = $this->getSolutionWord();

        return view('wordle', compact('player', 'solutionWord'));
    }

    private function getSolutionWord()
    {
        $filename = 'wordle_list_5_chrs.txt';

        $file = fopen($filename, 'r');

        abort_if(!$file, 404, 'File cannot be opened!');

        $lines_count = count(file($filename));
        $randomized_number = rand(0, $lines_count - 1);
        $count = 0;
        $solutionWord = '';

        while (!feof($file)) {
            $line = fgets($file);
            if ($count == $randomized_number) {
                $solutionWord = normalizer_normalize(strtoupper(rtrim($line)));
                break;
            }
            $count++;
        }

        fclose($file);

        return $solutionWord;
    }
}
