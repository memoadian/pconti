@extends('panel/panel')
@section('content')
<div class="row">

	<ul class="tab-orders">
		<li>
			<a class="active" href="{{ url('appanel') }}">
			Pendientes
			</a>
		</li>
		<li>
			<a href="{{ url('appanel/enviadas') }}">
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
					<a href="{{ url('appanel/enviar/'.$o->id) }}" class="btn waves-effect waves-light">
						Enviado
						<i class="mdi-navigation-check right"></i>
					</a>
					<a href="{{ url( 'appanel/orden/'.$o->id ) }}" class="btn waves-effect waves-light light-blue darken-4">
						Detalles
						<i class="mdi-image-remove-red-eye right"></i>
					</a>
				</li>
			@endforeach
		@endif
	</ul>
	
</div>
@stop