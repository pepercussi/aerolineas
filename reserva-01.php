<?php require_once('cfg/core.php') ?>
<?php
//$Aeropuerto = new Aeropuertos();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ES">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Aerolineas - Reservas - Carga de datos y selecci&oacute;n de asiento</title>
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
				<div class="col-md-12 col-xs-12"><h1>Datos del pasajero</h1></div>
			</div>
			<div class="row separador01"></div>
			<form id="frmVuelos" action="reserva-01.php" method="post" role="form" class="form-inline">
				<div class="row rowFiltro00">
					<div class="col-md-4 col-xs-12"></div>
					<div class="col-md-2 col-xs-12"><label>DNI:</label></div>
					<div class="col-md-2 col-xs-12"><input class="form-control" type="text" id="txtDni" name="txtDni" placeholder="Ingrese su documento" required="" /></div>
					<div class="col-md-4 col-xs-12"></div>
				</div>
				<div class="row rowFiltro00">
					<div class="col-md-4 col-xs-12"></div>
					<div class="col-md-2 col-xs-12"><label>Fecha de Nacimiento:</label></div>
					<div class="col-md-2 col-xs-12"><input class="form-control" type="text" id="txtFechaNacimiento" name="txtFechaNacimiento" placeholder="AAAA-MM-DD" required="" /></div>
					<div class="col-md-4 col-xs-12"></div>
				</div>
				<div class="row rowFiltro00">
					<div class="col-md-4 col-xs-12"></div>
					<div class="col-md-2 col-xs-12"><label>Nombre:</label></div>
					<div class="col-md-2 col-xs-12"><input class="form-control" type="text" id="txtNombre" name="txtNombre" placeholder="Ingrese su nombre" required="" /></div>
					<div class="col-md-4 col-xs-12"></div>
				</div>
				<div class="row rowFiltro00">
					<div class="col-md-4 col-xs-12"></div>
					<div class="col-md-2 col-xs-12"><label>Apellido:</label></div>
					<div class="col-md-2 col-xs-12"><input class="form-control" type="text" id="txtApellido" name="txtApellido" placeholder="Ingrese su apellido" required="" /></div>
					<div class="col-md-4 col-xs-12"></div>
				</div>
				<div class="row rowFiltro00">
					<div class="col-md-4 col-xs-12"></div>
					<div class="col-md-2 col-xs-12"><label>Correo:</label></div>
					<div class="col-md-2 col-xs-12"><input class="form-control" type="email" id="txtCorreo" name="txtCorreo" placeholder="Ingrese su correo" required="" /></div>
					<div class="col-md-4 col-xs-12"></div>
				</div>
					
				<div class="row rowFiltro00">
					<div class="col-md-5 col-xs-12"></div>
					<div class="col-md-2 col-xs-12">
						<button type="button" class="btn btn-default btn-lg" onclick="seleccionaAsiento()" >Seleccionar Asiento <span class="glyphicon glyphicon-plane"></span></button>
					</div>
					<div class="col-md-5 col-xs-12"></div>
				</div>

				<div class="row separador01"></div>
				
				<!-- Ahora viene el dibujo del avion -->
				<div id="dibujoAvion" class="row rowFiltro00 hidden">
					<div class="col-md-4 text-right"><img class="img-responsive hidden-xs" src="media/img/wing_left.png" /></div>
					<div class="col-md-4"></div>
					<div class="col-md-4 text-left"><img class="img-responsive hidden-xs" src="media/img/wing_right.png" /></div>
				</div>
			</form>
		</div>
	</body>
</html>