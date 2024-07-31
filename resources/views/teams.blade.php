<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset("css/teams.css") }}">


    <title>matchs</title>
</head>
<body>
    @php
        // dd($teams)
    @endphp
    @extends('layouts.header')
    @foreach ( $teams as $team )
        
   
    <div class="teams">
        <div class="team">
            <a href="#">
                <div class="flag">
                    <img src="{{ $team->flag }}">
                </div>
                <div class="name">{{ $team->name }}</div>
            </a>
        </div>
        @endforeach
        

</body>

</html>