@extends('panel/panel')
@section('content')
<div class="row">

	<ul class="collection">
		@if( !$clientes->isEmpty() )
			@foreach( $clientes as $c )
				<li href="{{ url('appanel/cliente/'.$c->id) }}" class="collection-item">
					<a class="left" href="{{ url( 'appanel/cliente/'.$c->id ) }}">
						{{ $c->name}} {{$c->surname }}
					</a>
					<a data-id="{{ $c->id }}" class="btn waves-effect waves-light red delete-user">
						Borrar
						<i class="mdi-navigation-close right"></i>
					</a>
					<a href="{{ url( 'appanel/cliente/'.$c->id ) }}" class="btn waves-effect waves-light light-blue darken-4">
						Ver
						<i class="mdi-image-remove-red-eye right"></i>
					</a>
				</li>
			@endforeach
		@endif
	</ul>
	
</div>
@stop