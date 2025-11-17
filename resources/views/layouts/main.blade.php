<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="scroll-restoration" content="manual"> --}}
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/main.css?v12++') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css?v12++') }}">
    <link rel="stylesheet" href="{{ asset('css/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('remixicon/fonts/remixicon.css?v2++') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/other.css') }}"> --}}
</head>

<body>

    <span class="loading" id="loader"><div class="circle"></div></span>

    @include('components.navbar')


    <section class="flex">
        @include('components.sidebar')
        @yield('content')
    </section>

    </div>

    {{-- JAVASCRIPT --}}

    <script src="{{ asset('js/javascript.js?v4++') }}"></script>
</body>

</html>
