<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- bootstrap link -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu') 

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                <i class="fa fa-align-justify"></i>
                                <span>Menu</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav flex-column">
                            <li class="nav-item">
                                    <a class="nav-link" href="/dashboard">
                                        <i class="fa fa-align-justify"></i>
                                        Dashboard
                                    </a>
                                </li>
                                @if(Auth::user()->is_admin !== 1)
                                    <li class="nav-item">
                                        <a class="nav-link" href="/work">
                                            <i class="fa fa-align-justify"></i>
                                        Upload work 
                                        </a>
                                    </li>
                                @endif    

                                <li class="nav-item">
                                    <a class="nav-link" href="/work_show">
                                        <i class="fa fa-align-justify"></i>
                                        Work completed
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>      
        </div>
        <!-- jquery -->
        <script src="{{asset('css/jquery-3.6.0.js')}}" ></script>
        @yield('scripts') 
        <!-- bootstrap js -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <!-- fontawesome -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
       
    </body>
</html>
