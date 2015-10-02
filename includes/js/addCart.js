var $ = jQuery;

$(document).ready(function(){
	
	var cartTotal = parseInt(respCartTotal);
	
	$.each( respCart, function(key, value){
	
		var itemPrice = parseInt(value.price),
		itemQty = parseInt(value.qty);
	
		_raq.push(['addEcommerceItem', {
			sku: value.sku.toString(),
			name: value.title,
			categories: value.cats,
			price: itemPrice,
			qty: itemQty
		}]);
	})
	
});