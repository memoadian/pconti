@extends('panel/panel')
@section('content')
	<div class="row">
	@if (!$productos->isEmpty())
		@foreach ($productos as $producto)
			<div class="col s12 m12 l6">
				<div class="card">
					<div class="card-image">
						@if(count($producto->imagenes) > 0)
							<img src="{{$producto->imagenes[0]->url}}">
						@else
							<img src="http://dummyimage.com/600x400/B26300/fff" alt="{{$producto->name}}">
						@endif
						<span class="card-title">{{$producto->name}}</span>
					</div>
					<div class="card-content">
						<p>{{$producto->description}}</p>
					</div>
					<div class="card-action">
						<a href="#">Editar</a>
						<a href='#'>Borrar</a>
					</div>
				</div>
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