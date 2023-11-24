<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Favvert Official</title>
    @stack('style')
</head>
<body>
    @include('partial.header')
    @include('partial.sidebar')

    @yield('content')

    @include('partial.footer')

    @stack('script')
</body>
</html>