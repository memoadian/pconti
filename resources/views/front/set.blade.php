@extends('app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h3 class="contact-title">Editar Contraseña</h3>
			<form class="checkout" action="{{ url('seteando') }}" method="post" accept-charset="utf-8">
				<input type="hidden" name="token" value="{{ Input::get('token') }}">
				{!! $errors->first('password', '<p class="error">:message</p>') !!}
				<input type="password" name="password" placeholder="Password">
				{!! $errors->first('repass', '<p class="error">:message</p>') !!}
				<input type="password" name="repass" placeholder="Repetir">
				<div class="row">
					<div class="col-md-6 col-md-offset-6">
						<input type="submit" value="Editar Contraseña">
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection