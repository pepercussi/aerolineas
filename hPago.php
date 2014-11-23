<?php require_once('cfg/core.php') ?>
<?php

if(isset($_POST['metodo'])){

	$metodo=$_POST['metodo'];
	if($metodo=="getDatosPago"){
		$codDni = $_POST["t_codDni"];
		$codReserva = $_POST["t_codReserva"];
		$Reserva = new Reservas();
		$Reserva->getDatosPago($codDni, $codReserva);
	}//End metodo getDatosPago
}
?>
