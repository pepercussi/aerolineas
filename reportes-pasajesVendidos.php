<?php require_once('cfg/core.php')?>
<?php
$Aeropuerto = new Aeropuertos();
$Avion = new Aviones();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ES">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Aerolineas - Reportes - Pasajes Vendidos</title>
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
			function buscaPasajes(){
				loadBarShow();
				categoria = $("#selCategoria").val();
				destino = $("#selDestino").val();
				url = "hReportes.php";
				metod = "buscaPasajesVendidos";
				
				$("#contResult").empty();
				$("#contResult").load(
					url,
					{
						metodo: metod,
						cod_categoria: categoria,
						cod_aeropuerto: destino
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
				<div class="col-md-12 col-xs-12"><h1>Pasajes Vendidos</h1></div>
			</div>
			<div class="row separador01"></div>
			<form id="frmReporte" action="#" method="post" role="form" class="form-inline">
				<div class="row rowFiltro00">
					<div class="col-md-1 col-xs-12"><label>Categor&iacute;a:</label></div>
					<div class="col-md-11 col-xs-12">
						<select class="form-control" name="selCategoria" id="selCategoria">
							<option value="0" selected="selected">Todas</option>
							<?php
							$arrCategorias = $Avion->getArrayClases();
							if(count($arrCategorias)>0){
								foreach($arrCategorias as $ac){
									echo "<option value='".$ac['cod']."'>".$ac['tipo']."</option>";
								}//End foreach
							}else{
								echo "<option value='0'>OCURRIO UN ERROR</option>";
							}//End if
							?>
						</select>
					</div>
					<div class="row rowFiltro00"></div>
					<div class="col-md-1 col-xs-12"><label>Destino:</label></div>
					<div class="col-md-11 col-xs-12">
						<select class="form-control" name="selDestino" id="selDestino">
							<option value="0" selected="selected">Todos</option>
							<?php
							$arrAeropuertos = $Aeropuerto->getArrayAeropuertos();
							if(count($arrAeropuertos)>0){
								foreach($arrAeropuertos as $aa){
									echo "<option value='".$aa['codigo_aeropuerto']."'>".$aa['pais']." - ".$aa['provincia']." - ".$aa['ciudad']." - ".$aa['nombre_aeropuerto']."</option>";
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
						<button type="button" class="btn btn-default" onclick="buscaPasajes()">Buscar <span class="glyphicon glyphicon-search"></span></button>
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