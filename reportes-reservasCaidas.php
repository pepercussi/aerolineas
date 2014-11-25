<?php require_once('cfg/core.php') ?>
<?php
$Aeropuerto = new Aeropuertos();
$Vuelo = new Vuelos();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ES">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Aerolineas - Reportes - Reservas Caidas</title>
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
			function buscaReservasCaidas(){
				loadBarShow();
				vuelo = $("#selVuelo").val();
				url = "hReportes.php";
				metod = "buscaReservasCaidas";
				$("#contResult").empty();
				$("#contResult").load(
					url,
					{
						metodo: metod,
						cod_vuelo: vuelo,
					},
					function(){
						loadBarHide();
					}
				);
				
			}//End function buscaPasajes
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
				<div class="col-md-12 col-xs-12"><h1>Reservas Caidas</h1></div>
			</div>
			<div class="row separador01"></div>
			<form id="frmReporte" action="#" method="post" role="form" class="form-inline">
				<div class="row rowFiltro00">
					<div class="col-md-1 col-xs-12"><label>Vuelo:</label></div>
					<div class="col-md-11 col-xs-12">
						<select class="form-control" name="selVuelo" id="selVuelo">
							<option value="0" selected="selected">Todas</option>
							<?php
							$arrVuelos = $Vuelo->getAllVuelos();
							
							if(count($arrVuelos)>0){
								foreach($arrVuelos as $av){
									echo "<option value='".$av['codigo_vuelo']."'>Desde: ".$av['origen']." - Hasta: ".$av['destino']." > ".$av['fecha_salida']."</option>";
								}//End foreach
							}else{
								echo "<option value='0'>OCURRIO UN ERROR</option>";
							}//End if
							?>
						</select>
					</div>
				</div>
				<div class="row rowFiltro00">
					<div class="col-md-12 col-xs-12 text-center">
						<button type="button" class="btn btn-default" onclick="buscaReservasCaidas()">Buscar <span class="glyphicon glyphicon-search"></span></button>
					</div>
				</div>
				
				<div class="row separador01"></div>
				<div class="row">
					<div class="col-md-12 col-xs-12" id="contResult">
						
					</div>
				</div>
				
			</form>
		</div>
	</body>
</html>