<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Kingadressedverses</title>

	<link href="/css/app.css" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Navigation anzeigen</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Kingadressedverses</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Lieder <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/') }}">alle anzeigen</a></li>
								@if (Auth::check())
									<li role="presentation" class="dropdown-header">Admin Tools</li>
									<li><a href="{{ url('/song/trash') }}">Papierkorb</a></li>
									<li><a href="{{ url('/song/create') }}">Lied hinzufügen</a></li>
								@endif
							</ul>
					</li>
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Kategorien <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							@foreach ($categories as $category)
								<li><a href="/category/{{ $category->id }}">{{ $category->name }}</a></li>
							@endforeach
						</ul>
					</li>
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Komponisten <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							@foreach ($composers as $composer)
								<li><a href="/composer/{{ $composer->id }}">{{ $composer->name }}</a></li>
							@endforeach
						</ul>
					</li>
					<li>
						<a href="#" class="dropdown-toggle navigation-divider" data-toggle="dropdown" role="button" aria-expanded="false">Besetzungen <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							@foreach ($orchestrations as $orchestration)
								<li><a href="/orchestration/{{ $orchestration->id }}">{{ $orchestration->name }}</a></li>
							@endforeach
						</ul>
					</li>
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Gedichte <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/poem">alle anzeigen</a></li>
							@if (Auth::check())
								<li role="presentation" class="dropdown-header">Admin Tools</li>
								<li><a href="{{ url('/poem/trash') }}">Papierkorb</a></li>
								<li><a href="{{ url('/poem/create') }}">Gedicht hinzufügen</a></li>
							@endif
						</ul>
					</li>
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Autoren <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							@foreach ($authors as $author)
								<li><a href="/author/{{ $author->id }}">{{ $author->name }}</a></li>
							@endforeach
						</ul>
					</li>
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Themen <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							@foreach ($topics as $topic)
								<li><a href="/topic/{{ $topic->id }}">{{ $topic->name }}</a></li>
							@endforeach
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::check())
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@else
						<li><a href="/auth/login">Login</a></li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
	<script src="/js/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

	@yield('footerJs')

</body>
</html>
