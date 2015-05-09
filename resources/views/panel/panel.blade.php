<!DOCTYPE html>
<html>
<head>
	<title>Panel de control</title>
	<link rel="stylesheet" type="text/css" href="{{asset('panel/css/materialize.min.css')}}">
</head>
<body>
	@if(Auth::check())
	@section('sidebar')
		<header>
			<ul class="side-nav fixed">

				<li class="bold">
					<a href="{{url('/appanel')}}" class="waves-effect waves-teal">
						<i class="mdi-action-home"></i> Inicio
					</a>
				</li>
				<li class="bold">
					<a href="{{url('appanel/productos')}}" class="waves-effect waves-teal">
						<i class="mdi-editor-format-quote"></i> Productos
					</a>
				</li>
				<li class="bold">
					<a href="{{url('appanel/categorias')}}" class="waves-effect waves-teal">
						<i class="mdi-av-videocam"></i> Categorias
					</a>
				</li>

			<li class="separator"></li>

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
			<div class="container">
				@section('content')
				@show
			</div>
		</main>
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{asset('panel/js/materialize.min.js')}}"></script>
</html>