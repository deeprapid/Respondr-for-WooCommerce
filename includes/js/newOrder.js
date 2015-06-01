jQuery(document).ready(function($) {
	// ADD ITEMS
	$.each(respOrder.items, function(key, value) {
		_raq.push(['addEcommerceItem', {
            sku: value.sku.toString(),
            name: value.title,
            category: value.cats,
            price: parseInt(value.price),
            imageUrl: '', // TODO
            desc: '', // TODO
            qty: parseInt(value.qty)
        }]);
	});
	// NEW ORDER
	_raq.push(['trackEcommerceOrder', {
        orderId: respOrder.id.toString(),
        total: parseInt(respOrder.total),
        subTotal: parseInt(respOrder.subTotal),
        tax: parseInt(respOrder.taxTotal),
        shipping: parseInt(respOrder.shipTotal),
        discount: false
    }]);
});