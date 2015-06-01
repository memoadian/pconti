@extends('app')

@section('content')

	<ul class="tabs">
		<li>Resultados</li>
	</ul>
	<div class="row">
	@if (!$productos->isEmpty())
		@foreach ($productos as $p)
		<div class="col-md-3">
			<div class="card">
				<div class="card-image">
					<a href="{{ url('/p/'.$p->id.'/'.$p->slug) }}" title="">
						<img class="img-responsive" src="{{ asset( 'uploads/medium/'.$p->image) }}" alt=""/>
					</a>
					<a 
					href="{{ url('add') }}"
					data-id="{{ $p->id }}"
					data-name="{{ $p->name }}"
					data-price="{{ $p->price }}"
					class="add-tocart"
					>Agregar al carrito</a>
				</div>
				<div class="card-content">
					<h2>
						<a href="{{ url('/p/'.$p->id.'/'.$p->slug) }}" title="">
						{{ $p->name }}
						</a>
					</h2>

					<p class="price">${{ $p->price }}</p>

					<p>{{ $p->categoria->name }}</p>

				</div>
			</div>
		</div>
		@endforeach
	@else
		No hay productos que mostrar
	@endif
	</div>
@endsection