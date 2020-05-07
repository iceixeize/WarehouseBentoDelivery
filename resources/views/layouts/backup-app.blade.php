<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BentoDelivery') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.scss') }}" rel="stylesheet">


    <!-- Date Picker -->
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    {{-- <style>
        h1, h2, h3, h4, h5, h6 {
            font-family: rsu_textregular;
        }
    </style> --}}

    <style>
        .bg-delivery {
            background-color: #F74141;
            color: white;
        }

        .dropdown-menu {
            margin-top: 7px !important;
        }

        .navbar-custom {
            background-color: #DF1E26;
        }
        /* change the brand and text color */
        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-text {
            color: rgba(255,255,255,.8);
        }
        /* change the link color */
        .navbar-custom .navbar-nav .nav-link {
            /* color: rgba(255,255,255,.5); */
            color: rgba(255,255,255,.7);

        }
        /* change the color of active or hovered links */
        .navbar-custom .nav-item.active .nav-link,
        .navbar-custom .nav-item:hover .nav-link {
            color: #ffffff;
        }

        /* .pagination > li {
            color: #F74141 !important;
        }
        .pagination > li > a:focus,
        .pagination > li > a:hover,
        .pagination > li > span:focus,
        .pagination > li.active > a,
        .pagination > li > span:hover {
            z-index: 3;
            color: #ffffff !important;
            background-color: #F74141 !important;
            border-color: #ddd !important;
        } */

        /* .bg-delivery a {
            background-color: #F74141;
            color: white;
        } */
    </style>

<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-danger shadow-sm navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand " href="{{ url('/') }}">
                    {{ config('app.name', 'BentoDelivery') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('manage.dashboard', [$subdomain ?? '']) }}">{{ __('Dashboard') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('manage.choosewarehouse', [$subdomain ?? '']) }}">{{ __('เลือกคลังสินค้า') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="">{{ __('ประกาศถึงลูกค้า') }}</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" data-toggle="dropdown">
                                จัดการออเดอร์
                              </a>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">ออเดอร์ธรรมดา</a>
                                <a class="dropdown-item" href="#">ออเดอร์ตีกลับ</a>
                                <a class="dropdown-item" href="#">ออเดอร์จัดส่งเอง</a>
                                <a class="dropdown-item" href="#">ออเดอร์เก็บเงินปลายทาง</a>

                              </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="">{{ __('จัดการรายการนำสินค้าออก
                                ') }}</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" data-toggle="dropdown">
                                การหักเครดิต
                              </a>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">รายงานการหักเครดิตประจำเดือน</a>
                                <a class="dropdown-item" href="#">รายงานการหักเครดิต</a>
                                <a class="dropdown-item" href="#">การหักเครดิตทั้งหมด</a>
                              </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" data-toggle="dropdown">
                                การเช่า
                              </a>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">การเช่าทั้งหมด</a>
                                <a class="dropdown-item" href="#">รายละเอียดชั้นวาง</a>
                                <a class="dropdown-item" href="#">ชั้นวางที่ไม่มีสินค้า</a>
                              </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" data-toggle="dropdown">
                                สินค้า
                              </a>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">สต็อคสินค้าทั้งหมด</a>
                                <a class="dropdown-item" href="#">Serial</a>
                              </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" data-toggle="dropdown">
                                ปรับจำนวนสต็อค
                              </a>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">ปรับสต็อคสินค้า(Log)</a>
                                <a class="dropdown-item" href="#">ปรับสต็อคสินค้า(Lot qty)</a>
                              </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" data-toggle="dropdown">
                                การตั้งค่า / การจัดการ
                              </a>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">ตั้งค่าคลังสินค้า</a>
                                <a class="dropdown-item" href="#">ตั้งค่าประเภทการเช่า shelf</a>
                                <a class="dropdown-item" href="#">ตั้งค่า config ราคาร้านค้า</a>
                                <a class="dropdown-item" href="#">ตั้งค่า user roles</a>
                                <a class="dropdown-item" href="#">ตั้งค่า user</a>
                                <a class="dropdown-item" href="#">ตั้งค่า portal user</a>
                                <a class="dropdown-item" href="#">ตั้งค่าร้านค้าและสินค้า</a>
                                <a class="dropdown-item" href="#">ตั้งค่ากล่อง</a>
                                <a class="dropdown-item" href="#">ตั้งค่าตัวเลือกการแพ็ค</a>
                                <a class="dropdown-item" href="#">ตั้งค่าราคาการนำสินค้าเข้า</a>
                                <a class="dropdown-item" href="#">ตั้งค่า Shipping Provider</a>
                                <a class="dropdown-item" href="#">การจัดการหมายเลข Tracking</a>
                                <a class="dropdown-item" href="#">การจัดการส่ง Email</a>                                
                              </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" data-toggle="dropdown">
                                รายงาน
                              </a>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">สรุปสินค้าที่มีของไม่พอจัดส่ง</a>
                                <a class="dropdown-item" href="#">ความเคลื่อนไหวของสินค้า</a>
                                <a class="dropdown-item" href="#">สินค้าใกล้หมดอายุ</a>
                                <a class="dropdown-item" href="#">สินค้าใกล้หมด</a>
                                <a class="dropdown-item" href="#">สินค้าชำรุด</a>
                                <a class="dropdown-item" href="#">การจัดส่ง</a>
                                <a class="dropdown-item" href="#">ออเดอร์</a>
                                <a class="dropdown-item" href="#">จังหวัด เขตและแขวง</a>                           
                              </div>
                        </li>

                        {{-- <li class="nav-item">
                            <a class="nav-link " href="{{ route('manage.managecod') }}">{{ __('จัดการออเดอร์เก็บเงินปลายทาง
                                ') }}</a>
                        </li> --}}
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

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
