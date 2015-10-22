var $ = jQuery;

$(document).ready(function(){
	
	// NEW ORDER
	var total = parseInt( respOrder.total ),
	subTotal = parseInt( respOrder.subTotal ),
	shipTotal = parseInt( respOrder.shipTotal ),
	taxTotal = parseInt( respOrder.taxTotal );
	
	_raq.push(['trackEcommerceOrder', {
		id: respOrder.id.toString(), // (required) Unique Order ID
		total: total, // (required) Order Revenue grand total (includes tax, shipping, and subtracted discount)
		subTotal: subTotal, // (optional) Order sub total (excludes shipping)
		tax: taxTotal, // (optional) Tax amount
		shipping: shipTotal // (optional) Shipping amount
	}]);

	// SAVE CONTACT
	_raq.push(['saveContact', {
		email: respOrder.email, // (required) Contact's email address
		firstName: respOrder.firstname, // Contact's first name. Set to false if empty 
		lastName: respOrder.lastname, // Contact's last name. Set to false if empty 
		phone: respOrder.phone // Contact's phone number. Set to empty if n/a
	}]);

});