<?php require_once('cfg/core.php')?>
<?php 
$Reserva = new $Reservas();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ES">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Aerolineas - Tarjeta de embarque</title>
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
		
		<div class="container maincont">
			<div class="row">
				<div class="col-md-12 col-xs-12"><h1>Check-in exitoso</h1></div>
			</div>
			<div class="row">
				<div class="col-md-8 col-xs-12">
					<div class="col-md-4">DNI:</div>
					<div class="col-md-8">
						<?php
							$arrReservas = $Reserva->getArrayReserva($_POST['hDni'],$_POST['hReserva']);
							foreach($arrReservas as $r00){
								echo $r00['nombre'];
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>