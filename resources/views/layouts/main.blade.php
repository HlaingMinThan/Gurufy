<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Agriculture project management">
    <meta name="author" content="yasshas">
    <meta name="keywords" content="bangladesh, agriculture, project, management, software, accounting, erp, automation">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="/img/icons/icon-48x48.png" />

    <title>@yield('title')</title>

    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    @yield('main_css')
</head>

<body>
    <div class="wrapper">

        @yield('main_content')

    </div>

    <script src="/js/app.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        window.csrf_token = "{{ csrf_token() }}";
        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': window.csrf_token
        };
    </script>


    @yield('main_js')

</body>

</html>