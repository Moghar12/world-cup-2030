<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>my tickets</title>
  <link rel="icon" type="image/x-icon" href="{{ asset("css/3.png") }}">

  <link href="https://fonts.googleapis.com/css?family=Poppins:900" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"><link rel="stylesheet" href="{{ asset('css/myticket.css') }}">
<link rel="stylesheet" href="{{ asset("css/style.css") }}">

</head>
<body>
@extends('layouts\header')
<div class="container">
    @foreach ($tickets as $ticket )
        
  <div class="card ">
    <h3>{{ $ticket->match->name }}</h3>
    <i class="fas fa-arrow-right"></i>
    <p>{{ $ticket->match->type }}</p>
    <div class="pic"></div>
    <a href="{{ route('ticket', ['ticket' => $ticket]) }}"><button></button></a>
  </div>
  @endforeach
    
</div>

  
</body>
</html>
