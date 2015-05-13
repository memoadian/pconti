$(document).ready(function(){
	burl = 'http://pconti.dev/appanel/'
	uploads = 'http://pconti.dev/'

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

	$(document).on('click', '.remove', function(){
		$(this).closest('div').remove();
		var principal = $(this).closest('.product-img').find('.principal');
		if(principal.hasClass('active')){
			$('[name="image"]').val('');
		}
		//actualizamos inputs
		fillImages();
	});

	$(document).on('click', '.principal', function(){
		$('.principal, .product-img').removeClass('active');
		$(this).toggleClass('active').closest('div').toggleClass('active');
		var src = $(this).siblings('img').attr('src');

		var id = $(this).siblings('img').attr('data-id');
		console.log(id);
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
});