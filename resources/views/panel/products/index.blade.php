@extends('panel/panel')
@section('fluid-content')
	<div class="row">
	@if (!$productos->isEmpty())
		@foreach ($productos as $p)
			<div class="col s12 m12 l4">
				<div class="card">
					<div class="card-image">
						@if( $p->image != '' )
							<img src="{{ asset('uploads/small/'.$p->image) }}">
						@else
							<img src="http://dummyimage.com/600x400/B26300/fff" alt="{{$p->name}}">
						@endif
						<span class="card-title"></span>
					</div>
					<div class="card-content">
						<h5>{{$p->name}}</h5>
						<p>{{$p->description}}</p>
					</div>
					<div class="card-action">
						<a href="{{ url('appanel/producto/editar/'.$p->id) }}" class="btn waves-effect waves-light blue lighten-1">
							Editar
							<i class="mdi-image-edit right"></i>
						</a>
						<a href="{{ url('/') }}" class="btn waves-effect waves-light red">
							Borrar
							<i class="mdi-navigation-cancel right"></i>
						</a>
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