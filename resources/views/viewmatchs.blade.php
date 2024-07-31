

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">

    <title>matchs</title>
</head>
<body>
    @extends('layouts\header')
<!-- matches section starts  -->
<section class="matches" id="matches">
    <div class="container">
        <h1 class="section-heading" style="text-align: center;">matches</h1>
        <div class="matchs" id="match-date"></div>
    </div>
@foreach ( $matchs as $match)
@php
$team1 = $match->teams()->first();
$team2 = $match->teams()->skip(1)->first();
@endphp     
                    <div class="match">
                    <div class="match-info">
                        @if ($match->type == "Group stage")
                        <h4 class="group">group {{ $team1->group }}</h4>
                        @else
                        <h4 class="group"> {{ $match->type }}</h4>
                        @endif                     
                    </div>
                    <div class="flags">
                        <div class="home-flag">
                            <img src="{{ $team1->flag }}" alt="${match.home_team}" class="flag" />
                        <h3 class="home-team">{{ $team1->name }}</h3>
                        </div>
                        <span class="vs">
                        VS
                        </span>
                        <div class="away-flag">
                        <img src="{{ $team2->flag }}" alt="${match.away_team}" class="flag" />
                        <h3 class="home-team">{{ $team2->name }}</h3>
                        </div>
                    </div>
                    <div class="time-area">
                        <div class="time">
                            <h4 class="month">{{ date('M', strtotime($match->date)) }}</h4>
                            <h4 class="day">{{ date('l', strtotime($match->date)) }}</h4>
                            <h4 class="date">{{ date('d', strtotime($match->date)) }}</h4>
                        </div>
                        <h4 class="match-time">{{ date('g:i a', strtotime($match->date)) }}</h4>
                    </div>
                    @if ($match->isTicket && auth()->user()->tickets()->where('match_id', $match->id)->count() == 0)
                    <a href="{{ route('book',[$match->id]) }}">book</a>
                        
                     @endif 
                </div>
                @endforeach
           
</section>
<!-- matches section ends -->
</body>
</html>

