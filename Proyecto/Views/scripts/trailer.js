/*
* funciones para mostrar y ocultar popup con el trailer de la pelicula.
*/
$(document).ready(function(){
    $('.trailer').on('click', function(){
        $('#popup-trailer').fadeIn('slow');
        $('.popup-overlay-trailer').fadeIn('slow');
        $('.popup-overlay-trailer').height($(window).height());
       
		var trailerPelicula = $(this).prev().val();
		$("#trailer1").append("<iframe src='"+trailerPelicula+"' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>");

        return false;
    });
 
    $('.close-trailer').on('click', function(){
    	$('#trailer1').empty();
        $('#popup-trailer').fadeOut('slow');
        $('.popup-overlay-trailer').fadeOut('slow');
        return false;
    });
});