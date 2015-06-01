$(document).ready(function(){
	baseUrl = 'http://pconti.dev/';

	$('.add-tocart, .single-add-tocart').click(function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var name = $(this).data('name');
		var price = $(this).data('price');
		var image = $(this).data('image');
		var sku = $(this).data('sku');
		var url = $(this).attr('href');
		$.ajax({
			url: url,
			method: 'POST',
			data: {id:id, name:name, price:price, image:image, sku:sku}
		}).done(function(res){
			$('.popcart ul').empty();
			$.each(res, function(i, v){
				var product = $('<li>', {class: 'product'});
				
				product.append('<img class="img-responsive" src="'+baseUrl+'uploads/sq/'+v.options.image+'">');
				product.append('<span> '+v.name+'</span>');
				product.append('<span class="quantity"> '+v.qty+'</span>');
				product.append('<span class="subtotal"> '+v.subtotal+'</span>');
				product.append('<i class="glyphicon glyphicon-remove remove-item" data-id="'+v.rowid+'"></i>');
				$('.popcart ul').append(product);
			});

			//get count items
			$.ajax({
				url: baseUrl + 'items',
				method: 'GET',
			}).done(function(res){
				$('.count').text(res);
			});

			$('.pagar').css('visibility', 'visible');
		});
	});

	$('.boxes').hover(function(){
		$('.popcart').stop(true, false).slideDown(300);
	}, function(){
		$('.popcart').stop(true, false).slideUp(300);
	});

	$('.profile').hover(function(){
		$('.poplogin').stop(true, false).slideDown(300);
	}, function(){
		$('.poplogin').stop(true, false).slideUp(300);
	});

	$('.categories').click( function(){
		$('ul', this).slideToggle(200);
	});

	$(document).on('click', '.remove-item', function(){
		id = $(this).attr('data-id');
		obj = $(this);
		$.ajax({
			url: baseUrl + 'remove',
			method: 'POST',
			data: {remove: id}
		}).done(function(){
			obj.closest('li').hide(300, function(){
				obj.closest('li').remove();
			});

			$.ajax({
				url: baseUrl+'total',
				method: 'GET'
			}).done(function(res){
				$('.tot span').text('$'+res);
			});

			countItems();
		});
	});

	//get count items
	function countItems(){
		$.ajax({
			url: baseUrl + 'items',
			method: 'GET',
		}).done(function(res){
			$('.count').text(res);
		});
	}

	$(window).load(function(){
		//get items		
		$.ajax({
			url: baseUrl + 'content',
			method: 'GET',
			contentType: 'json',
			dataType: 'json',
		}).done(function(res){
			if( $.isEmptyObject(res) === true ){
				$('.pagar').css('visibility', 'hidden');
			}else{
				$('.popcart ul').empty();
				$.each(res, function(i, v){
					var product = $('<li>', {class: 'product'});

					product.append('<img class="img-responsive" src="'+baseUrl+'uploads/sq/'+v.options.image+'">');
					product.append('<span> '+v.name+'</span>');
					product.append('<span class="quantity"> '+v.qty+'</span>');
					product.append('<span class="subtotal"> '+v.subtotal+'</span>');
					product.append('<i class="glyphicon glyphicon-remove remove-item" data-id="'+v.rowid+'"></i>');
					$('.popcart ul').append(product);
				});
			}
		});

		//items
		countItems();

		//order
		$.ajax({
			url: baseUrl+'content',
			method: 'GET',
		}).done(function(res){
			console.log($.isEmptyObject(res));
			if( $.isEmptyObject(res) === true ){
				
			}else{
				$('.paypal').css('display', 'block');
				$.each(res, function(i, v){
					var product = $('<li>');

					product.append('<span> '+v.name+' <span>x '+v.qty+'</span></span>');
					product.append('<i class="glyphicon glyphicon-remove remove-item" data-id="'+v.rowid+'"></i>');
					product.append('<span class="order-sub"> $'+v.subtotal+'</span>');
					$('.order .items').append(product);
				});

				$.ajax({
					url: baseUrl+'total',
					method: 'GET'
				}).done(function(res){
					$('.tot span').text('$'+res);
				});
			}
		});

		//sliders
		$('#carousel').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			itemWidth: 128,
			itemMargin: 5,
			animationLoop: true,
			asNavFor: '#slider'
		});

		$('#slider').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			animationLoop: true,
			sync: "#carousel"
		});
	});
});