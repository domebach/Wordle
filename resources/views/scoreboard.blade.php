@extends('layouts.layout')

@section('content')
<div class="max-w-xs mx-auto">
    <h1 class="title text-6xl text-white text-center mb-10">Wordle</h1>
    @foreach($playerList as $key => $player)
    <div class="flex items-center w-full text-lg text-white mb-2">
        <div class="w-1/6">{{ ++$key }}.</div>
        <div class="w-4/6">{{ $player->username }}</div>
        <div class="w-1/6 text-right">{{ $player->highscore }}</div>
    </div>
    @endforeach

    <a href="{{ route('wordle', ['player' => $player]) }}" class="block text-center text-black text-xl font-bold bg-yellow-100 rounded-lg p-3 mt-80">
        NEUES SPIEL
    </a>
</div>
@endsection
