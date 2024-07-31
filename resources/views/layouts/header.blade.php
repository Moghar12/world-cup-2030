 <!-- header section starts  -->
 <header class="header">
    
    <a href="/" class="logo"> World Cup 2030 </a>

    <nav class="navbar">
        <a href="#home" class="active">home</a>
        <a href="#matches">matches</a>
        <a href="#Groups">Groups</a>
        <a href="#stadiums">stadiums</a>
        <a href="teams">teams</a>

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
<!-- header section ends -->