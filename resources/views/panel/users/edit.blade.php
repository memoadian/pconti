@extends('panel/panel')
@section('content')
	<div class="row">
		<div class="col s12 m12 l6">
			<form action="{{ asset( 'appanel/usuario/editando'.$usuario->id ) }}" method="post">
				<div class="row">
					<div class="input-field col s12">
						<input id="catname" name="catname" type="text" value="{{ $usuario->name }}">
						<label for="catname">Nombre</label>
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						<button class="btn waves-effect waves-light right" type="submit" name="action">Editar
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