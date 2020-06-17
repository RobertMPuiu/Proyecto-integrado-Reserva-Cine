/*
* funcion para abrir el menú
*/
$(document).ready(function(){
	$('#openmenu').click(function(){
		$(this).toggleClass('open');
		$('#menu').toggleClass('show');
	});
});