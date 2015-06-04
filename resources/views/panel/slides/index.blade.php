@extends('panel/panel')

@section('content')
	<div class="row">
		<div class="col s12">
			<ul class="collection">
			@if( !$slides->isEmpty() )
				<?php $i = 1 ?>
				@foreach( $slides as $s )
				<li class="collection-item">
					<a class="left" href="{{ url( 'appanel/slider/editar/'.$s->id ) }}">
						Slider {{ $i }}
					</a>
					<a href="{{ url('appanel/slider/eliminar/'.$s->id) }}" data-id="{{ $s->id }}" class="delete-slide btn waves-effect waves-light red">
						Borrar
						<i class="mdi-navigation-check right"></i>
					</a>
					<a href="{{ url( 'appanel/slider/editar/'.$s->id ) }}" class="btn waves-effect waves-light light-blue darken-4">
						Editar
						<i class="mdi-image-remove-red-eye right"></i>
					</a>
				</li>
				<?php $i++ ?>
				@endforeach
			@endif
			</ul>
		</div>
		<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
			<a href="{{url('appanel/slider/agregar')}}" class="btn-floating btn-large red">
				<i class="large mdi-content-add"></i>
			</a>
		</div>
	</div>
@stop