var $ = jQuery;

$(document).ready(function(){
	var price = parseInt(respProd.price);
	_raq.push(['trackProductView', {
		sku: respProd.sku.toString(), // (required) SKU: Product unique identifier
		name: respProd.title, // (optional) Product name
		categories: respProd.cats, // (optional) Product category, or array of up to 5 categories
		price: price, // (optional) Product Price as displayed on the page
		imageUrl: respProd.img, // (optional) Product image URL
		desc: respProd.desc // (optional) Product description
	}]);
	
});