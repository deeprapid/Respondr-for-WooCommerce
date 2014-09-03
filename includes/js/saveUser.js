var $ = jQuery;

$(document).ready(function(){
	_paq.push(['saveContact', 
		respUser.email, // (required) Contact's email address
		respUser.first_name, // Contact's first name. Set to false if empty 
		respUser.last_name, // Contact's last name. Set to false if empty 
		'', // Contact's company. Set to empty if n/a
		'', // Contact's phone number. Set to empty if n/a
	]);
});