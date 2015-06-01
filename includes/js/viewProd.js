jQuery(document).ready(function() {
	_raq.push(['trackProductView', {
        sku: respProd.sku.toString(),
        name: respProd.title,
        category: respProd.cats,
        price: parseInt(respProd.price),
        imageUrl: respProd.img,
        desc: respProd.desc
    }]);
});