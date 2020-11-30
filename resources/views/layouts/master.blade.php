<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta  name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'nunito', san-serif
        }
        body{
            width:100vw;
            height:auto;
           
        }
    </style>
</head>
<body>   
    <div id="app">
        
        @yield('content')
    </div>
    <script src="{{asset('js/app.js')}}"></script>

    <script src="https://kit.fontawesome.com/39c55ca75f.js" crossorigin="anonymous"></script>
   
</body>
</html>