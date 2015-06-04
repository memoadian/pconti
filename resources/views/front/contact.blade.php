@extends('app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div id="map"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<h3 class="contact-title">CONTACTO</h3>
			<p class="contact-info">
				<i class="glyphicon glyphicon-map-marker"></i>
				Dirección de peletería continental
			<p>
			<p class="contact-info">
				<i class="glyphicon glyphicon-earphone"></i>
				21 61 xx xx
			</p>
		</div>
		<div class="col-md-8">
			<h3 class="contact-title">MANDA UN MENSAJE</h3>
			<form class="checkout" action="{{ url('contactar') }}" method="post" accept-charset="utf-8">
				{!! $errors->first('name', '<p class="error">:message</p>') !!}
				<input type="text" name="name" placeholder="Nombre" value="{{ old('name') }}">
				{!! $errors->first('email', '<p class="error">:message</p>') !!}
				<input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
				{!! $errors->first('phone', '<p class="error">:message</p>') !!}
				<input type="text" name="phone" placeholder="Teléfono" value="{{ old('phone') }}">
				{!! $errors->first('subject', '<p class="error">:message</p>') !!}
				<textarea name="subject" placeholder="Asunto"></textarea value="{{ old('subject') }}">
				{!! $errors->first('g-recaptcha-response', '<p class="error">:message</p>') !!}
				{!! Recaptcha::render() !!}
				<div class="row">
					<div class="col-md-6 col-md-offset-6">
						<input type="submit" value="Enviar">	
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection