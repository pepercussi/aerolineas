<?php require_once('cfg/core.php') ?>
<?php
//Controlo que esxista el tipo de vuelo
$numReserva=$_GET['rc'];
$dniPasajero=$_GET['dni'];
$tipo=$_GET['tipo'];
$cuotas=$_GET['cuotas'];
$nroTarjeta=$_GET['nroT'];


$Reserva = new Reservas();
$estadoPago = $Reserva->getEstadoDePago($dniPasajero, $numReserva);
$estadoReserva = $Reserva->checkReserva($numReserva, $dniPasajero);

//require_once('lib/dompdf/dompdf_config.inc.php');
require_once('lib/fpdf17/fpdf.php');
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

//$pdf="<html><head><title>Aerolineas - Boarding Pass</title></head><body>";
$pdf = new FPDF('P','mm','A4'); 
$pdf->AddPage(); 
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,20,'Aerolineas',1,1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Factura Nro:'.$estadoPago,0,1,'R');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Datos del vuelo',1,1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Apellido y nombre: '.$nyaPasajero,0,1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'DNI: '.$dniPasajero,0,1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Codigo de vuelo: '.$numReserva,0,1);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ES">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Aerolineas - Abone su pasaje</title>
		<!-- START ESTILOS -->
		<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.css"><!-- Bootstrap -->
		<link rel="stylesheet" href="lib/jquery-ui-1.11.2/jquery-ui.css"><!-- Jquery UI -->
		<link rel="stylesheet" href="styles/main.css" /><!-- Estilos Generales -->
		<!-- END ESTILOS -->
		
		<!-- START SCRIPTS -->
		<script type="text/javascript" src="lib/jquery-1.11.1.js"></script><!-- Jquery -->
		<script type="text/javascript" src="lib/bootstrap/js/bootstrap.js"></script><!-- Bootstrap -->
		<script type="text/javascript" src="lib/jquery-ui-1.11.2/jquery-ui.js"></script><!-- Jquery UI -->
		<script type="text/javascript" src="js/pago.js"></script><!-- Scripts de esta opcion -->
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
				<?php
					//verifico si existe la reserva
					if($estadoReserva==1){
						if($estadoPago!=0){
							echo "<div class='col-md-12'><h1>Pago realizado con exito</h1></div>";
							echo "<div class='row separador01'></div>";
							foreach ($arrReserva as $r00){
								$apellido = $r00["apellido"];
								$nombre = $r00["nombre"];
								$clase = $r00["clase"];
							}//End foreach
							echo "<div class='panel panel-primary'>";
								echo "	<div class='panel-heading col-md-3 col-md-offset-9'>";
									echo "	<h3 class='panel-title '>Factura Nº ".$estadoPago."</h3>";
								echo "	</div>";
								echo "	<div class='panel-body'>";
									echo "	<div class='row rowFiltro00'>";
										echo "	<div class='col-md-3 col-xs-12 celdaBlue'><label>Apellido y nombre</label></div>";
										echo "	<div class='col-md-3 col-xs-12'><span>".$apellido. " ".$nombre."</span></div>";
										echo "	<div class='col-md-3 col-xs-12 celdaBlue'><label>Codigo de reserva</label></div>";
										echo "	<div class='col-md-3 col-xs-12'><span>".$numReserva."</span></div>";
									echo " </div>";
								
									echo " <div class='row rowFiltro00'>";
										echo "	<div class='col-md-3 col-xs-12 celdaBlue'><label>DNI</label></div>";
										echo "	<div class='col-md-3 col-xs-12'><span>".$dniPasajero."</span></div>";
										echo "	<div class='col-md-3 col-xs-12 celdaBlue'><label>Clase</label></div>";
										echo "	<div class='col-md-3 col-xs-12'><span>".$Reserva->getClase($clase)."</span></div>";
									echo " </div>";
								
									echo " <div class='row rowFiltro00'>";
										echo "	<div class='col-md-3 col-xs-12 celdaBlue'><label>".$tipo."</label></div>";
										echo "	<div class='col-md-3 col-xs-12'><span>".$nroTarjeta."</span></div>";
										echo "	<div class='col-md-3 col-xs-12 celdaBlue'><label>Cuotas</label></div>";
										echo "	<div class='col-md-3 col-xs-12'><span>".$cuotas."</span></div>";
									echo " </div>";
									echo "	<table class='table table-striped table-responsive'>";
			  							echo "	<thead>";
			  								echo"<tr>";
			  									echo "<th>Nro vuelo</th>";
			  									echo "<th>Origen</th>";
												echo "<th>Decha de salida</th>";
												echo "<th>Destino</th>";
												echo "<th>Fecha de llegada</th>";
											echo "</tr>";
										echo "</thead>";
										echo "<tbody>";
										$flag=0;
										foreach ($arrReserva as $r00){
											echo "<tr>";
												echo "<td>".$r00["cod_vuelo"]."</td>";
												echo "<td>".$r00["origen"]."</td>";
												echo "<td>".$r00["fecha_sal"]."</td>";
												echo "<td>".$r00["destino"]."</td>";
												echo "<td>".$r00["fecha_llegada"]."</td>";
												if($flag==0){
													$flag++;
													$pdf->SetFont('Arial','B',15);
													$pdf->Cell(50,10,'Vuelo de ida:',0,1,'L');
												}else{
													$pdf->SetFont('Arial','B',15);
													$pdf->Cell(50,10,'Vuelo de vuelta:',0,1,'L');
												}
												$pdf->SetFont('Arial','B',14);
												$pdf->Cell(50,10,'Fecha Salida:',0,0,'R');
												$pdf->SetFont('Arial','',12);
												$pdf->Cell(150,10,$r00['fecha_sal'],0,0,'L');
												$pdf->Ln();
												$pdf->SetFont('Arial','B',14);
												$pdf->Cell(50,10,'Origen:',0,0,'R');
												$pdf->SetFont('Arial','',12);
												$pdf->Cell(150,10,$r00['origen'],0,0,'L');
												$pdf->Ln();
												$pdf->SetFont('Arial','B',14);
												$pdf->Cell(50,10,'Destino:',0,0,'R');
												$pdf->SetFont('Arial','',12);
												$pdf->Cell(150,10,$r00['destino'],0,0,'L');
												$pdf->Ln();
												$pdf->SetFont('Arial','B',14);
												$pdf->Cell(50,10,'Asiento:',0,0,'R');
												$pdf->SetFont('Arial','',12);
												$pdf->Cell(150,10,$r00['nro_asiento'],0,0,'L');
												$pdf->Ln();												
											echo "</tr>";
										}//End foreach
										echo "</tbody>";
									echo "</table>";
									
								echo "</div>";
								echo "<div class='panel-footer'>";
									echo "<div class='row'>";
										echo "<div class='col-md-3'>Total a pagar</div>";
										echo "<div class='col-md-3 col-md-offset-6'>".$Reserva->getPrecioVuelo($dniPasajero, $numReserva,$clase)." $ (pesos argentinos)</div>";
									echo "</div>";
								echo "</div>";
								$pdf->SetFont('Arial','B',16);
								$pdf->Cell(0,10,'Total a pagar: '.$Reserva->getPrecioVuelo($dniPasajero, $numReserva,$clase).'$',1,1,'R');
								$pdf->Output("media/pdf/fct".$estadoPago.".pdf");
							echo "</div>";
							echo "<div class='row rowFiltro00'>";
							echo "<div class='col-md-3 col-xs-12'></div>";
								echo "<div class='col-md-3 col-xs-12 text-center'>";
									echo "<a target='_blank' class='btn btn-default' href='media/pdf/fct".$estadoPago.".pdf'>Descargar PDF <span class='glyphicon glyphicon-floppy-save'></span></a>";
								echo "</div>";
								echo "<div class='col-md-3 col-xs-12 text-center'>";
									echo "<a class='btn btn-default' href='checkin.php?rc=".$numReserva."&dni=".$dniPasajero."'>Continuar con el check-in <span class='glyphicon glyphicon-plane'></span></a>";
								echo "</div>";
							echo "<div class='col-md-3 col-xs-12'></div>";
							echo "</div>";
						}else{
							echo "<div class='alert alert-info text-center'><span class='glyphicon glyphicon-info-sign'></span>El vuelo no se encuentra abonado, <a href='pago.php?rc=".$numReserva."&dni=".$dniPasajero."'>realice el pago correspondiente </a></div>";	

						}
					}
					else{
						echo "<div class='alert alert-info text-center'><span class='glyphicon glyphicon-info-sign'></span>La reserva no existe. Por favor realice una nueva reserva <a href='reserva-00.php'>AQUI</a></div>";
					}					
				?>	
			</div>
		</div>
	</body>
</html>