@extends('app')

@section('content')

@if(!$products->isEmpty())
	@foreach($products as $product)
		{{$product->name}}
	@endforeach
@endif

@endsection