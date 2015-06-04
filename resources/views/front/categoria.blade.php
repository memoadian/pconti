@extends('app')

@section('content')

	<ul class="tabs">
		<li>{{ $categoria->name }}</li>
	</ul>
	<div class="row">
		<div class="col-md-3">
			<h3 class="tag-title">Tags</h3>
			@if( !$tags->isEmpty() )
				@foreach( $tags as $t )
				<ul class="tags">
					<li>
						<a href="{{ url('/categoria/'.$categoria->slug.'?tag='.$t->slug) }}">{{ $t->name }}</a>
					</li>
				</ul>
				@endforeach
			@endif
		</div>
		<div class="col-md-9">
			<div class="row">
			@if (!$productos->isEmpty())
				@foreach ($productos as $p)
				<div class="col-md-4">
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
				<p>
					No hay productos que mostrar
				</p>
			@endif
			</div>
		</div>
	</div>
@endsection