<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @yield('page-specific-css')
    @stack('css')
</head>

<body>
    @include('sweetalert::alert')
    <div class="container auth-container p-5">
        <div class="col-11 col-sm-8 col-md-5 m-auto">
            <div class="card">
                <div class="card-body">
                    @yield('page-content')
                </div>
            </div>
        </div>
    </div>
    @show

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @yield('pagespecific-scripts')
    @stack('scripts')
</body>

</html>