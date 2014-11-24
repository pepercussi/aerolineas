function enviaCorreoPasajerosEnEspera(){
	loadBarShow();
	
	$("#contenedorLog").removeClass("hidden");
	$("#logResult").empty();
	var url = "hReserva.php";
	var metod = "alertaReservasSinConfirmar";
	$("#logResult").load(
		url,
		{
			metodo: metod
		},
		function(){
			loadBarHide();
		}//End callback
	);//End load
	
	
}//End function enviaCorreoPasajerosEnEspera
