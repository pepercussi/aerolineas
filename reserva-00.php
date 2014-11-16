<?php require_once('cfg/core.php') ?>
<?php
$Aeropuerto = new Aeropuertos();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ES">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Aerolineas - Reservas - B&uacute;squeda de Vuelos</title>
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
				<div class="col-md-12 col-xs-12"><h1>Reserve su vuelo</h1></div>
			</div>
			<div class="row separador01"></div>
			<form id="frmVuelos" action="reserva-01.php" method="post" role="form" class="form-inline">
				<div class="row rowFiltro00">
					<div class="col-md-1 col-xs-12"><label>Origen:</label></div>
					<div class="col-md-11 col-xs-12">
						<select class="form-control" name="selOrigen" id="selOrigen">
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
				<div class="row rowFiltro00">
				</div>
					<div class="col-md-1 col-xs-12"><label>Destino:</label></div>
					<div class="col-md-11 col-xs-12">
						<select class="form-control" name="selDestino" id="selDestino">
							<?php
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
					<div class="col-md-2 col-xs-12"><label>Fecha de Salida:</label></div>
					<div class="col-md-2 col-xs-12"><input class="form-control" type="text" name="txtFechaSalida" id="txtFechaSalida" placeholder="AAAA-MM-DD" value="<?php echo date('Y-m-d');?>"/></div>
					<div class="col-md-1 col-xs-12"></div>
					<div class="col-md-2 col-xs-12"><input type="checkbox" class="form-control" id="chkRegreso" onclick="habilitaFechaRegreso()" />&nbsp;<label>Fecha de Regreso:</label></div>
					<div class="col-md-2 col-xs-12"><input class="form-control" disabled="disabled" type="text" name="txtFechaRegreso" id="txtFechaRegreso" placeholder="AAAA-MM-DD"  value="<?php echo date('Y-m-d');?>"/></div>
				</div>
				<div class="row rowFiltro00">
					<div class="col-md-12 col-xs-12 text-center">
						<button type="button" class="btn btn-default" onclick="buscaVuelos()">Buscar <span class="glyphicon glyphicon-search"></span></button>
					</div>
				</div>
				
				<div class="row separador01"></div>
				<div class="row">
					<div class="col-md-12 col-xs-12" id="contTabIda">
						
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-xs-12" id="contTabVuelta">
						
					</div>
				</div>
				<div class="row separador01"></div>
				<div class="row">
					<div class="col-md-12 col-xs-12 text-center hidden" id="contBtnSiguiente">
						<button type="button" class="btn btn-default btn-lg" onclick="siguientePaso()" >Siguiente <span class="glyphicon glyphicon-circle-arrow-right"></span></button>
					</div>
				</div>
				
			</form>
		</div>
	</body>
</html>