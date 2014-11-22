<?php require_once('cfg/core.php') ?>
<?php

if(isset($_POST['metodo'])){
	$metodo=$_POST['metodo'];
	
	if($metodo=="getAsientosLibresByCodVuelo"){
		$codVuelo = $_POST["t_codVuelo"];
		$tipoVuelo = $_POST["t_tipoVuelo"];
		$claseVuelo = $_POST['claseVuelo'];
		$Avion = new Aviones();
		$Avion->getAsientosLibresByCodVuelo($codVuelo, $tipoVuelo, $claseVuelo);
	}//End metodo getAsientosLibresByCodVuelo
	
	
}//End POST

?>