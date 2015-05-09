@extends('panel/panel')
@section('content')
	@if (!$productos->isEmpty())
		@foreach ($productos as $producto)
			@if(count($producto->imagenes) > 0)
				@foreach ($producto->imagenes as $imagen)
					{{$imagen->url}}<br>
				@endforeach
			@endif
			{{$producto->name}}<br>
			{{$producto->description}}<br>
			{{$producto->sku}}<br>
			{{$producto->price}}<br>
			{{$producto->category}}<br>
			{{$producto->stock}}<br>
			{{$producto->quantity}}<br>
		@endforeach
	@endif

	<a href="{{url('appanel/producto/agregar')}}">+</a>
@stop