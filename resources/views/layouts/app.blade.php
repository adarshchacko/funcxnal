<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', '') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        @auth
                        <li>
                            <select style="width: 240px;" id="searchbox" name="q" placeholder="Search..." class="form-control"></select>
                        </li>
                        @endauth                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            
                            <?php $image = "/uploads/".Auth::user()->image; ?>                 
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{asset($image) }}" width="30" height="30"> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="/user/{{Auth::user()->id}}">
                                        {{ __('Profile') }}
                                    </a>
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


<!-- Scripts -->
<script type="text/javascript" src='{{ asset('js/app.js') }}'></script>
<script type="text/javascript" src='//code.jquery.com/jquery-1.10.2.min.js'></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src='{{ url("vendor/selectize/js/standalone/selectize.min.js") }}'></script>

<script type="text/javascript">
    var root = '{{url("/")}}';
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#searchbox').selectize({
            valueField: 'url',
            labelField: 'name',
            searchField: ['name'],
            maxOptions: 10,
            options: [],
            create: false,
            render: {
                option: function(item, escape) {
                    //return '<div><img src="'+ item.icon +'">' +escape(item.name)+'</div>';
                    return '<div><img src="/uploads/'+ item.image +'" width="30" height="30"><a href="'+ item.id +'">' + escape(item.name) +'</div>';

                }
            },
            optgroups: [
                {value: 'user', label: 'Users'},
            ],
            optgroupField: 'class',
            optgroupOrder: ['user'],
            load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: '/search',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        q: query
                    },
                    error: function(error) {
                        console.log(error);
                        callback();
                    },
                    success: function(res) {
                        callback(res.data);
                    }
                });
            },
            onChange: function(){
                window.location = this.items[0];
            }
        });
    });    

</script>

@yield('scripts')

</html>
