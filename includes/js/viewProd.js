var $ = jQuery;

$(document).ready(function(){
	var price = parseInt(respProd.price);
	_paq.push(['setEcommerceView',
		respProd.sku.toString(), // (required) SKU: Product unique identifier
		respProd.title, // (optional) Product name
		respProd.cats, // (optional) Product category, or array of up to 5 categories
		price, // (optional) Product Price as displayed on the page
		respProd.img, // (optional) Product image URL
		respProd.desc, // (optional) Product description
	]);
	
});