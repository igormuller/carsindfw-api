<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="Cars in DFW">
        <meta name="description" content="@yield('description', 'Cars in DFW - Cars in Dallas')">

        @if (request()->routeIs('frontend.auth.login'))
            <meta name="robots" content="noindex">
        @endif

        <?php /*
        <meta name="description" content="{{ $metaDescription ?? '' }}">
        <meta property="og:image" content="{{$metaImage}}">
        <meta property="og:title" content="{{$metaTitle}}">
        <meta property="og:description" content="{{$metaDescription}}">
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="{{$metaImageWidth}}">
        <meta property="og:image:height" content="{{$metaImageHeight}}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{URL::current()}}">
*/
?>
        <meta name="grecaptcha-key" content="{{config('recaptcha.v3.public_key')}}">

        <link rel="shortcut icon" href="{{url('/')}}/img/favicon.png" type="image/x-icon">
        <link rel="icon" href="{{url('/')}}/img/favicon.png" type="image/x-icon">

        <title>Cars in DFW @yield('title')</title>

        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        
        <link href="{{url('css/app.css')}}" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>

        @stack('after-styles')

    </head>
    <body class="front" data-spy="scroll" data-target="#top1" data-offset="96">
        <div id="main">
        @include('includes.header')
        @yield('content')
        @include('includes.footer')
        </div>
        <!-- Scripts -->
        @stack('before-scripts')

    
        <script src="{{url('js/jquery.js.download')}}"></script>
    <script src="{{url('js/merged.js')}}"></script>
    <script src="{{url('js/scripts.js.download')}}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    
    
    @stack('after-scripts')
    </body>
</html>
