<?php require_once('cfg/core.php') ?>
<?php

if(isset($_POST['metodo'])){
	$metodo=$_POST['metodo'];
	
	if($metodo=="getDatosReserva"){
		$codDni = $_POST["t_codDni"];
		$codReserva = $_POST["t_codReserva"];
		$Reserva = new Reservas();
		$Reserva->getDatosReserva($codDni, $codReserva);
	}//End metodo getDatosCheckin
	
	
}//End POST

?>