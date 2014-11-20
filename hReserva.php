<?php require_once('cfg/core.php') ?>
<?php

if(isset($_POST['metodo'])){
	$metodo=$_POST['metodo'];
	

	if($metodo=="grabaReserva"){
		$Reserva = new Reservas();
		$Pasajero = new Pasajeros();
		//Genero el codigo de reserva
		$numReserva = $Reserva->getRandomCode();
		
		//Obtengo las variables
		$dniPasajero = $_POST['txtDni'];
		$apellido = $_POST['txtApellido'];
		$nombre = $_POST['txtNombre'];
		$email = $_POST['txtCorreo'];
		$f_nacimiento = $_POST['txtFechaNacimiento'];
		
		$tipoVuelo = $_POST['hTipoVuelo'];
		$codVueloIda = $_POST['hCodVueloIda'];
		$codAsientoIda = $_POST['radAsientoIda'];
		$Reserva->insertaReserva($numReserva, "", 0, $codAsientoIda, $codVueloIda, $dniPasajero);
		
		if($tipoVuelo==1){
			$codVueloVuelta = $_POST['hCodVueloVuelta'];
			$codAsientoVuelta = $_POST['radAsientoVuelta'];
			$Reserva->insertaReserva($numReserva, "", 0, $codAsientoVuelta, $codVueloVuelta, $dniPasajero);
		}
		
		//Luego controlo si existe el pasajero
		if($Pasajero->controlaPasajeroByDni($dniPasajero)!=0){
			//El pasajero ya existe asi que actualizo los datos
			$Pasajero->actualizaPasajeroByDni($dniPasajero, $apellido, $nombre, $email, $f_nacimiento);
		}else{
			//El pasajero no existe asi que lo doy de alta
			$Pasajero->insertaPasajero($dniPasajero, $apellido, $nombre, $email, $f_nacimiento);
			
		}//End if
		
		//Ya grabamos la reserva así que le informamos el nro de la misma y le damos la opción de realizar el pago
		header("Location: reserva-02.php?rc=".$numReserva."&dni=".$dniPasajero);
		
	}//End metodo grabaReserva

	if($metodo=="getDatosReserva"){
		$codDni = $_POST["t_codDni"];
		$codReserva = $_POST["t_codReserva"];
		$Reserva = new Reservas();
		$Reserva->getDatosReserva($codDni, $codReserva);
	}//End metodo getDatosCheckin

	
	
}//End POST

?>