/*
* funcion para eliminar una pelicula, para desabilitar la opción seleccionar
*/
$(document).ready(function(){
    $('#eleccion').change(function(){
    	if ($('#eleccion').val() != "--Seleccione--") {
    		$('#eliminar').prop("disabled",false);
    	}else{
    		$('#eliminar').prop("disabled",true);
    	}
    });
 });

