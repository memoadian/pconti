@extends('app')

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="direction">
				<h4>Dirección de envío</h4>
				<b>Calle:</b> {{ $user->street }}<br>
				<b>Número:</b> {{ $user->number }}<br>
				<b>Colonia:</b> {{ $user->colony }}<br>
				<b>Delegacion:</b> {{ $user->delegation }}<br>
				<b>Código Postal:</b> {{ $user->zip }}<br>
				<b>Estado:</b> {{ $user->state }}<br>

				<P>Esta es la dirección que se usará para enviarte el pedido, puedes editarla <a href="{{ url('/registro') }}">click aquí</a></P>
			</div>
			<div class="order">
				<p>SU ORDEN</p>
				<ul class="items">
					
				</ul>
				<ul class="tot">
					<li>Total <span>$0.00</span></li>
				</ul>
			</div>
			<a  href="{{ url('/payment/') }}" class="paypal">
				Pagar con Paypal
			</a>
			<div class="payment"></div>
		</div>
	</div>

@endsection