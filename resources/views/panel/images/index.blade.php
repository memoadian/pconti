@extends('panel/panel')
@section('content')
	<div class="row">
	@if (!$images->isEmpty())
		@foreach ($images as $i)
		<div class="product-img">
			<span class="delete" data-id="{{ $i->id }}">
				<i class="mdi-navigation-close"></i>
			</span>
			<img src="{{ asset( 'uploads/sq/'.$i->name.'-'.$i->md5.'.'.$i->ext ) }}" data-id="4">
		</div>
		@endforeach
	@endif
		<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
			<a href="{{url('appanel/producto/agregar')}}" class="btn-floating btn-large red">
				<i class="large mdi-content-add"></i>
			</a>
		</div>
	</div>
@stop