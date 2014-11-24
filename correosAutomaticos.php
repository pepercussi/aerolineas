<?php require_once('cfg/core.php') ?>
<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ES">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Aerolineas - Env&iacute;o de correos autom&aacute;ticos</title>
		<!-- START ESTILOS -->
		<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.css"><!-- Bootstrap -->
		<link rel="stylesheet" href="lib/jquery-ui-1.11.2/jquery-ui.css"><!-- Jquery UI -->
		<link rel="stylesheet" href="styles/main.css" /><!-- Estilos Generales -->
		<!-- END ESTILOS -->
		
		<!-- START SCRIPTS -->
		<script type="text/javascript" src="lib/jquery-1.11.1.js"></script><!-- Jquery -->
		<script type="text/javascript" src="lib/bootstrap/js/bootstrap.js"></script><!-- Bootstrap -->
		<script type="text/javascript" src="lib/jquery-ui-1.11.2/jquery-ui.js"></script><!-- Jquery UI -->
		<script type="text/javascript" src="js/reserva.js"></script><!-- Scripts de esta opcion -->
		<script type="text/javascript">
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
		</script><!-- Scripts de esta opcion -->
		<!-- END SCRIPTS -->

	</head>
	
	<body>
		<!-- START LOAD BLOCK -->
		<?php include("load_block.php"); ?>
		<!-- END LOAD BLOCK -->
		
		<!-- START NAV BAR -->
		<?php include("nav_bar.php");?>
		<!-- END NAV BAR -->
		
		<div id='contenedorPrincipal' class="container maincont">
			<div class="row">
				<div class="col-md-12 col-xs-12"><h1>Env&iacute;o de correos autom&aacute;ticos</h1></div>
			</div>
			<div class="row separador01"></div>
			<form id="frmVuelos" action="" method="post" role="form" class="form-inline">
				<div class="row rowFiltro00">
					<div class="col-md-12 col-xs-12 text-center" id="contBtnSiguiente">
						<button type="button" class="btn btn-default btn-lg" onclick="enviaCorreoPasajerosEnEspera()" >Enviar Correo a Pasajeros en Lista de Espera <span class="glyphicon glyphicon-envelope"></span></button>
					</div>
				</div>
			</form>
			<div class="row separador01"></div>
			<div id="contenedorLog" class="row rowFiltro00 hidden">
				<div class="col-md-12 col-xs-12">
					<h2>Registro de sucesos</h2>
					<div class="row rowFiltro00">
						<div id="logResult" class="col-md-12 col-xs-12"></div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>