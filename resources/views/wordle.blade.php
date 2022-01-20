@extends('layouts.layout')

@section('content')
    <div class="max-w-xs mx-auto">
        <h1 class="title text-4xl text-white text-center mb-10">Wordle</h1>
        <wordle-game solution-word="{{ $solutionWord }}" playername="{{ $player->username }}"/>
    </div>
@endsection