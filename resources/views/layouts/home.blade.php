<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" xmlns:v-on="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="{{ $author or '' }}">
    <title>@yield('title') {{ $site_title or '' }} </title>
    <meta name="keywords" content="{{ $site_keywords or '' }}">
    <meta name="description" content="@yield('description') {{ $site_description or '' }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $site_title or '' }}">
    <meta property="og:site_name" content="{{ $site_title or '' }}">
    <meta property="og:description" content="{{ $site_description or '' }}">
    <meta name="theme-color" content="#52768e">
    <link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ mix('css/home.css') }}" rel="stylesheet">
    @include('widget.google_analytics')
</head>
<body>
@if(isset($home_bg_images) && $home_bg_images)
    <div id="home-cover-slideshow">
        <?php
        $images = preg_split('/[\n\r]+/', $home_bg_images);
        shuffle($images);
        ?>
        @foreach ($images as $image)
            <div class="home-cover-img" data-src="{{ $image }}"></div>
        @endforeach
    </div>
@endif
<div class="container">
    <div class="content">
        @yield('content')
    </div>
</div>
@yield('js')
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js"></script>
<script src="{{ mix('js/home.js') }}"></script>
</body>
</html>
