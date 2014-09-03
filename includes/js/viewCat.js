var $ = jQuery;

$(document).ready(function(){
	// productSKU and productName are not applicable and are set to false
	_paq.push(['setEcommerceView',
		productSku = false, // No product on Category page
		productName = false, // No product on Category page
		category = respCat.cat // Category Page, or array of up to 5 categories
	]);

});