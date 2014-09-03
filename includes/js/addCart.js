var $ = jQuery;

$(document).ready(function(){
	var cartTotal = parseInt(respCartTotal);
	
	$.each( respCart, function(key, value){
	
		var itemPrice = parseInt(value.price),
		itemQty = parseInt(value.qty);
	
		console.log(value, itemQty);
	
		_paq.push(['addEcommerceItem',
			value.sku.toString(),
			value.title,
			value.cats,
			itemPrice,
			itemQty
		]);	
	})
	
	
	_paq.push(['trackEcommerceCartUpdate', cartTotal]);
	_paq.push(['trackPageView']);
	
});