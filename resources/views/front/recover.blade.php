@extends('app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			@if( Session::has('send-recover') )
				<br>
				<div class="aviso">
					Te hemos enviado un correo para recuperar tu contraseña, revisa tu papelera, a veces puede tardar varios minutos en llegar.				
				</div>
			@endif
			<h3 class="contact-title">Recuperar contraseña</h3>
			<form class="checkout" action="{{ url('recovering') }}" method="post" accept-charset="utf-8">
				<label for="">Coloca tu email y te enviaremos un link para setear tu contraseña</label>
				@if( Session::has('error-recover') )
					<div class="error">
						Este correo no se encuentra en nuestra base de datos
					</div>
				@endif
				<input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
				<div class="row">
					<div class="col-md-6 col-md-offset-6">
						<input type="submit" value="Recuperar">	
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection