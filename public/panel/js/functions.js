$(document).ready(function(){
	burl = 'http://pconti.dev/appanel/'
	uploads = 'http://pconti.dev/'

	$('.side-nav').slicknav({
		label: '',
	});

	//tags
	$('.alf li').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
	});

	$('.create-tags').keydown(function(e){
		if( e.keyCode == 13 ){
			e.preventDefault();
		}
		var active = $('.listags li').filter('.active');

		if( e.keyCode == 40 ){
			if ( ! active.length || active.is(':last-child') ) {
				$('.listags li.active').removeClass('active');
				$('.listags li').eq(0).addClass('active');
			}else{
				$('.listags li.active').next().addClass('active').siblings().removeClass('active');
			}
		}

		if( e.keyCode == 38 ){
			if ( ! active.length || active.is(':first-child') ) {
				$('.listags li.active').removeClass('active');
				$('.listags li').last().addClass('active');
			}else{
				$('.listags li.active').prev().addClass('active').siblings().removeClass('active');
			}
		}
	});

	$('.create-tags').keyup(function(e){
		if( e.keyCode == 13 ){
			e.preventDefault();
			var value = $(this).val()

			if( value.length != '' ){
				if( $('.listags li.active').length ){
					var name = $('.listags li.active').find('a').text();
					var id = $('.listags li.active').attr('data-id');
					var li = $('<li>', {class: 'tag', 'data-name': name, 'data-id': id});
					var span = $('<span>');
					var close = $('<i class="mdi-content-clear closetag right"></i>');
					span.text(name);
					
					span.append(close);
					li.append(span);
					$('.tags').append(li);
					$('.create-tags').val('');

					$('.listags ul').empty();

					fillTags();
				}else{
					e.preventDefault();
					var obj = $(this);
					$('.create-tags').attr('disabled', 'disabled').css({
						'background': 'url('+uploads+'panel/imgs/ajax-loader.gif) no-repeat center right',
					});

					$.ajax({
						url: burl+'tag/agregando',
						method: 'post',
						data: {name: value}
					}).done(function(res){
						var li = $('<li>', {class: 'tag', 'data-name': res.name, 'data-id': res.id});
						var span = $('<span>');
						var close = $('<i class="mdi-content-clear closetag right"></i>');
						span.text(res.name);
						
						span.append(close);
						li.append(span);
						$('.tags').append(li);
						obj.val('');

						$('.listags ul').empty();
						$('.create-tags').removeAttr('disabled').css({
							'background-image': 'none',
						});

						fillTags();
					});
				}
			}
		}else if( e.keyCode == 40 || e.keyCode == 38 ){
			e.preventDefault();
		}else{
			var obj = $(this);
			var value = $(this).val();

			if(value.length >= 2){
				$.ajax({
					url: burl+'tags/json',
					method: 'get',
					data: {search: value}
				}).done(function(res){
					$('.listags ul').empty();
					$.each(res, function(i, v){
						var a = $('<a>');
						var li = $('<li>', {class: 'litag', 'data-name': v.name, 'data-id': v.id});
						
						a.text(v.name);
						li.append(a);

						$('.listags ul').append(li);

						$('.listags li').first().addClass('active').siblings().removeClass('active');
					});
				});
			}else{
				$('.listags ul').empty();
			}
		}
	});

	$(document).on('click', '.litag', function(){
		var name = $(this).find('a').text();
		var li = $('<li>', {class: 'tag', 'data-name': name});
		var span = $('<span>');
		var close = $('<i class="mdi-content-clear closetag right"></i>');
		span.text(name);
		
		span.append(close);
		li.append(span);
		$('.tags').append(li);
		$('.create-tags').val('');

		$('.listags ul').empty();

		fillTags();
	});

	$(document).on('click', '.closetag', function(){
		$(this).closest('li').remove();

		fillTags();
	});

	$(document).on('click', '.removetag', function(){
		var delItem = $(this).closest('li');
		var id = $(this).closest('li').attr('data-id');

		remove('Este tag será eliminado de todos los productos relacionados', burl+'tag/eliminar/'+id, delItem, 'El tag no ha sido borrado');

	});

	$('.alf li').click(function(){
		var value = $(this).text();
		$.ajax({
			url: burl+'tags/first',
			method: 'get',
			data: {search: value}
		}).done(function(res){
			$('.tags').empty();
			$.each(res, function(i, v){
				var i = $('<i>', {class: 'mdi-content-clear removetag right'});
				var span = $('<span>');
				var li = $('<li>', {'data-name': v.name, 'data-id': v.id});
				
				span.text(v.name);
				span.append(i);
				li.append(span);

				$('.tags').append(li);
			});
		});
	});

	$('[name="searchtag"]').keyup(function(){
		var value = $(this).val();
		if(value.length >= 2){
			$.ajax({
				url: burl+'tags/json',
				method: 'get',
				data: {search: value}
			}).done(function(res){
				$('.tags').empty();
				$.each(res, function(i, v){
					var i = $('<i>', {class: 'mdi-content-clear removetag right'});
					var span = $('<span>');
					var li = $('<li>', {'data-name': v.name, 'data-id': v.id});
					
					span.text(v.name);
					span.append(i);
					li.append(span);

					$('.tags').append(li);
				});
			});
		}else{
			$('.tags').empty();
		}
	});

	function fillTags(){
		tags = $('.tags li');
		var values = new Array();
		$.each(tags, function(i, v){
			var id = $(v).attr('data-id');
			var name = $(v).attr('data-name');
			values.push(id+'_'+name);
		});
		$('input[name="tags"]').val(values);
	}

	//endtags

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
		var paginate = $('<div>', {class: 'paginate'});
		
		div.append(cerrar);
		div.append(content);
		div.append(paginate)
		$('body').prepend(div);

		var imgs = new Array;
		$.ajax({
			url: burl+'imagenes/json',
			context: document.body
		}).done(function(res) {
			var i = 1;
			$.each(res, function(i, v){
				if(i == 0){
					pages = v.pages;
				}else{
					imgs += '<img data-id="'+v.id+'" src="'+uploads+'uploads/sq/'+v.url+'">';
				}
				i++;
			});
			content.append(imgs);
			paginate.append(pages);
		});

		//no scroll
		$('body').css('overflow', 'hidden');
	});

	$(document).on('click', '.paginate .pagination a', function(e){
		e.preventDefault();
		page = $(this).attr('href');
		var imgs = new Array;
		$.ajax({
			url: page,
			context: document.body
		}).done(function(res) {
			var i = 1;
			$.each(res, function(i, v){
				if(i == 0){
					pages = v.pages;
				}else{
					imgs += '<img data-id="'+v.id+'" src="'+uploads+'uploads/sq/'+v.url+'">';
				}
				i++;
			});
			$('.content').html(imgs);
			$('.paginate').html(pages);
		});
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

		//para el slide
		var newsrc = $(this).attr('src');
		var newimg = $('<img>', {src: src, 'data-id': id});
		var newdiv = $('<div>', {class: 'product-img'});
		var newremove = $('<span>', {class: 'remove'});
		var newiconClose = $('<i>', {class: 'mdi-navigation-close'});

		newremove.append(newiconClose);
		newdiv.append(newremove);
		newdiv.append(newimg);
		$('.imagen').html(newdiv);
		$('[name="img"]').val(newsrc);
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

		$('[name="img"]').val('');
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

	$('input[name="price"]').focusout(function(e){
		unf = $(this).val();
		var number = numeral(unf).format('0,0.00');
		$(this).val(number);
	});

	$('input[name="catname"]').keyup(function(e){
		catname = $(this).val();
		$('input[name="slug"]').val( slug( catname ) );
	});

	$('.delete').click(function(){
		var id = $(this).attr('data-id');
		var delItem = $(this).closest('.product-img');

		remove('Después de esta acción no podrás recuperar este archivo', burl+'imagen/eliminar/'+id, delItem, 'El archivo no ha sido borrado');

	});

	$('.delete-category').click(function(e){
		e.preventDefault();
		var delItem = $(this).closest('.collection-item');
		var id = $(this).attr('data-id');

		remove('Los productos de esta categoría, se asignarán a Sin Categoría', burl+'categoria/eliminar/'+id, delItem, 'Ĺa categoría no ha sido borrada');

	});

	$('.delete-product').click(function(e){
		e.preventDefault();
		var delItem = $(this).closest('.card');
		var id = $(this).attr('data-id');

		remove('Este producto no podrá ser recuperado', burl+'producto/eliminar/'+id, delItem, 'El usuario no ha sido borrado');

	});

	$('.delete-user').click(function(e){
		e.preventDefault();
		var delItem = $(this).closest('.collection-item');
		var id = $(this).attr('data-id');

		remove('Este usuario no podrá ser recuperado', burl+'usuario/eliminar/'+id, delItem, 'El usuario no ha sido borrado');

	});

	$('.delete-order').click(function(e){
		e.preventDefault();
		var delItem = $(this).closest('li');
		var id = $(this).attr('data-id');

		remove('Esta orden no podrá recuperarse', burl+'orden/eliminar/'+id, delItem, 'La orden no ha sido borrada');

	});

	$('.delete-slide').click(function(e){
		e.preventDefault();
		var delItem = $(this).closest('li');
		var id = $(this).attr('data-id');

		remove('Este slider será eliminado', burl+'slider/eliminar/'+id, delItem, 'El slide no ha sido borrado');

	});

	function remove(text, url, delItem, cancel){
		swal({
			title: '¿Estás seguro?',
			text: text,
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
					url: url,
				}).done(function(res){
					if(res == "No tienes permisos para realizar esta acción"){
						swal(
							'Error',
							res,
							'error'
						);
					}else{
						$(delItem).remove();
						swal(
							'¡Eliminado!',
							res,
							'success'
						);
					}
				});
			} else {
				swal(
					'Cancelado',
					cancel,
					'error'
				);
			}
		});
	}

	function slug(str) {
		str = str.replace(/^\s+|\s+$/g, ''); // trim
		str = str.toLowerCase();

		// remove accents, swap ñ for n, etc
		var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
		var to   = "aaaaaeeeeeiiiiooooouuuunc------";
		for (var i=0, l=from.length ; i<l ; i++) {
		str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
		}

		str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
		.replace(/\s+/g, '-') // collapse whitespace and replace by -
		.replace(/-+/g, '-'); // collapse dashes

		return str;
	}

	$('select').material_select();

});