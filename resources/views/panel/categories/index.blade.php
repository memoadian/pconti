@extends('panel/panel')
@section('content')
	<div class="row">
	@if (!$categories->isEmpty())
		@foreach ($categories as $category)
			<div class="col s12 m12 l6">
				<div class="card">
					<div class="card-image">
						@if(count($category->imagenes) > 0)
							<img src="{{$category->imagenes[0]->url}}">
						@else
							<img src="http://dummyimage.com/600x400/B26300/fff" alt="{{$category->name}}">
						@endif
						<span class="card-title">{{$category->name}}</span>
					</div>
					<div class="card-content">
						<p>{{$category->description}}</p>
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
			<a href="{{url('appanel/categoria/agregar')}}" class="btn-floating btn-large red">
				<i class="large mdi-content-add"></i>
			</a>
		</div>
	</div>
@stop