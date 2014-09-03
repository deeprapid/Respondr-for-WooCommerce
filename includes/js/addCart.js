var $ = jQuery;

$(document).ready(function(){
	console.log( 'addToCart' );
	
	var cartTotal = parseInt(respCartTotal);
	
	$.each( respCart, function(key, value){
	
		var itemPrice = parseInt(value.price),
		itemQty = parseInt(value.qty);
	
		_paq.push(['addEcommerceItem',
			value.sku.toString(),
			value.title,
			value.cats,
			itemPrice,
			itemQty
		]);	
	})
	
	
	_paq.push(['trackEcommerceCartUpdate', cartTotal]);
	
});