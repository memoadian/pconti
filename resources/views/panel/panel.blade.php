<!DOCTYPE html>
<html>
<head>
	<title>Panel de control</title>
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<meta name="_token" content="{{ csrf_token() }}" />

	<!-- STYLES -->
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="{{asset('panel/css/sweetalert2.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('panel/css/materialize.css')}}">

	<!-- SCRIPTS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="{{ asset('panel/js/materialize.min.js' )}}"></script>
	<script src="{{ asset('panel/js/sweetalert2.js') }}"></script>
	<script src="{{ asset('panel/js/numeral.min.js') }}"></script>
	<script src="{{ asset('panel/js/dnn.upload.js') }}"></script>
	<script src="{{ asset('panel/js/slicknav.js') }}"></script>
	<script src="{{ asset('panel/js/functions.js') }}"></script>
</head>
<body>
	<!-- SIDEBAR -->
	@if(Auth::check())
	@section('sidebar')
		<header>
			<ul class="side-nav fixed">
				<li class="bold">
					<a href="{{url('/')}}" target="_blanck" class="waves-effect waves-teal">
						<i class="mdi-action-shopping-basket"></i> Tienda
					</a>
				</li>

			<li class="separator"></li>

				<li class="bold">
					<a href="{{url('/appanel')}}" class="waves-effect waves-teal">
						<i class="mdi-action-home"></i> Inicio
					</a>
				</li>
				<li class="bold">
					<a href="{{url('appanel/productos')}}" class="waves-effect waves-teal">
						<i class="mdi-action-shopping-cart"></i> Productos
					</a>
				</li>
				<li class="bold">
					<a href="{{url('appanel/categorias')}}" class="waves-effect waves-teal">
						<i class="mdi-content-sort"></i> Categorias
					</a>
				</li>
				<li class="bold">
					<a href="{{url('appanel/tags')}}" class="waves-effect waves-teal">
						<i class="mdi-action-loyalty"></i> Tags
					</a>
				</li>
				<li class="bold">
					<a href="{{url('appanel/imagenes')}}" class="waves-effect waves-teal">
						<i class="mdi-image-camera-alt"></i> Imágenes
					</a>
				</li>
				<li class="bold">
					<a href="{{url('appanel/usuarios')}}" class="waves-effect waves-teal">
						<i class="mdi-action-account-child"></i> Usuarios
					</a>
				</li>

			<li class="separator"></li>

				<li class="bold">
					<a href="{{url('appanel/clientes')}}" class="waves-effect waves-teal">
						<i class="mdi-editor-attach-money"></i> Clientes
					</a>
				</li>
				<li class="bold">
					<a href="{{url('appanel/configuracion')}}" class="waves-effect waves-teal">
						<i class="mdi-action-settings"></i> Configuración
					</a>
				</li>

			<li class="separator"></li>

				<li class="bold">
					<a href="{{url('appanel/logout')}}" class="waves-effect waves-teal">
						<i class="mdi-action-exit-to-app"></i> Salir
					</a>
				</li>
			</ul>
		</header>
	@show
	@endif

	<div class="row">
		<main>
			<!-- NAV -->
			@if(Auth::check())
			<nav class="top-nav">
				<div class="container">
					<div class="nav-wrapper">
						<h5>
							<a class="page-title">{{$title}}</a>
						</h5>
					</div>
				</div>
			</nav>
			@endif

			<!-- CONTENIDO -->
			<div class="container">
				@section('content')
				@show
			</div>

			<!-- CONTENIDO FLUIDO -->
			@section('fluid-content')
			@show
		</main>
	</div>
</body>
</html>