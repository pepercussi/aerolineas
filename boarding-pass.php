<?php require_once('cfg/core.php')?>
<?php 
//require_once('lib/dompdf/dompdf_config.inc.php');
$Reserva = new Reservas();
$Pasajero = new Pasajeros();

$nroReserva = $_GET['rc'];
$dniPasajero = $_GET['dni'];
$ArrNyaPasajero = $Pasajero->getNombreyApellidoByDni($dniPasajero);
$nyaPasajero;
foreach($ArrNyaPasajero as $ap){
	$nyaPasajero = $ap['nombre']." ".$ap['apellido'];
}//End foreach

$arrReserva = $Reserva->getArrayReserva($dniPasajero, $nroReserva);
$cantReservas = count($arrReserva);

//$pdf="<html><head><title>Aerolineas - Boarding Pass</title></head><body>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ES">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Aerolineas - Boarding Pass</title>
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
				<div class="col-md-12 col-xs-12"><h1>Boarding Pass</h1></div>
				<?php //$pdf.="<h1>Boarding Pass</h1>";?>
			</div>
			<div class="row">
				<div class="col-md-4 col-xs-12"></div>
				<div class="col-md-2 col-xs-12"><label>C&oacute;digo de reserva:</label></div>
				<div class="col-md-2 col-xs-12"><span class="bg-success"><?php echo $nroReserva;?></span></div>
				<div class="col-md-4 col-xs-12"></div>
				<?php //$pdf.="<div><h5>C&oacute;digo de reserva:</h5><span>".$nroReserva."</span></div>";?>
			</div>
			<div class="row">
				<div class="col-md-4 col-xs-12"></div>
				<div class="col-md-2 col-xs-12"><label>Nombre y Apellido:</label></div>
				<div class="col-md-2 col-xs-12"><span><?php echo $nyaPasajero;?></span></div>
				<div class="col-md-4 col-xs-12"></div>
				<?php //$pdf.="<div><h5>Nombre y Apellido:</h5><span>".$nyaPasajero."</span></div>";?>
			</div>
			<div class="row">
				<div class="col-md-4 col-xs-12"></div>
				<div class="col-md-2 col-xs-12"><label>D.N.I.:</label></div>
				<div class="col-md-2 col-xs-12"><span><?php echo $dniPasajero;?></span></div>
				<div class="col-md-4 col-xs-12"></div>
				<?php //$pdf.="<div><h5>D.N.I.:</h5><span>".$dniPasajero."</span></div>";?>
			</div>
			<div class="row">
				<div class="col-md-1 col-xs-12"></div>
				<div class="col-md-10 col-xs-12">
					<?php
					//$falg=0;
					if($cantReservas>0){
						echo "<table class='table table-striped'>";
						//$pdf.="<table>";
							echo "<thead>";
							//$pdf.="<thead>";
								echo "<tr>";
								//$pdf.="<tr>";
									echo "<th>Fecha de salida</th>";
									//$pdf.="<th>Fecha de salida</th>";
									echo "<th>Origen</th>";
									//$pdf.="<th>Origen</th>";
									echo "<th>Destino</th>";
									//$pdf.="<th>Destino</th>";
									echo "<th>Asiento</th>";
									//$pdf.="<th>Asiento</th>";
								echo "</tr>";
								//$pdf.="</tr>";
							echo "</thead>";
							//$pdf.="</thead>";
							echo "<tbody>";
							//$pdf.="<tbody>";
							foreach($arrReserva as $ar){
								echo "<tr>";
									echo "<td>".$ar['fecha_sal']."</td>";
									echo "<td>".$ar['origen']."</td>";
									echo "<td>".$ar['destino']."</td>";
									echo "<td class='text-center'>".$ar['nro_asiento']."</td>";
								echo "</tr>";
								//$pdf.="<tr><td>".$ar['fecha_sal']."</td><td>".$ar['origen']."</td><td>".$ar['destino']."</td><td>".$ar['nro_asiento']."</td></tr>";
							}//End foreach
							echo "</tbody>";
							//$pdf.="</tbody>";
						echo "</table>";
						//$pdf.="</table>";
					}//End if
					?>
				</div>
				<div class="col-md-1 col-xs-12"></div>
			</div>
			<div class="row">
				<div class="col-md-4 col-xs-12"></div>
				<div class="col-md-4 col-xs-12 text-center">
					<img class="img-responsive img-thumbnail" alt="qrCode" src="media/qr_codes/bp<?php echo $dniPasajero;?>-<?php echo $nroReserva;?>.png" />
				</div>
				<div class="col-md-4 col-xs-12"></div>
			</div>
			<?php
			/*
			$pdf.="</body></html>";
			$dompdf = new DOMPDF();
			$dompdf->load_html($html);
			$dompdf->render();
			$dompdf->stream("media/pdf/bp".$dniPasajero."-".$nroReserva.".pdf");
			*/
			?>
			<div class="row rowFiltro00">
				<div class="col-md-4 col-xs-12"></div>
				<div class="col-md-4 col-xs-12 text-center">
					<a class="btn btn-default" href='<?php echo "media/pdf/bp".$dniPasajero."-".$nroReserva.".pdf";?>'>Descargar PDF <span class="glyphicon glyphicon-floppy-save"></span></a>
				</div>
				<div class="col-md-4 col-xs-12"></div>
			</div>
		</div>
	</body>

</html>