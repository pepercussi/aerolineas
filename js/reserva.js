$(document).ready(function(){$(function() {$('#txtFechaSalida').datepicker({dateFormat: 'yy-mm-dd'});});});
$(document).ready(function(){$(function() {$('#txtFechaRegreso').datepicker({dateFormat: 'yy-mm-dd'});});});
$(document).ready(function(){$(function() {$('#txtFechaNacimiento').datepicker({dateFormat: 'yy-mm-dd'});});});

function buscaVuelos(){
	//Muestro la barra de carga
	loadBarShow();
	
	$("#contBtnSiguiente").addClass("hidden");
	
	//obtengo los datos del form
	var cod_origen=$("#selOrigen").val();
	var cod_destino=$("#selDestino").val();
	var f_salida=$("#txtFechaSalida").val();
	var f_regreso=$("#txtFechaRegreso").val();
	
	var url="hVuelos.php";
	var metod="buscaVuelos00";
	
	//Vacio los contenedeores
	$("#contTabIda").empty();
	$("#contTabVuelta").empty();
	
	//Controlo los datos cargados
	/*
	if(f_salida==''){
		loadBarHide();
		alert("Por favor, ingrese la fecha de salida.");
		return(0);
	}//End if
	*/
	if(cod_destino==cod_origen){
		loadBarHide();
		alert("El destino y el origen deben ser distintos.");
		return(0);
	}//End if
	
	if($("#chkRegreso").is(':checked')){
		//Si esta tildado fecha de regreso...
		/*
		if(f_regreso==''){
			loadBarHide();
			alert("Por favor, ingrese la fecha de regreso.");
			return(0);
		}//End if
		*/
		//Cargo el div de los vuelos de vuelta	
		$("#contTabVuelta").load(
			url, 
			{
				origen: cod_destino,
				destino: cod_origen, 
				fechaVuelo: f_regreso, 
				tipoVuelo: "vuelta",
				metodo: metod
			}
			
		);//End load Vuelta
	}//End if vuelos de vuelta
	
	//Cargo el div de los vuelos de ida
	$("#contTabIda").load(
		url, 
		{
			origen: cod_origen,
			destino: cod_destino, 
			fechaVuelo: f_salida, 
			tipoVuelo: "ida",
			metodo: metod
		}, setTimeout(function(){
			loadBarHide();
			if($("#chkRegreso").is(':checked')){
				if($("#hIda").val()==1&&$("#hVuelta").val()==1){
					//alert("existen vuelos de ida y vuelta");
					$("#contBtnSiguiente").removeClass("hidden");
				}else{
					//alert("Falta o un vuelo de ida o un vuelo de vuelta");
				}
			}else{
				if($("#hIda").val()==1){
					//alert("Hay al menos un vuelo de ida");
					$("#contBtnSiguiente").removeClass("hidden");
				}else{
					//alert("No hay vuelos de ida");
				}
				//alert("hida: "+$("#hIda").val());
				//alert($("#radVueloIda").lenght);
			}//end if si esta chequeado los vuelos de vuelta
		}, 2000)//End callback
	);//End load Ida
	
	
	
}//End function buscaVuelos

function habilitaFechaRegreso(){
	if($("#chkRegreso").is(':checked')){
		$("#txtFechaRegreso").removeAttr("disabled");
	}else{
		$("#txtFechaRegreso").attr("disabled", "disabled");
	}//end if
}//End function habilitaFechaRegreso

function loadBarHide(){
	$("#load00").css("display", "none"); 
	$("#load00").css("position", "absolute");
	$("#load00").css("top", "0px");
}

function loadBarShow(){
	$("#load00").css("position", "fixed");
	$("#load00").css("top", "0px");
	$("#load00").css("display", "block");
}

