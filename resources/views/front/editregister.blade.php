@extends('app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="aviso">
				A esta dirección enviaremos tus pedidos, puedes editarla, pero debes cambiarla antes de hacer el pedido</a>
			</p>
			<form class="checkout" action="{{ url( 'editme/'.$user->id ) }}" method="post" accept-charset="utf-8">
				{!! $errors->first('name', '<p class="error">:message</p>') !!}
				<input type="text" name="name" value="{{ $user->name }}" placeholder="Nombre">

				{!! $errors->first('surname', '<p class="error">:message</p>') !!}
				<input type="text" name="surname" value="{{ $user->surname }}" placeholder="Apellidos">

				{!! $errors->first('email', '<p class="error">:message</p>') !!}
				<input type="text" name="email" value="{{ $user->email }}" placeholder="Correo electrónico">

				{!! $errors->first('password', '<p class="error">:message</p>') !!}
				<input type="password" name="password" value="" placeholder="Contraseña">

				{!! $errors->first('repass', '<p class="error">:message</p>') !!}
				<input type="password" name="repass" value="" placeholder="Repetir Contraseña">

				{!! $errors->first('street', '<p class="error">:message</p>') !!}
				<input type="text" name="street" value="{{ $user->street }}" placeholder="Calle">

				{!! $errors->first('number', '<p class="error">:message</p>') !!}
				<input type="text" name="number" value="{{ $user->number }}" placeholder="Número">

				{!! $errors->first('colony', '<p class="error">:message</p>') !!}
				<input type="text" name="colony" value="{{ $user->colony }}" placeholder="Colonia">

				{!! $errors->first('zip', '<p class="error">:message</p>') !!}
				<input type="text" name="zip" value="{{ $user->zip }}" placeholder="Código postal">

				{!! $errors->first('delegation', '<p class="error">:message</p>') !!}
				<input type="text" name="delegation" value="{{ $user->delegation }}" placeholder="Delegación o Municipio">

				{!! $errors->first('state', '<p class="error">:message</p>') !!}
				<select name="state">
					<option value="">Selecciona un estado</option>
					@foreach( $states as $s )
						@if( $user->state == $s )
						<option value="{{ $s }}" selected>{{ $s }}</option>
						@else
						<option value="{{ $s }}">{{ $s }}</option>
						@endif
					@endforeach
				</select>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-6">
						<input type="submit" name="" value="Guardar Cambios">
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection