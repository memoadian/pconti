@extends('panel/panel')
@section('content')
<div class="row">

	<!-- Manejo de errores -->
	@if ($errors->has())
		<?php $output = '' ?>
		@foreach ($errors->all() as $error)
			<?php $output .= $error.'<br>' ?>
		@endforeach
		<script>
		window.onload = function(){
			swal({
				title: 'Verfica lo siguiente',
				html: '<?php echo $output ?>',
				type: 'error'
			});
		};
		</script>
	@endif
	<!-- Manejo de errores -->

	<form action="{{url('appanel/producto/agregando')}}" method="post" class="col s12">
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
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
			<div class="input-field col s6">
				<input type="text" id="sku" name="sku" value="">
				<label for="sku">Clave del producto</label>
			</div>
			<div class="input-field col s6">
				<input type="text" id="price" name="price" value="">
				<label for="price">Precio</label>
			</div>
		</div>
		<div class="row">
			<div class="switch col s6">
				<label>
					<big>
						Disponible
					</big>
				</label><br><br>
				<label>
					No
					<input type="checkbox" name="stock">
					<span class="lever"></span>
					Si
				</label>
			</div>
			<div class="col s6">
				<div class="input-field col s12">
					<input type="text" id="quantity" name="quantity" value="">
					<label for="quantity">Cantidad Disponible</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s6 offset-s6">
				<button class="btn waves-effect waves-light" type="submit" name="action">Agregar producto
					<i class="mdi-content-send right"></i>
				</button>
			</div>
		</div>
	</form>
</div>
@stop