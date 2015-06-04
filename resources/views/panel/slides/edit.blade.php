@extends('panel/panel')
@section('content')
<div class="row">

	<input type="file" id="file" name="file" class="hidden">

	<form action="{{ url('appanel/slider/editando/'.$s->id )}}" method="post" class="col s12">
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
			<div class="imagen">
				
			</div>
		</div>
		<div class="row">
			<input type="hidden" id="img" name="img" value="{{ $s->img }}">
			<div class="input-field col s12">
				<input type="text" id="link" name="link" value="{{ $s->link }}">
				<label for="link">Link</label>
			</div>
		</div>
		<div class="row">
			<div class="col s6 offset-s6">
				<button class="btn waves-effect waves-light right" type="submit" name="action">Editar slide
					<i class="mdi-content-send right"></i>
				</button>
			</div>
		</div>
	</form>
</div>
<script>
window.onload = function(){
	$(document).ready(function(){
		if( $('[name="img"]').val() != '' ){
			src = $('[name="img"]').val();
			createImage('{{ url('/uploads') }}'+'/sq/'+src);
		}

		function createImage(src){
			var img = $('<img>', {src: src});
			var div = $('<div>', {class: 'product-img'});
			var remove = $('<span>', {class: 'remove'});
			var iconClose = $('<i>', {class: 'mdi-navigation-close'});

			remove.append(iconClose);
			div.append(remove);
			div.append(img);
			$('.imagen').append(div);
		}
	});
}
</script>
@stop