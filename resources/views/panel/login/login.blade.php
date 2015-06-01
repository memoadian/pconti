@extends('panel/panel')

<div class="container">
	<div class="row">
		<div class="col s12 m8 offset-m2 l6 offset-l3">
			<div class="card" style="margin-top: 80px;">
				<form class="form-login" action="{{ url('appanel/dologin') }}" method="post" class="col s12">
					<h1>Iniciar sesión</h1>
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<div class="row">
						<div class="input-field col s12">
							<input id="username" type="text" name="username">
							<label for="username">Nombre de usuario</label>
						</div>
						<div class="input-field col s12">
							<input id="password" type="password" name="password">
							<label for="password">Contraseña</label>
						</div>
						<div class="input-field col s8 m8 l5 offset-s4 offset-m4 offset-l7">
							<button class="btn waves-effect waves-light right" type="submit" name="" value="Entrar">	Entrar
							</button>
						</div>
						<a style="text-align:right; display:block; padding:20px 15px 0; clear:both" href="{{url('/appanel')}}">Recuperar Contraseña</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>