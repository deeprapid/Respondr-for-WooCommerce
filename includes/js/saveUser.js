var $ = jQuery;

$(document).ready(function(){
	_raq.push(['saveContact', {
		email: respUser.email, // (required) Contact's email address
		firstName: respUser.first_name, // Contact's first name. Set to false if empty 
		lastName: respUser.last_name, // Contact's last name. Set to false if empty 
		company: '', // Contact's company. Set to empty if n/a
		phone: '' // Contact's phone number. Set to empty if n/a
	}]);
});