var $ = jQuery;

$(document).ready(function(){
	
	// ADD ITEMS
	$.each( respOrder.items, function(key, value){
		var itemPrice = parseInt(value.price),
		itemQty = parseInt(value.qty);
	
		_paq.push(['addEcommerceItem',
			value.sku.toString(),
			value.title,
			value.cats,
			itemPrice,
			itemQty
		]);	
		
	});
	
	
	// NEW ORDER
	var total = parseInt( respOrder.total ),
	subTotal = parseInt( respOrder.subTotal ),
	shipTotal = parseInt( respOrder.shipTotal ),
	taxTotal = parseInt( respOrder.taxTotal );
	
	_paq.push(['trackEcommerceCartUpdate', total]);
	
	_paq.push(['trackEcommerceOrder',
		respOrder.id.toString(), // (required) Unique Order ID
		total, // (required) Order Revenue grand total (includes tax, shipping, and subtracted discount)
		subTotal, // (optional) Order sub total (excludes shipping)
		taxTotal, // (optional) Tax amount
		shipTotal, // (optional) Shipping amount
		false // (optional) Discount offered (set to false for unspecified parameter)
	]);

});