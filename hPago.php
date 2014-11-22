<?php require_once('cfg/core.php') ?>
<?php

if(isset($_POST['metodo'])){

	$metodo=$_POST['metodo'];
	if($metodo=="getDatosPago"){
		$codDni = $_POST["t_codDni"];
		$codReserva = $_POST["t_codReserva"];
		$Reserva = new Reservas();
		$arrReserva = $Reserva->getArrayReserva($codDni, $codReserva);
		foreach ($arrReserva as $r00){
			$apellido = $r00["apellido"];
			$nombre = $r00["nombre"];
			//$clase = $r00["clase"];
		}
		echo "	<div class='row rowFiltro00'>";
			echo "	<div class='col-md-1 col-xs-12'></div>";
			echo "	<div class='col-md-2 col-xs-12'><label>Apellido y nombre:</label></div>";
			echo "	<div class='col-md-3 col-xs-12'><span>".$apellido. " ".$nombre."</span></div>";
			echo "	<div class='col-md-2 col-xs-12'><label>Codigo de reserva:</label></div>";
			echo "	<div class='col-md-3 col-xs-12'><span>".$codReserva."</span></div>";
			echo "	<div class='col-md-1 col-xs-12'></div>";
		echo " </div>";
		echo " <div class='row rowFiltro00'>";
			echo "	<div class='col-md-1 col-xs-12'></div>";
			echo "	<div class='col-md-2 col-xs-12'><label>DNI:</label></div>";
			echo "	<div class='col-md-3 col-xs-12'><span>".$codDni."</span></div>";
			echo "	<div class='col-md-2 col-xs-12'><label>Clase:</label></div>";
			echo "	<div class='col-md-3 col-xs-12'><span></span></div>";
			echo "	<div class='col-md-1 col-xs-12'></div>";
		echo " </div>";
	}//End metodo getDatosPago
}
?>
