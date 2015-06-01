<!DOCTYPE html>
<?php $config = new \App\Http\Controllers\PanelConfigController ?>
<html>
<head>
	<meta name="charset" content="utf8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<title>{{$title}}</title>

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat" type="text/css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans" type="text/css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway" type="text/css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto" type='text/css'>
	<link rel="stylesheet" type="text/css" href="{{ asset( 'css/bootstrap.min.css' ) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset( 'css/flexslider.css' ) }}">
	<link rel="stylesheet" type="text/css" href="{{ asset( 'css/style.css' ) }}">
</head>
<body>
	<div class="wrapper-header">
		<div class="container">
			<div class="row">
				<!-- header -->
				<header>
					<div class="col-xs-12 col-md-3">
						<h1 class="logo">
							<a href="" title="">
								<img class="img-responsive" src="{{ asset('imgs/logo_conti.png') }}" alt="">
							</a>
						</h1>
					</div>
					<div class="col-xs-12 col-md-9">
						<nav>
							<ul class="menu">
								<li>
									<a href="{{ url('/') }}">Inicio</a>
								</li>
								<li>
									<a href="{{ url('/contacto') }}">Contacto</a>
								</li>
								<li>
									<a href="{{ url('/legal') }}">Políticas</a>
								</li>
								<li>
									<a href="{{ url('/pagar') }}">Pagar</a>
								</li>
								<li>
									<a href="{{ url('/registro') }}">Registro</a>
								</li>
							</ul>
						</nav>
					</div>
					<div class="profile">
						<div class="icon-profile">
							<i class="glyphicon glyphicon-user"></i>
							<div class="poplogin">
								@if( Auth::check() )
								Bienvenido {{ Auth::user()->name }}
								<a class="pagar" href="{{ url('/salir') }}" title="">SALIR</a>
								@else
								<form action="{{ url('dologin') }}" method="post" accept-charset="utf-8">
									<label for="">E-mail</label>
									<input type="text" name="email" value="" placeholder="Correo electrónico">
									<label for="">Contraseña</label>
									<input type="password" name="password" value="" placeholder="Contraseña">
									<input type="submit" name="" value="Entrar">
								</form>
								@endif
							</div>
						</div>
					</div>
					<div class="boxes">
						<div class="icon-shop">
							<i class="glyphicon glyphicon-shopping-cart"></i>
							<div class="popcart">
								<ul>
									<p>No tienes items en tu carrito</p>
									<li class="product">
										<span class="subtotal">0.00</span>
									</li>
								</ul>
								<a class="pagar" href="{{ url('/pagar') }}" title="">PAGAR</a>
							</div>
						</div>
						<span class="count">0</span>
					</div>
				</header>
				<!-- /header -->
			</div>
		</div>
	</div>
	<div class="wrapper-nav">
		<div class="container">
			<!-- NAV SEARCH -->
			<div class="row">
				<div class="search">
					<div class="col-xs-12 col-md-3">
						<div class="row">
							<div class="categories">
								<i class="glyphicon glyphicon-menu-hamburger"></i>
								<span>Categorías</span>
								<i class="glyphicon glyphicon-chevron-down catdown"></i>
								@if( Route::currentRouteName() == 'home' )
								<ul>
								@else
								<ul class="oculto">
								@endif
								@if( !$categorias->isEmpty() )
									@foreach( $categorias as $c )
										@if( $c->id != 1 )
										<li>
											<a href="{{ url('/categoria/'.$c->slug) }}">
												{{ $c->name }}	
											</a>
										</li>
										@endif
									@endforeach
								@endif
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-md-9">
						<form class="searching" action="{{ url('/buscar') }}" method="get" accept-charset="utf-8">
							<input type="text" name="s" value="" placeholder="Buscar">
							<button type="submit">
								<i class="glyphicon glyphicon-search"></i>
							</button>
						</form>
					</div>
				</div>
			</div>
			<!-- /NAV SEARCH -->
		</div>
	</div>
	<div class="wrapper-content">
		<div class="container">
			@yield('content')
		</div>
	</div>
	<div class="wrapper-footer">
		<footer>
			<div class="row">
				<div class="col-md-12">
					<div class="followbar">
						<span class="siguenos">SIGUENOS</span>
						<ul class="social">
							<li>
								<a href="{{ $config->getConfig()->facebook }}">
									F
								</a>
							</li>
							<li>
								<a href="{{ $config->getConfig()->twitter }}">
									T
								</a>
							</li>
							<li>
								<a href="{{ $config->getConfig()->gplus }}">
									G
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</div>
</body>
	<!-- SCRIPTS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('js/flexslider.min.js') }}"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
	<script src="{{ asset('js/functions.js') }}"></script>

	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', '{{ $config->getConfig()->analytics }}', 'auto');
	ga('send', 'pageview');

	</script>

	<script>
	$(document).ready(function(){

		//map
		function initialize() {
			var mapOptions = {
				zoom: 14,
				center: new google.maps.LatLng({{ $config->getConfig()->gmap }}),
				scrollwheel: false,
			}
			var map = new google.maps.Map(document.getElementById('map'), mapOptions);

			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(19.379406, -99.159145),
				map: map,
				title: 'PCONTI!'
			});
		}

		initialize();
	});
	</script>
</html>