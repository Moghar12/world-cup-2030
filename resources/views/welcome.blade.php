@php
use App\Models\news;
use App\Models\matchs;
use App\Models\field;
use App\Models\team;


    $teams = team::all();
    $fields = field::all();
    $matchs = matchs::all();
     $news =news::all();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
          
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>World Cup </title>
        <link rel="icon" type="image/x-icon" href="{{ asset("css/3.png") }}">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- custom css file link  -->
        <link rel="stylesheet" href="{{ asset("css/style.css") }}">
         <!-- Fonts -->
         <link rel="preconnect" href="https://fonts.bunny.net">
         <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    
    <body>    
      @extends('layouts.header')
        {{-- <!-- header section starts  -->
        <header class="header">
    
            <a href="#" class="logo"> World Cup 2030 </a>
    
            <nav class="navbar">
                <a href="#home" class="active">home</a>
                <a href="#matches">matches</a>
                <a href="#Groups">Groups</a>
                <a href="#stadiums">stadiums</a>
                @if (Auth()->check())
                  
                @if (Auth()->user()->role == 0)
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('myticket') }}" :active="request()->routeIs('myticket')">
                        {{ __('my tickets') }}
                    </x-nav-link>
                </div>
                @endif
                @if (Auth()->user()->role == 1)
               
                    <x-nav-link href="/admin" :active="request()->routeIs('myticket')">
                        {{ __('admin panel') }}
                    </x-nav-link>
            
                @endif
                @endif
            </nav>
            <div class="navbar">
           @auth
          <div class="dropdown">
            <button class="dropbtn">{{ Auth()->user()->name }}</button>
            <div class="dropdown-content">
              <a href="{{ route('profile.show') }}">Profile</a>
              <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
               <input type="submit"  value="{{ __('Log Out') }}" @click.prevent="$root.submit();">
            </form>
            </div>
          </div>
               @else
               
                <a href="{{ route('login') }}" >Log in</a>
                <a href="{{ route('register') }}">Register</a>
           @endauth
        </div>
        </header>
        <!-- header section ends --> --}}
    
    
    
        <!-- home section starts  -->
        <section class="home" id="home">

            <div class="swiper home-slider">
                <div class="swiper-wrapper">
    @foreach ( $news as $new ) 
    <div class="swiper-slide box" style="background: url({{ $new->image }});">
        <a href="{{ $new->description }} " target="_blank">
            <div class="content">
                <h3>{{ $new->title }}</h3>
                {{-- <p>32 teams</p> --}}
            </div>
        </a>
    </div>
    @endforeach
    
                    
    
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
    
            </div>
    
        </section>
        <!-- home section ends -->
    
    
    
    
        <!-- matches section starts  -->
        <section class="matches" id="matches">
            <div class="container">
                <h1 class="section-heading" style="text-align: center;"> <a href="/match" style="color: black">matches</a></h1>
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
                        </div>
                        @endforeach
                   
        </section>
        <!-- matches section ends -->
    
    {{-- knockout --}}
    <img src="{{ asset('img/knockout.jpg') }}" alt="">
    
        <!-- Groups section starts  -->
        <section class="Groups" id="Groups">
            <section id="points">
                <div class="container">
                    <h2 class="standings-subheading" style="text-align: center;">Group Stage Points Table</h2>
                    <h3 class="loader">points table is loading...</h3>
                    <div class="points-container"></div>
                </div>
            </section>
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            <script >
              async function fetchPoints() {
  let points_wrapper = document.querySelector('.points-container');
  let loader = document.querySelector('.loader');
  let teams = <?php echo json_encode($teams); ?>; // get the teams array from PHP
  setTimeout(() => {
    loader.remove();
    // group teams by group using reduce
    let groups = teams.reduce((acc, team) => {
      if (!acc[team.group]) {
        acc[team.group] = { group: team.group, teams: [] };
      }
      acc[team.group].teams.push({
        flag: team.flag,
        Team: team.name,
      });
      return acc;
    }, {});
    // sort groups alphabetically
    let sortedGroups = Object.values(groups).sort((a, b) => a.group.localeCompare(b.group));
    // sort teams in each group by rank
    sortedGroups.forEach((group) => {
      group.teams.sort((a, b) => {
        return a.rank - b.rank;
      });
    });
    // render points table for each group
    sortedGroups.forEach((group) => {
      points_wrapper.innerHTML += `
        <div class="points-table">
          <h1 class="group-heading">${group.group}</h1>
          <table>
            <thead>
              <tr>
                <th>Team</th>
                <th>MP</th>
                <th>L</th>
                <th>D</th>
                <th>W</th>
                <th>Pts</th>
              </tr>
            </thead>
            <tbody>
              ${group.teams
                .map(
                  (team) => `
                    <tr>
                      <td>
                        <div class="d-a">
                          <img
                            src="${team.flag}"
                            alt="${team.Team}"
                            class="team-flag"
                          />
                          <span>${team.Team}</span>
                        </div>
                      </td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                    </tr>
                  `
                )
                .join('')}
            </tbody>
          </table>
        </div>
      `;
    });
  }, 1000);
}

fetchPoints();

            </script>
    
        </section>
        <!-- Groups section ends -->
    
    
    
        <!-- stadiums section starts  -->
        <section class="stadiums" id="stadiums">
            <h2>stadiums</h2>
            <div class="container swiper">
                <div class="slide-container">
                    <div class="card-wrapper swiper-wrapper">
                     
                    
                      
    
                        @foreach ( $fields as $field )
                        <div class="card swiper-slide">
                            <div class="image-box">
                              <a href="{{ route('stadium', ['field' => $field]) }}">
                                <img src="{{ $field->image }}" alt="" />
                              </a>
                            </div>
                            <div class="stadium-details">
                                <div class="name-job">
                                    <h3 class="name">{{ $field->name }}</h3>
                                    <h4 class="capacity">{{ $field->location }}</h4>
                                    <h4 class="capacity">capacity:{{ number_format($field->capacity, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                      
                        @endforeach
    
                       
                        
                    </div>
                </div>
                <div class="swiper-button-next swiper-navBtn"></div>
                <div class="swiper-button-prev swiper-navBtn"></div>
            </div>
        </section>
        <!-- stadiums section ends -->
    
    
    
        <!-- footer section starts -->
        <footer>
    
            <p style=" font-size: 15px ; color: whitesmoke; font-weight: 400;">FIFA PARTNERS:</p>
            <div class="column">
                <img src="{{ asset("img/adidas.webp") }}" alt="Sponsor logo">
                <img src="{{ asset("img/cocacola.webp") }}" alt="Sponsor logo">
                <img src="{{ asset("img/visa.webp")}}" alt="Sponsor logo">
                <img src="{{ asset("img/budweiser.webp")}}" alt="Sponsor logo">
                <img src="{{ asset("img/hisence.webp")}}" alt="Sponsor logo">
                <img src="{{ asset("img/mcdonalds.webp")}}" alt="Sponsor logo">
                <img src="{{ asset("img/qatarairways.webp")}}" alt="Sponsor logo">
                <img src="{{ asset("img/qnb.webp")}}" alt="Sponsor logo">
            </div>
            
        </footer>
        <!-- footer section ends -->
    
    
        <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    
        <!-- custom js file links  -->
        <script src="{{ asset("js/script.js") }}"></script>
        <script src="{{ asset("js1/script.js")}}"></script>

    
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init({
                delay: 400,
                duration: 800
            });
        </script>
    
    </body>
</html>
