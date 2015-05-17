@extends('panel/panel')
@section('content')
	<div class="row">
		<div class="col s12 m12 l6">
			<form action="{{ asset( 'appanel/categoria/editando'.$categoria->id ) }}" method="post">
				<div class="row">
					<div class="input-field col s12">
						<input id="catname" name="catname" type="text" value="{{ $categoria->name }}">
						<label for="catname">Nombre</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="slug" placeholder="" name="slug" type="text" value="{{ $categoria->slug }}">
						<label for="slug">Slug</label>
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
			@if (!$categorias->isEmpty())
				@foreach ($categorias as $c)
				<li class="collection-item">
					<p>
						{{ $c->name }}
					</p>
					@if( $c->id != 1 )
					<a href="{{ url('/') }}" class="btn-floating red delete-category">
						<i class="mdi-navigation-close"></i>
					</a>
					@endif
					<a href="{{ url('appanel/categoria/editar/'.$c->id) }}" class="btn-floating blue lighten-1">
						<i class="mdi-image-edit"></i>
					</a>
				</li>
				@endforeach
			@endif
			</ul>
		</div>
	</div>
@stop