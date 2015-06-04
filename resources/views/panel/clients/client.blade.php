@extends('panel/panel')
@section('content')
<div class="row">
	
	<div class="col s12">
		<div class="order">
			<h2 style="margin: 0 5px 20px">{{ $c->name }} {{$c->surname}}</h2>

			<b>Calle:</b> {{ $c->street }} {{ $c->number }}<br/>
			<b>Colonia:</b> {{ $c->colony }}<br/>
			<b>Delegación:</b> {{ $c->delegation }}<br/>
			<b>Código Postal:</b> {{ $c->zip }}<br/>
			<b>Estado:</b> {{ $c->state }}<br/>
		</div>
	</div>
	<div class="col s12">
		<a data-id="{{ $c->id }}" class="btn waves-effect waves-light red delete-user right">
			Borrar
			<i class="mdi-navigation-close right"></i>
		</a>
	</div>
	
</div>
@stop