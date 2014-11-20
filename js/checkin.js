function comprobarDatosReserva(){
	//Controlo que se hallan cargado los datos del form
	var dni = $("#txtDni").val();
	var codigo = $("#txtCodReserva").val();
	if (dni==''||codigo==''){
		alert("ATENCION: Para continuar debe completar todos los campos.");
		return(0);
	}//End control campos vacios
	//Si está todo ok bloqueo los inputs
	$("#txtDni").attr("disabled", "disabled");
	$("#txtCodReserva").attr("disabled","disabled");
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
}
