/*
* funciones para la reserva. Son especialmente peticiones ajax.
*/
$(document).ready(function(){
/*
* Desde aqui se recogen los datos que se quieren observar al cambiar
*/
	$("#fecha").change(function(){
		var fechaSeleccionada = document.getElementById("fecha").value;
		mostrarSalas(fechaSeleccionada);
	});
	$("#sala").change(function(){
		var salaSeleccionada = document.getElementById("sala").value;
		mostrarHoras(salaSeleccionada);
	});

	$("#hora").change(function(){
		var horaSeleccionada = document.getElementById("hora").value;
		mostrarProyecciones(horaSeleccionada);
	});
	$("#asientos").change(function(){
		var precioSeleccionada = document.getElementById("asientos").value;
		mostrarPrecioTotal(precioSeleccionada);
	});
});

/*
* funcion con peticion ajax para mostrar las salas
*/
function mostrarSalas(fechaSeleccionada){
	var fechas = {fecha: fechaSeleccionada};
	$.ajax ({
		type : "POST",
		url : "ajaxReserva.php",
		data: fechas,
		success: function(salasDisponibles){
			var listaSalas = JSON.parse(salasDisponibles);
			var select = document.getElementById("sala");
			$("#sala").empty();
			var seleccionar = document.createElement("option");
			seleccionar.text= "-- Seleccione --";
			select.add(seleccionar);
			$("#sala").children(':first-child').attr('disabled','disabled');
			for (let i = 0; i < listaSalas.length; i++) {
				var option = document.createElement("option");
				option.text= listaSalas[i];
				option.value = listaSalas[i];
				select.add(option);
			}
		}
	});
}
/*
* funcion con peticion ajax para mostrar las horas
*/
function mostrarHoras(salaSeleccionada){
	var salas = {sala: salaSeleccionada};
	$.ajax ({
		type : "POST",
		url : "ajaxReservaHoras.php",
		data: salas,
		success: function(horasDisponibles){
			var listaHoras = JSON.parse(horasDisponibles);
			var select = document.getElementById("hora");
			$("#hora").empty();
			var seleccionar = document.createElement("option");
			seleccionar.text= "-- Seleccione --";
			select.add(seleccionar);
			$("#hora").children(':first-child').attr('disabled','disabled');
			for (let i = 0; i < listaHoras.length; i++) {
				var option = document.createElement("option");
				option.text= listaHoras[i];
				option.value = listaHoras[i];
				select.add(option);
			}
		}
	});
}
/*
* funcion con peticion ajax para mostrar las proyecciones
*/
function mostrarProyecciones(horaSeleccionada){
	var horas = {hora: horaSeleccionada};
	$.ajax ({
		type : "POST",
		url : "ajaxReservaProyecciones.php",
		data: horas,
		success: function(proyeccionesDisponibles){
			var listaProyeccion = JSON.parse(proyeccionesDisponibles);
			$("#precio").empty();
			$("#precio").text(listaProyeccion[0]);
			$("#asientos").empty();
			$("#asientos").attr('max',listaProyeccion[1]);
			if(listaProyeccion[1] == 0){
			$("#asientos").attr('disabled','disabled');
			}
		}
	});
}
/*
* funcion con peticion ajax para mostrar el precio total
*/
function mostrarPrecioTotal(precioSeleccionada){
	var asientos = {asiento: precioSeleccionada};
	$.ajax ({
		type : "POST",
		url : "ajaxReservaPrecioTotal.php",
		data: asientos,
		success: function(preciosDisponibles){
			var listaPrecios = JSON.parse(preciosDisponibles);
			$("#precioTotal").empty();
			$("#precioTotal").text("Precio final: "+ listaPrecios[0] + " €");
			$("#terminarReserva").attr('value',listaPrecios[1]);
		}
	});
}

