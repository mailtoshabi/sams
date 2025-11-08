<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <meta name="title" content="@yield('title', config('app.name'))">

    <!-- Author -->
    <meta name="author" content="Samhitha of Ayurvedic Medical Specialities">

    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/global.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('front/font-awesome/css/all-6.0.0.min.css') }}"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    @if(app()->getLocale() === 'ml')
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Malayalam&display=swap" rel="stylesheet">
    @else
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    @endif

    <!-- Standard favicon -->
    <link rel="icon" href="{{ asset('favicon/favicon.png') }}" type="image/x-icon">

      <!-- Theme Color (browser UI) -->
    <meta name="theme-color" content="#ec1d23">
    @stack('style')
</head>
<body class="d-flex flex-column min-vh-100 locale-{{ app()->getLocale() }}">
    <div id="loading-overlay" style="display: none;">
        <div class="loading-spinner"></div>
    </div>
