<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background: url('https://i.ibb.co/j6Mym5d/8d60e456-5ade-4640-a1d4-50fd11891171.jpg');
            background-size: cover;
            height: 100vh;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <main class="py-4">
        @yield('content')
        @yield('addCSS')

        @if ($errors->has('email') || $errors->has('password'))
            <script>
                Swal.fire({
                    title: "Login Failed",
                    html: "Silahkan hubungi bagian <b>Administrasi Sekolah</b>",
                    icon: "error",
                    confirmButtonText: "OK",
                });
            </script>
        @endif
    </main>
</body>

</html>
