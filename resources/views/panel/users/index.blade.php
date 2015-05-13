@extends('panel/panel')
@section('content')
	<div class="row">
	@if (!$usuarios->isEmpty())

	@endif
		<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
			<a href="{{url('appanel/usuario/agregar')}}" class="btn-floating btn-large red">
				<i class="large mdi-content-add"></i>
			</a>
		</div>
	</div>
@stop