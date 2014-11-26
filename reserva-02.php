<?php require_once('cfg/core.php') ?>
<?php
require_once('lib/fpdf17/fpdf.php');
//Controlo que esxista el tipo de vuelo
$numeroReserva=$_GET['rc'];
$dniPasajero=$_GET['dni'];

$Reserva = new Reservas();
$Pasajero = new Pasajeros();
$estadoReserva = $Reserva->checkReserva($numeroReserva, $dniPasajero);

$arrPasajero = $Pasajero->getNombreyApellidoByDni($dniPasajero);
$nya="";
if(count($arrPasajero)>0){
	foreach($arrPasajero as $ap){
		$nya = $ap['nombre']." ".$ap['apellido'];
	}//End foreach
}//End if

$arrReserva = $Reserva->getArrayReserva($dniPasajero,$numeroReserva);
$cantReservas = count($arrReserva);

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage(); 
$pdf->SetFont('Arial','B',16);
$pdf->Cell(200,10,'Aerolineas - Confirmacion de Reserva',0,1,'C');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(200,10,'Codigo de reserva:',0,1,'C');
$pdf->SetFont('Arial','',20);
$pdf->Cell(200,10,$numeroReserva,0,1,'C');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(200,10,'Nombre y Apellido:',0,1,'C');
$pdf->SetFont('Arial','',14);
$pdf->Cell(200,10,$nya,0,1,'C');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(200,10,'D.N.I.:',0,1,'C');
$pdf->SetFont('Arial','',14);
$pdf->Cell(200,10,$dniPasajero,0,1,'C');
$flag=0;
if($cantReservas>0){
	foreach($arrReserva as $ar){
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
		$pdf->Cell(150,10,$ar['fecha_sal'],0,0,'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(50,10,'Origen:',0,0,'R');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(150,10,$ar['origen'],0,0,'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(50,10,'Destino:',0,0,'R');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(150,10,$ar['destino'],0,0,'L');
		$pdf->Ln();
	}//End foreach
}//End if
$pdf->Output("media/pdf/cr".$dniPasajero."-".$numeroReserva.".pdf");

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
		<link rel="stylesheet" href="styles/reserva.css" /><!-- Estilos de esta opcion-->
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
				<div class="col-md-12 col-xs-12"><h1>Estado de la Reserva</h1></div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<?php
					if($estadoReserva==1){
						echo "<div class='alert alert-success text-center' role='alert'><p>Su reserva fue cargada con &eacute;xito</p></div>";
					}else{
						echo "<div class='alert alert-danger text-center' role='danger'><p>Ocurri&oacute; un error con la reserva. Por favor realice la misma nuevamente.</p></div>";
					}//End if
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12 text-center">
					<?php
					if($estadoReserva==1){
					?>
						<p>Por favor guarde el siguiente c&oacute;digo de reserva:</p>
						<mark class="codReserva"><?php echo $numeroReserva;?></mark>
						<p>El mismo le servir&aacute; para efectuar el pago del pasaje y posteriormente, el check-in.</p>
					<?php
					}//End if
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12 text-center">
					<?php
					if($estadoReserva==1){
					?>
					<a target="_blank" class="btn btn-lg btn-default" href='<?php echo "media/pdf/cr".$dniPasajero."-".$numeroReserva.".pdf";?>'>Descargar PDF <span class="glyphicon glyphicon-floppy-save"></span></a>
					&nbsp;
					<a class="btn btn-lg btn-default" href="pago.php?rc=<?php echo $numeroReserva;?>&dni=<?php echo $dniPasajero;?>">Abonar Esta Reserva <span class="glyphicon glyphicon-usd"></span></a>
					&nbsp;
					<?php
					}//End if
					?>
					<a class="btn btn-lg btn-default" href="reserva-00.php">Realizar una Nueva Reserva <span class="glyphicon glyphicon-plus"></a>
				</div>
			</div>
		</div>
	</body>
</html>