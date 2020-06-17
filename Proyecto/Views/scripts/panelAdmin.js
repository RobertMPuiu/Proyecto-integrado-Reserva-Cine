/*
* funcion para el panel de administrador. Al pulsar sobre una opcion te redirecciona
*/
$(document).ready(function(){
	$('#panel1').click(function(){
		window.location.href = '../../Controllers/insertarPelicula.php';
	});
	$('#panel2').click(function(){
		window.location.href = '../../Controllers/modificarPelicula.php';
	});
	$('#panel3').click(function(){
		window.location.href = '../../Controllers/eliminarPelicula.php';
	});
});