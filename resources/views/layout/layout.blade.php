<!DOCTYPE html>
<html>
<head>
	<title>
		Welcome
	</title>
	<meta name="_token" content="{{ csrf_token() }}"/>
	@include('res.head')
	@yield('customstyle')
</head>
<body>
	@yield('navbar')
	@if (Session::has('error'))
		<div class="session-flash alert-danger">
			{{Session::get('error')}}
		</div>
	@endif
	@if (Session::has('notice'))
		<div class="session-flash alert-info">
			{{Session::get('notice')}}
		</div>
	@endif
	@yield('content')

	@include('res.foot')
	@yield('script')

</body>
</html>