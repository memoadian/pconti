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

	@if( !empty($p) )
		<!-- Manejo de errores -->
		<input type="file" id="file" name="file" class="hidden">

		<form action="{{ url('appanel/producto/editando/'.$p->id) }}" method="post" class="col s12">
			<div class="row">
				<div class="col s12 m12 l6">
					<div id="droppeable" class="card-panel grey lighten-5 z-depth-1 upload">
						<div class="response">
							<div class="progress">
								<div id="uploadStatus" class="determinate" style="width: 70%"></div>
							</div>
						</div>
						<div class="options">
							<button id="ajaxdrop" data-upload="{{ url('appanel/imagen/upload') }}" class="openFile btn col s10 offset-s1">Sube o arrastra una imágen</button>
						</div>
					</div>
				</div>
				<div class="col s12 m12 l6">
					<div id="selectable" class="card-panel grey lighten-5 z-depth-1 upload">
						<div class="options">
							<a href="#" class="btn col s10 offset-s1">Escoge una imágen</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="imagenes">
					
				</div>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input type="text" id="name" name="name" value="{{ $p->name }}">
					<label for="name">Nombre del producto</label>
				</div>
				<div class="input-field col s6">
					<select name="category">
						@foreach( $categorias as $c )
							@if( $p->id_category == $c->id )
							<option value="{{ $c->id }}" selected>{{ $c->name }}</option>}
							@else
							<option value="{{ $c->id }}">{{ $c->name }}</option>}
							@endif
						@endforeach
					</select>
					<label>Categorías</label>
				</div>
			</div>
			<div class="row">
				@if( !empty($p->image) )
				<input type="hidden" name="image" value="{{ asset('uploads/sq/'.$p->image.'_'.$p->id) }}">
				@else
				<input type="hidden" name="image" value="">
				@endif
				<?php
					$imgs = array();
					foreach( $p->imgs as $img ){
						$url = asset('uploads/sq/'.$img->name.'-'.$img->md5.'.'.$img->ext);
						$urlWid = $img->id.'_'.$url;
						array_push($imgs, $urlWid);
					}
					$value = implode(',', $imgs);
				?>
				<input type="hidden" name="images" value="{{ $value }}">
			</div>
			<div class="row">
				<div class="input-field col s12">
					<textarea name="description" class="materialize-textarea">{{ $p->description }}</textarea>
					<label for="description">Description</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<?php 
						$string = '';
						$count = count( $p->tags );
						$i = 1;
					?>
					@foreach( $p->tags as $t )
						<?php
							if( $i < $count  ){
								$string .= $t->id.'_'.$t->name.',';
							}else{
								$string .= $t->id.'_'.$t->name;
							}
							$i++;
						?>
					@endforeach
					<input type="hidden" name="tags" value="{{ $string }}">
					<input type="text" class="create-tags" name="create-tags">
					<label for="create-tags">Tags</label>
				</div>
				<div class="listags">
					<ul>

					</ul>
				</div>
			</div>
			<div class="row">
				<ul class="tags">
					
				</ul>
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input type="text" id="sku" name="sku" value="{{ $p->sku }}">
					<label for="sku">Clave del producto</label>
				</div>
				<div class="input-field col s6">
					<input type="text" id="price" name="price" value="{{ $p->price }}">
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
						@if( $p->stock == 0 )
						<input type="checkbox" name="stock">
						@else
						<input type="checkbox" name="stock" checked>
						@endif
						<span class="lever"></span>
						Si
					</label>
				</div>
				<div class="col s6">
					<div class="input-field col s12">
						<input type="text" id="quantity" name="quantity" value="{{ $p->quantity }}">
						<label for="quantity">Cantidad Disponible</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<p>
						@if( $p->supply == 0 )
							<input type="checkbox" id="supply" name="supply" />
						@else
							<input type="checkbox" id="supply" name="supply" checked />
						@endif
						<label for="supply">Oferta</label>
					</p>
					<p>
						@if( $p->outstanding == 0 )
							<input type="checkbox" id="outstanding" name="outstanding" />
						@else
							<input type="checkbox" id="outstanding" name="outstanding" checked />
						@endif
						<label for="outstanding">Destacado</label>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col s6 offset-s6">
					<button class="btn waves-effect waves-light" type="submit" name="action">Guardar Cambios
						<i class="mdi-content-send right"></i>
					</button>
				</div>
			</div>
		</form>
	@else
		No existe este producto
	@endif
</div>
<script>
window.onload = function(){
	$(document).ready(function(){
		if( $('[name="images"]').val() != '' ){
			values = $('[name="images"]').val();
			arrayValues = values.split(',');
			$.each(arrayValues, function(i, v){
				arraySrcs = v.split('_');
				createImage(arraySrcs[1], arraySrcs[0], false);
			});
		}else{
			$('[name="image"]').val('');
		}

		if( $('[name="tags"]').val() != '' ){
			values = $('[name="tags"]').val();
			arrayValues = values.split(',');
			$.each(arrayValues, function(i, v){
				arraySrcs = v.split('_');
				createTag(arraySrcs[1], arraySrcs[0]);
			});
		}

		function createImage(src, id, principal){
			var img = $('<img>', {src: src, 'data-id': id});
			var div = $('<div>', {class: 'product-img'});
			var remove = $('<span>', {class: 'remove'});
			var principal = $('<span>', {class: 'principal'});
			var iconClose = $('<i>', {class: 'mdi-navigation-close'});
			var iconAction = $('<i>', {class: 'mdi-action-done'});

			if(principal == true){
				remove.addClass();
			}

			remove.append(iconClose);
			principal.append(iconAction);
			div.append(remove);
			div.append(principal);
			div.append(img);
			$('.imagenes').append(div);

			if( $('[name="image"]').val() != '' && $('[name="images"]').val() != ''){
				active = $('[name="image"]').val();
				active = active.split('_');
				$('img[src="'+active[0]+'"]').siblings('.principal').addClass('active').parent().addClass('active');
			}
		}

		function createTag(name, id){
			var li = $('<li>', {class: 'tag', 'data-name': name, 'data-id': id});
			var span = $('<span>');
			var close = $('<i class="mdi-content-clear closetag right"></i>');
			span.text(name);
			
			span.append(close);
			li.append(span);
			$('.tags').append(li);
		}
	});
}
</script>
@stop