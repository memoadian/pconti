@extends('app')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<p class="aviso">Para realizar el pago necesitas registrarte</p>
			<form class="checkout" action="{{url('registrando')}}" method="post" accept-charset="utf-8">
				{!! $errors->first('name', '<p class="error">:message</p>') !!}
				<input type="text" name="name" value="{{ old('name') }}" placeholder="Nombre">

				{!! $errors->first('surname', '<p class="error">:message</p>') !!}
				<input type="text" name="surname" value="{{ old('surname') }}" placeholder="Apellidos">

				{!! $errors->first('email', '<p class="error">:message</p>') !!}
				<input type="text" name="email" value="{{ old('email') }}" placeholder="Correo electrónico">

				{!! $errors->first('password', '<p class="error">:message</p>') !!}
				<input type="password" name="password" value="" placeholder="Contraseña">

				{!! $errors->first('repass', '<p class="error">:message</p>') !!}
				<input type="password" name="repass" value="" placeholder="Repetir Contraseña">

				{!! $errors->first('street', '<p class="error">:message</p>') !!}
				<input type="text" name="street" value="{{ old('street') }}" placeholder="Calle">

				{!! $errors->first('number', '<p class="error">:message</p>') !!}
				<input type="text" name="number" value="{{ old('number') }}" placeholder="Número">

				{!! $errors->first('colony', '<p class="error">:message</p>') !!}
				<input type="text" name="colony" value="{{ old('colony') }}" placeholder="Colonia">

				{!! $errors->first('zip', '<p class="error">:message</p>') !!}
				<input type="text" name="zip" value="{{ old('zip') }}" placeholder="Colonia">

				{!! $errors->first('delegation', '<p class="error">:message</p>') !!}
				<input type="text" name="delegation" value="{{ old('delegation') }}" placeholder="Delegación o Municipio">

				{!! $errors->first('state', '<p class="error">:message</p>') !!}
				<select name="state">
					<option value="">Selecciona un estado</option>
					@foreach( $states as $s )
						@if( old('state') == $s )
						<option value="{{ $s }}" selected>{{ $s }}</option>
						@else
						<option value="{{ $s }}">{{ $s }}</option>
						@endif
					@endforeach
				</select>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-6">
						<input type="submit" name="" value="Registrarse">
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection