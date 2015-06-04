@extends('app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h3 class="contact-title">Entrar</h3>
			<form class="checkout" action="{{ url('dologin') }}" method="post" accept-charset="utf-8">
				@if( Session::has('error-login') )
					<div class="error">
						El correo o contraseña no coinciden
					</div>
				@endif
				<input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
				<input type="password" name="password" placeholder="Password" value="{{ old('email') }}">
				<span style="float:right">
					<a href="{{ url('recover') }}">Recuperar contraseña</a>
				</span>
				<div class="row">
					<div class="col-md-6 col-md-offset-6">
						<input type="submit" value="Enviar">	
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection