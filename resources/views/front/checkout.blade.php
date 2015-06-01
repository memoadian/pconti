@extends('app')

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
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