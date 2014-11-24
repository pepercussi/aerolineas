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
	
}//End function comprobarDatosPago

function abonarPago(){
	//Controlo los datos de la tarjeta de credito
	var nroTarjeta = $("#txtNroTarjeta").val();
	var codSeg = $("#txtCodSeg").val();
	if(nroTarjeta==''||codSeg==''){
		alert("ATENCION: Para continuar debe completar los campos solicitados");
		return(0);
	}else{
		if(isNaN(nroTarjeta)||isNaN(codSeg)){
			alert ("Los datos ingresados son invalidos");
			return (0);
		}
	}//End control campos vacios y datos validos
	controlaTipo=nroTarjeta.substring(0,2); //tomo los dos primeros digitos de la tarjeta
	if (controlaTipo.substring(0,1)==4){
		$( "input[name='tarjetaTipo']" ).val( "Visa" ); //Modifico el atributo del input hidden del formulario
	}else{
		if(controlaTipo>=51&&controlaTipo<=55){
			$( "input[name='tarjetaTipo']" ).val( "Mastercard" );
		}
		else{
			if(controlaTipo==34||controlaTipo==37){
				$( "input[name='tarjetaTipo']" ).val( "American Express" );
			}else{
				alert ("no es una tarjeta valida");
				return 0;
			}
		}
	}
	loadBarShow();
	$("#frmPago").submit();
	loadBarHide();

}//End funtion abonarPago


