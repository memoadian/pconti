$(document).ready(function(){
	burl = 'http://pconti.dev/appanel/'
	uploads = 'http://pconti.dev/'

	$('.side-nav').slicknav({
		label: '',
	});

	title = $('.page-title').text();
	$('.slicknav_menu').prepend('<p>'+title+'</p>');

	$('#selectable .btn').click(function(e){
		e.preventDefault();
		var cerrar = $('<p>', {class: 'close'});
		cerrar.text('Cerrar');

		var div = $('<div>', {id: 'popup', class: 'popup z-depth-5'});
		if(window.width < 500){
			windowH = window.innerHeight * .5;
			windowW = window.innerWidth * .5;
		}else{
			windowH = window.innerHeight * .9;
			windowW = window.innerWidth * .9;
		}
		div.css({
			width: windowW,
			height: windowH,
			marginTop: -windowH / 2,
			marginLeft: -windowW / 2,
		});

		var content = $('<div>', {class: 'content'});
		
		div.append(cerrar);
		div.append(content);
		$('body').prepend(div);

		var imgs = new Array;
		$.ajax({
			url: burl+'imagenes/json',
			context: document.body
		}).done(function(res) {
			$.each(res, function(i, v){
				imgs += '<img data-id="'+v.id+'" src="'+uploads+'uploads/sq/'+v.url+'">';
			});
			content.append(imgs);
		});

		//no scroll
		$('body').css('overflow', 'hidden');
	});

	$(document).on('click', '.close', function(){
		$('.popup').remove();
		//remove no scroll
		$('body').css('overflow', 'visible');
	});

	$(document).on('click', '.content img', function(){
		var src = $(this).attr('src');
		var id = $(this).attr('data-id');
		var img = $('<img>', {src: src, 'data-id': id});
		var div = $('<div>', {class: 'product-img'});
		var remove = $('<span>', {class: 'remove'});
		var principal = $('<span>', {class: 'principal'});
		var iconClose = $('<i>', {class: 'mdi-navigation-close'});
		var iconAction = $('<i>', {class: 'mdi-action-done'});

		remove.append(iconClose);
		principal.append(iconAction);
		div.append(remove);
		div.append(principal);
		div.append(img);
		$('.imagenes').append(div);

		//actualizamos inputs
		fillImages();
	});

	$(document).on('click', '.remove', function(e){
		e.stopPropagation();
		$(this).closest('div').remove();
		var principal = $(this).closest('.product-img').find('.principal');
		if(principal.hasClass('active')){
			$('[name="image"]').val('');
		}
		//actualizamos inputs
		fillImages();
	});

	$(document).on('click', '.product-img', function(){
		$('.principal, .product-img').removeClass('active');
		$(this).toggleClass('active').find('.principal').toggleClass('active');
		var src = $(this).find('img').attr('src');

		var id = $(this).find('img').attr('data-id');

		$('[name="image"]').val(src+'_'+id);
	});

	function fillImages(){
		var imgs = $('.imagenes img');
		var values = new Array;
		$.each(imgs, function(i, v){
			values.push($(v).attr('data-id')+'_'+$(v).attr('src'));
		});
		var value = values.join();
		$('[name="images"]').val(value);
		if(value.length == 0){
			$('[name="image"]').val('');
		}
	}

	$('input[name="price"]').keyup(function(e){
		unf = $(this).val();
		if ( 
			e.which == 48 ||
			e.which == 49 ||
			e.which == 50 ||
			e.which == 51 ||
			e.which == 52 ||
			e.which == 53 ||
			e.which == 54 ||
			e.which == 55 ||
			e.which == 56 ||
			e.which == 57 ||
			e.which == 96 ||
			e.which == 97 ||
			e.which == 98 ||
			e.which == 99 ||
			e.which == 100 ||
			e.which == 101 ||
			e.which == 102 ||
			e.which == 103 ||
			e.which == 104 ||
			e.which == 105
			) {
			if( unf.length > 2 ){
				var number = numeral(unf).format('0,0[.]00');
				$(this).val(number);
			}
		}
	});

	$('.delete').click(function(){
		var id = $(this).attr('data-id');
		var delItem = $(this);
		swal({
			title: '¿Estás seguro?',   
			text: 'Después de esta acción no podrás recuperar este archivo',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, borrar',
			cancelButtonText: 'No, cancelar!',
				closeOnConfirm: false,
				closeOnCancel: false
		},function(isConfirm) {
			if (isConfirm) {
				$.ajax({
					url: burl+'imagen/eliminar/'+id,
				}).done(function(res){
					$(delItem).closest('.product-img').remove();
					swal(
						'¡Eliminada!',
						res,
						'success'
					);
				});
			} else {
				swal(
					'Cancelado',
					'El archivo no ha sido borrado',
					'error'
				);
			}
		});
	});

	/* Categorías */

	$('input[name="catname"]').keyup(function(e){
		catname = $(this).val();
		$('input[name="slug"]').val( slug( catname ) );
	});

	$('.delete-category').click(function(e){
		e.preventDefault();
		var delItem = $(this).closest('.collection-item');
		var id = $(this).attr('data-id');
		swal({
			title: '¿Estás seguro?',   
			text: 'Los productos de esta categoría, se asignaran a Sin Categoría',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, borrar',
			cancelButtonText: 'No, cancelar!',
				closeOnConfirm: false,
				closeOnCancel: false
		},function(isConfirm) {
			if (isConfirm) {
				$.ajax({
					url: burl+'categoria/eliminar/'+id,
				}).done(function(res){
					$(delItem).remove();
					swal(
						'¡Eliminada!',
						res,
						'success'
					);
				});
			} else {
				swal(
					'Cancelado',
					'El archivo no ha sido borrado',
					'error'
				);
			}
		});
	});

	function slug(str) {
		if (!arguments.callee.re) {
			arguments.callee.re = [/[^a-z0-9]+/ig, /^-+|-+$/g];
		}
		return str.toLowerCase().replace(arguments.callee.re[0], '-').replace(arguments.callee.re[1],'');
	}

	$('select').material_select();
});