function reservaPasaje(){
	//Obtengo las variables
	var tipoVuelo = $("#hTipoVuelo").val();
	var codVueloIda = $("#hCodVueloIda").val();
	var codVueloVuelta = $("#hCodVueloVuelta").val();
	var dni = $("#txtDni").val();
	var f_nac = $("#txtFechaNacimiento").val();
	var nombre = $("#txtNombre").val();
	var apellido = $("#txtApellido").val();
	var correo = $("#txtCorreo").val();
	var clase = $("#selClase").val();

	var url = "hReserva.php";
	
	loadBarShow();
	
	//Controlo los datos del form
	if(dni==''||f_nac==''||nombre==''||apellido==''||correo==''){
		alert("ATENCION: Para continuar debe completar todos los campos.");
		return(0);
	}//End control campos vacios
	
	if(correo.indexOf('@', 0) == -1 || correo.indexOf('.', 0) == -1){
            alert('El correo electrónico introducido no es correcto.');
            return(0);
	}//End control correo
	
	if(clase==0){
		alert("Ha ocurrido un error cargando las clases. No es posible procesar su solicitud.");
		return(0);
	}
	
	//Chequeo si entra en lista de espera
	//Primero el de ida
	$.post(
		url,
		{
			metodo:"checkCapacidadByVuelo",
			vuelo: codVueloIda,
			claseVuelo: clase
		},
		function(result){
			//alert("result ida: "+result);
			if(result==1){
				//Avion vacio
				var confirmacion = confirm("Actualmente no hay capacidad en el vuelo de ida. Desea reservar de todos modos e ingresar a la lista de espera?");
				if(confirmacion!=true){
					loadBarHide();
					return(0);
				}//Si igualmente se quiere anotar sigo
			}//End if
			if(result==2){
				alert("No es posible reservar en el vuelo de ida. La capacidad del mismo ha sido excedida. Por favor regrese a la selección de vuelos para elegir otro.");
				loadBarHide();
				return(0);
			}//End if
			//Grabo lo reserva si es un vuelo solo de ida
			if(tipoVuelo!=1){setTimeout($("#frmVuelos").submit(),3000);}
		}//End callback
	);
	
	//Luego el de vuelta
	if(tipoVuelo==1){
		$.post(
			url,
			{
				metodo:"checkCapacidadByVuelo",
				vuelo: codVueloVuelta,
				claseVuelo: clase
			},
			function(result){
				//alert("result vuelta: "+result);
				if(result==1){
					//Avion vacio
					var confirmacion = confirm("Actualmente no hay capacidad en el vuelo de vuelta. Desea reservar de todos modos e ingresar a la lista de espera?");
					if(confirmacion!=true){
						loadBarHide();
						return(0);
					}//Si igualmente se quiere anotar sigo
				}//End if
				if(result==2){
					alert("No es posible reservar en el vuelo de vuelta. La capacidad del mismo ha sido excedida. Por favor regrese a la selección de vuelos para elegir otro.");
					loadBarHide();
					return(0);
				}//End if
				//Grabo lo reserva
				setTimeout($("#frmVuelos").submit(),3000);
			}//End callback
		);
	}//End if
	
	
	
	
	
}//End function reservaPasaje

function siguientePaso(){
	
	var ida_y_vuelta=0;//Por defecto es solo un vuelo de ida
	
	//Primero pregunto si se seleccionó algún vuelo de ida
	if(!$("input[name=radVueloIda]:checked").val()) {
		alert("No seleccionó ningún vuelo de ida.");
		return(0);
	}//End if selecciono vuelo de ida
	
	//Luego pregunto si esta creado el radio de vuelos de vuelta
	if($("input[name=radVueloVuelta]").val()) {
		//Como es un vuelo de ida y vuelta pregunto si se seleccionó el vuelo de vuelta
		if(!$("input[name=radVueloVuelta]:checked").val()) {
			alert("No seleccionó ningún vuelo de vuelta.");
			return(0);
		}//End if selecciono vuelo de vuelta
		//Le aviso que es un vuelo de ida y vuelta
		ida_y_vuelta=1;
	}//End if existe radio de vuelta
	
	//Luego de pasar las validaciones genero las variables necesarias y envio el form
	$("#frmVuelos").append("<input type='hidden' name='hTipoVuelo' value='"+ida_y_vuelta+"' />");
	//alert("radVueloIda: "+$('input:radio[name=radVueloIda]:checked').val());
	//alert("radVueloVuelta: "+$('input:radio[name=radVueloVuelta]:checked').val());
	$("#frmVuelos").submit();
}//End seleccionaAsiento
