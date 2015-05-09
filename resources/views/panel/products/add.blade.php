@extends('panel/panel')
@section('content')
<div class="row">
	<form action="{{url('appanel/agregando')}}" method="post" class="col s12">
		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="name" name="name" value="">
				<label for="name">Nombre del producto</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<textarea name="description" class="materialize-textarea"></textarea>
				<label for="description">Description</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="sku" name="sku" value="">
				<label for="sku">Clave del producto</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="price" name="price" value="">
				<label for="price">Precio</label>
			</div>
		</div>
		<div class="switch">
			<label>
				No
				<input type="checkbox">
				<span class="lever"></span>
				Si
			</label>
		</div>
	</form>
</div>
@stop