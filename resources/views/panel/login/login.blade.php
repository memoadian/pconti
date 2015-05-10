@extends('panel/panel')

<div class="row">
<form action="{{ url('appanel/dologin') }}" method="post" class="col s12">
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<div class="row">
		<div class="input-field col s6">
			<input id="username" type="text" name="username">
			<label for="username">Nombre de usuario</label>
		</div>
		<div class="input-field col s6">
			<input id="password" type="password" name="password" class="validate">
			<label for="password">Contraseña</label>
		</div>
		<div class="input-field col s6">
			<button class="btn waves-effect waves-light" type="submit" name="" value="Entrar">Entrar</button>
		</div>
	</div>
</form>
<a href="{{url('/appanel')}}"></a>
</div>