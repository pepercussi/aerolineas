function comprobarDatosPago(){
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
	var url = "hPago.php";
	var metod = "getDatosPago";
	//Cargo los datos del vuelo
	//$("#contenedorFiltroPago").addClass("hidden");
	$("#contDatosPago").removeClass("hidden");
	$("#contDatosPago").load(
		url,
		{
			metodo: metod,
			t_codDni: dni,
			t_codReserva: codigo
		},
		function(){
			loadBarHide();
		}
	);//End if
	
}
