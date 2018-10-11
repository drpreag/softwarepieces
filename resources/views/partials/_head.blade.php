
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="@yield('description')">
		<meta name="keywords" content="software, pieces, open, source, opensource, shared, news, blog, @yield('keywords')">		
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<!-- CHANGE THIS TITLE FOR EACH PAGE -->
		<title>SoftwarePieces @yield('title')</title> 

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


		{{ Html::style('/css/styles.css') }}
		
		<link rel="icon" href="{!! asset('/img/favicon.ico') !!}"/>
		<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,600,400italic,700' rel='stylesheet' type='text/css'>
	
		<!-- Icomoon Icon Fonts-->
		<link rel="stylesheet" href="/css/icomoon.css">
		@yield('stylesheets')