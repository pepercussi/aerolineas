function comprobarDatosReserva(){
	//Controlo que se hallan cargado los datos del form
	var dni = $("#txtDni").val();
	var codigo = $("#txtCodReserva").val();
	if (dni==''||codigo==''){
		alert("ATENCION: Para continuar debe completar todos los campos.");
		return(0);
	}else{
		if(isNaN(dni)){
			alert ("Ingrese un DNI valido");
			return (0);
		}
	}//End control campos vacios y DNI valido
	
	//Muestro la barra de carga
	loadBarShow();
	var url = "hReserva.php";
	var metod = "getDatosReserva";
	//Cargo los datos del vuelo
	$("#contDatosReserva").load(
		url,
		{
			metodo: metod,
			t_codDni: dni,
			t_codReserva: codigo
		}
	);//End if
	loadBarHide();
}//End function comprobarDatosReserva

function seleccionaAsiento(){
	
	var tipoVuelo = $("#hTipoVuelo").val();
	var codVueloIda = $("#hCodVueloIda").val();
	var codVueloVuelta = $("#hCodVueloVuelta").val();
	var codClase = $("#hCodClase").val();

	//Controlo que se hallan cargado los datos del form
	/*
	var dni = $("#txtDni").val();
	var f_nac = $("#txtFechaNacimiento").val();
	var nombre = $("#txtNombre").val();
	var apellido = $("#txtApellido").val();
	var correo = $("#txtCorreo").val();
	
	if(dni==''||f_nac==''||nombre==''||apellido==''||correo==''){
		alert("ATENCION: Para continuar debe completar todos los campos.");
		return(0);
	}//End control campos vacios
	
	if(correo.indexOf('@', 0) == -1 || correo.indexOf('.', 0) == -1){
            alert('El correo electrónico introducido no es correcto.');
            return(0);
	}//End control correo
	*/
	
	//Si está todo ok bloqueo los inputs
	$("#txtDni").attr("disabled", "disabled");
	$("#txtCodReserva").attr("disabled", "disabled");
	$("#btnCheckin").addClass("hidden");
	$("#btnSeleccionaAsiento").addClass("hidden");
	/*
	$("#txtFechaNacimiento").attr("disabled", "disabled");
	$("#txtNombre").attr("disabled", "disabled");
	$("#txtApellido").attr("disabled", "disabled");
	$("#txtCorreo").attr("disabled", "disabled");
	$("#btnSeleccionaAsiento").addClass("hidden");
	$("#contBtnReservaPasaje").removeClass("hidden");
	*/
	
	//Muestro la barra de carga
	loadBarShow();
	
	var url = "hAviones.php";
	var metod = "getAsientosLibresByCodVuelo";
	//Muestro el dibujo del avion de ida
	$("#dibujoAvionIda").removeClass("hidden");
	//cargo los asientos del avion de ida
	$("#contAsientosIda").load(
		url,
		{
			metodo: metod,
			t_codVuelo: codVueloIda,
			t_tipoVuelo: 'i',
			claseVuelo: codClase
		}
	);
	//Si es un vuelo de ida y vuelta muestro el avion de vuelta
	if(tipoVuelo==1){
		$("#dibujoAvionVuelta").removeClass("hidden");
		//cargo los asientos del avion de vuelta
		$("#contAsientosVuelta").load(
			url,
			{
				metodo: metod,
				t_codVuelo: codVueloVuelta,
				t_tipoVuelo: 'v',
				claseVuelo: codClase
			}
		);
	}//End if
	
	loadBarHide();
	
}//End function seleccionaAsiento

