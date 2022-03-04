<html >
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Cadastro de produtos</title>
<meta name="csrf-token" content="{{ csrf_token()}}">
        <style>
            body{
                padding: 20px;
            }

            .border-primary { 
                border: 1px solid #007bff; 
                 padding: 20px;
            }

            a{
                padding: 20px;
            }


            .navbar{
                margin-bottom: 20px;
            }

            ul#navbar_ul {
                list-style-type: none;
 }
        </style>
</head>
<body>
    <div class="container">
            @component('component_navbar', ["current" => $current])
                
            @endcomponent
            <main class="main"> 
                @hasSection ('body')
                    @yield('body')    
                @endif

            </main>

    </div>
    

        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

        @hasSection("javascript")

        @yield('javascript')

        @endif
        
</body>
</html>