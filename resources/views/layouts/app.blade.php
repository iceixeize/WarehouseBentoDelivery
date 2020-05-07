<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BentoDelivery') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.scss') }}" rel="stylesheet">



<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <b-navbar toggleable="lg" type="dark" variant="danger">
            <b-navbar-brand href="#">BentoDelivery</b-navbar-brand>
            
            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
        
            <b-collapse id="nav-collapse" is-nav>
              <b-navbar-nav>
                <b-nav-item href="{{ route('manage.dashboard') }}" active>{{ __('Dashboard') }}</b-nav-item>
                <b-nav-item-dropdown text="จัดการระบบ" left>
                    <b-dropdown-item href="{{ route('users.index') }}">จัดการ User</b-dropdown-item>
                    <b-dropdown-item href="#">จัดการ User Roles</b-dropdown-item>
                    <b-dropdown-item href="#">จัดการ Portal User</b-dropdown-item>
                </b-nav-item-dropdown>
              </b-navbar-nav>
        
              <!-- Right aligned nav items -->
              <b-navbar-nav class="ml-auto">        
                <b-nav-item-dropdown right>
                  <!-- Using 'button-content' slot -->
                  <template v-slot:button-content>
                    {{ Auth::user()->username }} 
                  </template>
                  <b-dropdown-item href="{{ route('users.edit', [Auth::user()->user_id]) }}">Profile</b-dropdown-item>
                  <b-dropdown-item href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</b-dropdown-item>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </b-nav-item-dropdown>
              </b-navbar-nav>
            </b-collapse>
          </b-navbar>

<main class="py-4">
    @yield('content')
</main>
</div>
</body>

<footer>
    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Date Picker -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    


<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

<!-- Laravel Javascript Validation -->
{{-- <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script> --}}


</footer>
</html>
