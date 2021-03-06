<?php require_once('cfg/core.php') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ES">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Aerolineas - Check-In</title>
		<!-- START ESTILOS -->
		<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.css"><!-- Bootstrap -->
		<link rel="stylesheet" href="lib/jquery-ui-1.11.2/jquery-ui.css"><!-- Jquery UI -->
		<link rel="stylesheet" href="styles/main.css" /><!-- Estilos Generales -->
		<!-- END ESTILOS -->
		
		<!-- START SCRIPTS -->
		<script type="text/javascript" src="lib/jquery-1.11.1.js"></script><!-- Jquery -->
		<script type="text/javascript" src="lib/bootstrap/js/bootstrap.js"></script><!-- Bootstrap -->
		<script type="text/javascript" src="lib/jquery-ui-1.11.2/jquery-ui.js"></script><!-- Jquery UI -->
		<script type="text/javascript" src="js/checkin.js"></script><!-- Scripts de esta opcion -->
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
				<div class="col-md-12 col-xs-12"><h1>Realice el Check-in</h1></div>
			</div>
			<div class="row separador01"></div>
			<form id="frmCheckin" action="hReserva.php" method="post" role="form" class="form-inline">
				<input type="hidden" id="metodo" name="metodo" value="realizarChecking" />
				<div class="row rowFiltro00">
					<div class="col-md-4 col-xs-12"></div>
					<div class="col-md-2 col-xs-12"><label>DNI:</label></div>
					<div class="col-md-2 col-xs-12">
						<input class="form-control" type="text" id="txtDni" name="txtDni" placeholder="Ingrese su documento" <?php if(isset($_GET['dni'])){echo "value='".$_GET['dni']."'";}?> required="" />
					</div>
					<div class="col-md-4 col-xs-12"></div>
				</div>
				<div class="row rowFiltro00">
					<div class="col-md-4 col-xs-12"></div>
					<div class="col-md-2 col-xs-12"><label>Codigo de reserva:</label></div>
					<div class="col-md-2 col-xs-12">
						<input class="form-control" type="text" id="txtCodReserva" name="txtCodReserva" placeholder="Ingrese el codigo" <?php if(isset($_GET['rc'])){echo "value='".$_GET['rc']."'";}?> required="" />
					</div>
					<div class="col-md-4 col-xs-12"></div>
				</div>
				<div class="row rowFiltro00">
					<div class="col-md-5 col-xs-12"></div>
					<div class="col-md-2 col-xs-12">
						<button type="button" id="btnCheckin" class="btn btn-default btn-lg" onclick="comprobarDatosReserva()" >Comprobar datos <span class="glyphicon glyphicon-ok"></span></button>
					</div>
					<div class="col-md-5 col-xs-12"></div>
				</div>
				<div class="row separador01"></div>
				<div class="row">
					<div class="col-md-12 col-xs-12 table-responsive" id="contDatosReserva"></div>
				</div>

				<!-- START DIBUJO DEL AVION-->
				<div id="dibujoAvionIda" class="row rowFiltro00 hidden">
					<div class="col-md-12 col-xs-12">
						<div class="row rowFiltro00">
							<div class="col-md-5 hidden-xs"></div>
							<div class="col-md-2 col-xs-12 text-center"><p class="bg-info">Primera Clase</p></div>
							<div class="col-md-5 hidden-xs"></div>
						</div>
						<div class="row rowFiltro00">
							<div class="col-md-5 hidden-xs"></div>
							<div class="col-md-2 col-xs-12 text-center"><p class="bg-success">Ejecutivo</p></div>
							<div class="col-md-5 hidden-xs"></div>
						</div>
						<div class="row rowFiltro00">
							<div class="col-md-5 hidden-xs"></div>
							<div class="col-md-2 col-xs-12 text-center"><p class="bg-danger">No Disponible</p></div>
							<div class="col-md-5 hidden-xs"></div>
						</div>
						<div class="row rowFiltro00">
							<div class="col-md-12 col-xs-12"><h3>Selecci&oacute;n de asientos para el vuelo de ida</h3></div>
						</div>
						<div class="row rowFiltro00">
							<div class="col-md-4 hidden-xs text-right"><img class="img-responsive" src="media/img/wing_left.png" /></div>
							<div class="col-md-4 col-xs-12" id="contAsientosIda"></div>
							<div class="col-md-4 hidden-xs text-left"><img class="img-responsive" src="media/img/wing_right.png" /></div>
						</div>
					</div>
				</div>

				<div id="dibujoAvionVuelta" class="row rowFiltro00 hidden">
					<div class="col-md-12 col-xs-12">
						<div class="row rowFiltro00">
							<div class="col-md-12 col-xs-12"><h3>Selecci&oacute;n de asientos para el vuelo de vuelta</h3></div>
						</div>
						<div class="row rowFiltro00">
							<div class="col-md-4 hidden-xs text-right"><img class="img-responsive" src="media/img/wing_left.png" /></div>
							<div class="col-md-4 col-xs-12" id="contAsientosVuelta"></div>
							<div class="col-md-4 hidden-xs text-left"><img class="img-responsive" src="media/img/wing_right.png" /></div>
						</div>
					</div>
				</div>
				
				<div id="contBtnReservaPasaje" class="row rowFiltro00 hidden">
					<div class="col-md-12 col-xs-12 text-center">
						<button type="button" id="btnRealizaChecking" class="btn btn-default btn-lg" onclick="realizarChecking()" >Realizar Check-In <span class="glyphicon glyphicon-briefcase"></span></button>
					</div>
				</div>
				<!-- END DIBUJO DEL AVION -->

			
			</form>
		</div>
	</body>
</html>