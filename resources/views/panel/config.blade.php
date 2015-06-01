@extends('panel/panel')
@section('content')
<div class="row">

	<form action="{{ url('/appanel/configuracion/editando') }}" method="post" accept-charset="utf-8">
		<div class="row">
			<div class="input-field col s12">
				<input id="paypal-client-id" name="paypal-client-id" type="text" value="{{ $config->paypalClientId }}" placeholder="">
				<label for="paypal-client-id">Paypal Client Id</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input id="paypal-secret-id" name="paypal-secret-id" type="text" value="{{ $config->paypalSecretId }}" placeholder="">
				<label for="paypal-secret-id">Paypal Secret Id</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input id="mailgun" name="mailgun" type="text" value="{{ $config->mailgun }}" placeholder="">
				<label for="mailgun">Mandrill Key</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input id="gmap" name="gmap" type="text" value="{{ $config->gmap }}" placeholder="19.379406, -99.159145">
				<label for="gmap">Google Maps</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<input id="analytics" name="analytics" type="text" value="{{ $config->analytics }}" placeholder="UA-XXXXXXXX-X">
				<label for="analytics">Analytics</label>
			</div>
			<div class="input-field col s6">
				<input id="facebook" name="facebook" type="text" value="{{ $config->facebook }}" placeholder="http://facebook.com/site">
				<label for="facebook">facebook</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<input id="twitter" name="twitter" type="text" value="{{ $config->twitter }}" placeholder="http://twitter.com/site">
				<label for="twitter">Twitter</label>
			</div>
			<div class="input-field col s6">
				<input id="gplus" name="gplus" type="text" value="{{ $config->gplus }}" placeholder="http://plus.google">
				<label for="gplus">Google plus</label>
			</div>
		</div>
		<div class="row">
			<div class="col s6 offset-s6">
				<button class="btn waves-effect waves-light" type="submit" name="action">Guardar configuración
					<i class="mdi-content-send right"></i>
				</button>
			</div>
		</div>
	</form>
</div>
@stop