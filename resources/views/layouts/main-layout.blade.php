<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8;" />
	<meta name="description" content="{{ $description }}" />
	<meta name="keywords" content="{{ $keywords }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>{{ config('app.name') }} - {{ $title }}</title>
	<link type="text/css" rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
	<link type="text/css" rel="stylesheet" href="{{ asset('/css/style.css') }}" /> 
	
	<link rel="icon" href="/favicon.ico">
	<link rel="icon" href="/images/favicons/favicon-32x32.png" type="image/svg+xml">
	<link rel="apple-touch-icon" href="/images/favicons/apple-touch-icon.png">
	<link rel="manifest" href="/site.webmanifest">
</head>
<body>
	<header id="header">	
		@include('layouts.header')
	</header>
	<main id="main">
		{{ $center }}
	</main>
	<footer id="footer">
		@include('layouts.footer')
	</footer>
	@include('layouts.scripts')
</body>
</html>