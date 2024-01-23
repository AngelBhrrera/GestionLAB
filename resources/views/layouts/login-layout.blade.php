@extends('../layouts/base')

@section('body')
    <body class="login">
    <style>
        /* unvisited link */
        a:link {
        color: rgb(255,92,40);
        }
        /* visited link */
        a:visited {
        color: rgb(255,92,40);
        }
        /* mouse over link */
        a:hover {
        color: rgb(147,36,0);
        }
        /* selected link */
        a:active {
        color: blue;
        }
        .btn-primary{
        background-color:#FF3E00; 
        border-color:#FF3E00;
        }
        .btn-primary:hover{
            color: rgb(147,36,0);
        }
    </style>
    @yield('content')
    <script type="module" src="{{ asset('/build/assets/js/app.6c589841.js')}}"></script>
    @yield('script')
    </body>
@endsection
