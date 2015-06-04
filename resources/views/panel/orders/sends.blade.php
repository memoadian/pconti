@extends('panel/panel')
@section('content')
<div class="row">

	<ul class="tab-orders">
		<li>
			<a href="{{ url('appanel') }}">
			Pendientes
			</a>
		</li>
		<li>
			<a class="active" href="{{ url('appanel/enviadas') }}">
			Enviadas
			</a>
		</li>
	</ul>
	<ul class="collection">
		@if( !$ordenes->isEmpty() )
			@foreach( $ordenes as $o )
				<li class="collection-item">
					<a class="left" href="{{ url( 'appanel/orden/'.$o->id ) }}">
						{{ $o->usuario->name}} {{$o->usuario->surname }} - total: ${{ $o->total }}
					</a>
					<a href="{{ url( 'appanel/orden/'.$o->id ) }}" data-id="{{ $o->id }}" class="delete-order btn waves-effect waves-light red darken-4">
						Borrar
						<i class="mdi-action-done-all right"></i>
					</a>
					<a href="{{ url('appanel/regresar/'.$o->id) }}" class="btn waves-effect waves-light">
						Pendiente
						<i class="mdi-action-exit-to-app right"></i>
					</a>
				</li>
			@endforeach
		@endif
	</ul>
	
</div>
@stop