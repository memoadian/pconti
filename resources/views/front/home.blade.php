@extends('app')

@section('content')

	<div class="row">
		<div class="col-md-9 col-md-offset-3">
			<div class="flexslider">
				<ul class="slides">
				@if( !$slider->isEmpty() )
					@foreach( $slider as $s )
					<li>
						<img src="{{ asset('/uploads/'.$s->img) }}" />
					</li>
					@endforeach
				@endif
				</ul>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<ul class="tabs">
			<li>Destacados</li>
		</ul>
	
		@if (!$destacados->isEmpty())
		@foreach ($destacados as $d)
		<div class="col-md-3">
			<div class="card">
				<div class="card-image">
					<a href="{{ url('/p/'.$d->id.'/'.$d->slug) }}" title="">
						<img class="img-responsive" src="{{ asset( 'uploads/medium/'.$d->image) }}" alt=""/>
					</a>
					<a 
					href="{{ url('add') }}"
					data-id="{{ $d->id }}"
					data-name="{{ $d->name }}"
					data-price="{{ $d->price }}"
					data-image="{{ $d->image }}"
					data-sku="{{ $d->sku }}"
					class="add-tocart"
					>Agregar al carrito</a>
				</div>
				<div class="card-content">
					<h2>
						<a href="{{ url('/p/'.$d->id.'/'.$d->slug) }}" title="">
						{{ $d->name }}
						</a>
					</h2>

					<p class="price">${{ $d->price }}</p>

					<p>{{ $d->categoria->name }}</p>

				</div>
			</div>
		</div>
		@endforeach
		@else
			No hay productos que mostrar
		@endif
	</div>

	<div class="row">
		<ul class="tabs">
			<li>Ofertas</li>
		</ul>
	
		@if (!$ofertas->isEmpty())
		@foreach ($ofertas as $o)
		<div class="col-md-3">
			<div class="card">
				<div class="card-image">
					<a href="{{ url('/p/'.$o->id.'/'.$o->slug) }}" title="">
						<img class="img-responsive" src="{{ asset( 'uploads/medium/'.$o->image) }}" alt=""/>
					</a>
					<a 
					href="{{ url('add') }}"
					data-id="{{ $o->id }}"
					data-name="{{ $o->name }}"
					data-price="{{ $o->price }}"
					data-image="{{ $o->image }}"
					data-sku="{{ $o->sku }}"
					class="add-tocart"
					>Agregar al carrito</a>
				</div>
				<div class="card-content">
					<h2>
						<a href="{{ url('/p/'.$o->id.'/'.$o->slug) }}" title="">
						{{ $o->name }}
						</a>
					</h2>

					<p class="price">${{ $o->price }}</p>

					<p>{{ $o->categoria->name }}</p>

				</div>
			</div>
		</div>
		@endforeach
		@else
			No hay productos que mostrar
		@endif
	</div>

	<div class="row">
		<ul class="tabs">
			<li>Recientes</li>
		</ul>
	
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
					data-image="{{ $p->image }}"
					data-sku="{{ $p->sku }}"
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