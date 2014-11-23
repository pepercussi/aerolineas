<?php require_once('cfg/core.php') ?>
<?php

if(isset($_POST['metodo'])){

	$metodo=$_POST['metodo'];
	if($metodo=="getDatosPago"){
		$codDni = $_POST["t_codDni"];
		$codReserva = $_POST["t_codReserva"];
		$Reserva = new Reservas();
		$arrReserva = $Reserva->getArrayReserva($codDni, $codReserva);
		if(count($arrReserva)>0){
			$pago = $Reserva->getPago($codDni, $codReserva);
			if($pago==0){ //si el pago aun no se efectuo			
				foreach ($arrReserva as $r00){
					$apellido = $r00["apellido"];
					$nombre = $r00["nombre"];
					$clase = $r00["clase"];
				}//End foreach
				echo "<div class='panel panel-primary'>";
					echo "	<div class='panel-heading'>";
						echo "	<h3 class='panel-title'>Datos de la reserva</h3>";
					echo "	</div>";
					echo "	<div class='panel-body'>";
						echo "	<div class='row rowFiltro00'>";
							echo "	<div class='col-md-1 col-xs-12'></div>";
							echo "	<div class='col-md-2 col-xs-12'><label class='label label-primary'>Apellido y nombre:</label></div>";
							echo "	<div class='col-md-3 col-xs-12'><span>".$apellido. " ".$nombre."</span></div>";
							echo "	<div class='col-md-2 col-xs-12'><label class='label label-primary'>Codigo de reserva:</label></div>";
							echo "	<div class='col-md-3 col-xs-12'><span>".$codReserva."</span></div>";
							echo "	<div class='col-md-1 col-xs-12'></div>";
						echo " </div>";
					
						echo " <div class='row rowFiltro00'>";
							echo "	<div class='col-md-1 col-xs-12'></div>";
							echo "	<div class='col-md-2 col-xs-12'><label class='label label-primary'>DNI:</label></div>";
							echo "	<div class='col-md-3 col-xs-12'><span>".$codDni."</span></div>";
							echo "	<div class='col-md-2 col-xs-12'><label class='label label-primary'>Clase:</label></div>";
							echo "	<div class='col-md-3 col-xs-12'><span>".$Reserva->getClase($clase)."</span></div>";
							echo "	<div class='col-md-1 col-xs-12'></div>";
						echo " </div>";
						
						echo "	<table class='table table-striped table-responsive'>";
  							echo "	<thead>";
  								echo"<tr>";
  									echo "<th>Origen</th>";
									echo "<th>Decha de salida</th>";
									echo "<th>Destino</th>";
									echo "<th>Fecha de llegada</th>";
								echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
							foreach ($arrReserva as $r00){
								echo "<tr>";
									echo "<td>".$r00["origen"]."</td>";
									echo "<td>".$r00["fecha_sal"]."</td>";
									echo "<td>".$r00["destino"]."</td>";
									echo "<td>".$r00["fecha_llegada"]."</td>";
								echo "</tr>";
							}//End foreach
							echo "</tbody>";
						echo "</table>";
					echo "</div>";
				echo "</div>";
				echo "<div class='panel panel-primary'>";
					echo "	<div class='panel-heading'>";
						echo "	<h3 class='panel-title'>Abone su pasaje</h3>";
					echo "</div>";
					echo "	<div class='panel-body'>";
						echo "<div class='col-md-4 col-xs-12'>";
							echo "<div class='col-md-6 col-xs-6'><img src='media/img/visaLogo.png' class='img-responsive'/></div>";
							echo "<div class='col-md-6 col-xs-6'><img src='media/img/mastercardLogo.png' class='img-responsive'/></div>";
						echo "</div>";
						echo "<div class='col-md-8 col-xs-12'>";
							echo "<div class='col-md-3 rowFiltro00'><label>Numero de tarjeta</label></div><div class='col-md-9 rowFiltro00'><input type='text' class='form-control' name='txtnroTarjeta'/></div>";
							echo "<div class='col-md-3 rowFiltro00'><label>Codigo de seguridad</label></div><div class='col-md-3 rowFiltro00'><input type='text' class='form-control' name='txtcodSeg' /></div>";
							echo "<div class='col-md-3 rowFiltro00'><label>Cuotas</label></div><div class='col-md-3 rowFiltro00'>";
								echo "<select class='form-control' name='txtCuotas'>";
									echo "<option value='1'>1</option>";
								  	echo "<option value='3'>3</option>";
								  	echo "<option value='6'>6</option>";
								  	echo "<option value='12'>12</option>";
								echo "</select>";
							echo "</div>";
						echo "</div>";
					echo "</div>";
					
			}//End if $pago=0
			else{
				echo "<div class='alert alert-info text-center'><span class='glyphicon glyphicon-info-sign'></span>El vuelo ya se encuentra abonado, <a href='checkin.php'>continue con el check-in del vuelo </a></div>";	
			}
		}else
		{
			echo "<div class='col-md-12'>";
				echo "<div class='alert alert-danger text-center' role='alert'><span class='glyphicon glyphicon-remove-circle'></span>No existe un vuelo correspondiente a los datos ingresados. Por favor, verifique sus datos e intente nuevamente</div>";
		}
	}//End metodo getDatosPago
}
?>
