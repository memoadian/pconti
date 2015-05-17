@extends('panel/panel')
@section('content')
<div class="row">

	<!-- Manejo de errores -->
	@if ($errors->has())
		<?php $output = '' ?>
		@foreach ($errors->all() as $error)
			<?php $output .= $error.'<br>' ?>
		@endforeach
		<script>
			swal({
				title: 'Verfica lo siguiente',
				html: '<?php echo $output ?>',
				type: 'error'
			});
		</script>
	@endif
	<!-- Manejo de errores -->

	<div class="col s12 m12 l6">
		<form action="{{ asset( 'appanel/usuario/agregando' ) }}" method="post">
			<div class="row">
				<div class="input-field col s12">
					<input id="username" name="username" type="text" value="">
					<label for="username">Nombre de Usuario</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="mail" name="mail" type="text" value="">
					<label for="mail">Correo</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="name" name="name" type="text" value="">
					<label for="name">Nombre</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="surname" name="surname" type="text" value="">
					<label for="surname">Apellido</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="pass" name="pass" type="password" value="">
					<label for="pass">Contraseña</label>
				</div>
			</div>
			<div class="row">
				<div class="col s6 m6 l6">
					<label>Crear/Editar Usuarios</label>
				</div>
				<div class="switch col s6 m6 l6">
					<label class="right">
						No
						<input type="checkbox" name="stock">
						<span class="lever"></span>
						Si
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col s6 m6 l6">
					<label>Borrar Usuarios</label>
				</div>
				<div class="switch col s6 m6 l6">
					<label class="right">
						No
						<input type="checkbox" name="stock">
						<span class="lever"></span>
						Si
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col s6 m6 l6">
					<label>Crear/Editar Productos</label>
				</div>
				<div class="switch col s6 m6 l6">
					<label class="right">
						No
						<input type="checkbox" name="stock">
						<span class="lever"></span>
						Si
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col s6 m6 l6">
					<label>Borrar Productos</label>
				</div>
				<div class="switch col s6 m6 l6">
					<label class="right">
						No
						<input type="checkbox" name="stock">
						<span class="lever"></span>
						Si
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col s6 m6 l6">
					<label>Crear/Editar Categorías</label>
				</div>
				<div class="switch col s6 m6 l6">
					<label class="right">
						No
						<input type="checkbox" name="stock">
						<span class="lever"></span>
						Si
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col s6 m6 l6">
					<label>Borrar Categorías</label>
				</div>
				<div class="switch col s6 m6 l6">
					<label class="right">
						No
						<input type="checkbox" name="stock">
						<span class="lever"></span>
						Si
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<button class="btn waves-effect waves-light right" type="submit" name="action">Agregar
						<i class="mdi-content-send right"></i>
					</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col s12 m12 l6">
		<ul class="collection">
		@if ( !$usuarios->isEmpty() )
			@foreach ( $usuarios as $u )
			<li class="collection-item">
				<p>
					{{ $u->name }}
				</p>
				@if( $u->id != 1 )
				<a href="{{ url('/') }}" class="btn-floating red delete-category">
					<i class="mdi-navigation-close"></i>
				</a>
				@endif
				<a href="{{ url('appanel/usuario/editar/'.$u->id) }}" class="btn-floating blue lighten-1">
					<i class="mdi-image-edit"></i>
				</a>
			</li>
			@endforeach
		@endif
		</ul>
	</div>
</div>
@stop