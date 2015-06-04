@extends('app')

@section('content')
	@if ( !is_null($p) )
		<div class="col-md-5">
			<div id="slider" class="flexslider">
				@if( count( $p->imgs ) > 0 )
				<ul class="slides">
					@foreach( $p->imgs as $img)
					<li>
						<a href="{{ asset('uploads/'.$img->name.'-'.$img->md5.'.'.$img->ext) }}" data-lightbox="example-set">
							<img class="img-responsive" src="{{ asset( 'uploads/medium/'.$img->name.'-'.$img->md5.'.'.$img->ext) }}" alt=""/>
						</a>
					</li>
					@endforeach
				</ul>
				@endif
			</div>
			<div id="carousel" class="flexslider">
				@if( count( $p->imgs ) > 0 )
				<ul class="slides">
					@foreach( $p->imgs as $img)
					<li>
						<img class="img-responsive" src="{{ asset( 'uploads/sq/'.$img->name.'-'.$img->md5.'.'.$img->ext) }}" />
					</li>
					@endforeach
				</ul>
				@endif
			</div>
		</div>
		<div class="col-md-7">
			<h1>
				{{ $p->name }}
			</h1>
			<div class="desc">
				{{ $p->description }}
			</div>
			<p class="single-price">${{ $p->price }}</p>

			<p>
				<a href="{{ url('/categoria/'.$p->categoria->slug) }}" title="">
					{{ $p->categoria->name }}
				</a>
			</p>

			<a 
			href="{{ url('add') }}"
			data-id="{{ $p->id }}"
			data-name="{{ $p->name }}"
			data-price="{{ $p->price }}"
			data-image="{{ $p->image }}"
			data-sku="{{ $p->sku }}"
			class="single-add-tocart"
			>Agregar al carrito</a>
		</div>
	@else
		No hay productos que mostrar
	@endif
@endsection