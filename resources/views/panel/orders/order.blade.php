@extends('panel/panel')
@section('content')
<div class="row">

	<div class="col s12">
		@if( !is_null($o) )
		<div class="order">
			{!! $o->orden !!}
			<b>Calle:</b> {{ $o->usuario->street }} {{ $o->usuario->number }}<br/>
			<b>Colonia:</b> {{ $o->usuario->colony }}<br/>
			<b>Delegación:</b> {{ $o->usuario->delegation }}<br/>
			<b>Código Postal:</b> {{ $o->usuario->zip }}<br/>
			<b>Estado:</b> {{ $o->usuario->state }}<br/>
		</div>
		<a href="{{ url('appanel/enviar/'.$o->id) }}" class="btn waves-effect waves-light" type="submit" name="action">
			Marcar como enviado
			<i class="mdi-navigation-check right"></i>
		</a>
		@else
			Este pedido no existe
		@endif
	</div>
	
</div>
@stop