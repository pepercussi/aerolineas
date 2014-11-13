$(document).ready(function(){$(function() {$('#txtFechaSalida').datepicker({dateFormat: 'yy-mm-dd'});});});
$(document).ready(function(){$(function() {$('#txtFechaRegreso').datepicker({dateFormat: 'yy-mm-dd'});});});
function habilitaFechaRegreso(){
	if($("#chkRegreso").is(':checked')){
		$("#txtFechaRegreso").removeAttr("disabled");
	}else{
		$("#txtFechaRegreso").attr("disabled", "disabled");
	}//end if
}//End function habilitaFechaRegreso


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
	if(f_salida==''){
		loadBarHide();
		alert("Por favor, ingrese la fecha de salida.");
		return(0);
	}//End if
	
	if(cod_destino==cod_origen){
		loadBarHide();
		alert("El destino y el origen deben ser distintos.");
		return(0);
	}//End if
	
	if($("#chkRegreso").is(':checked')){
		//Si esta tildado fecha de regreso...
		if(f_regreso==''){
			loadBarHide();
			alert("Por favor, ingrese la fecha de regreso.");
			return(0);
		}//End if
		
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

function siguienteReserva(){
	
}
