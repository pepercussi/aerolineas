<?php require_once('cfg/core.php') ?>
<?php

if(isset($_POST['metodo'])){
	$metodo=$_POST['metodo'];

	if($metodo=="checkCapacidadByVuelo"){
		$codVuelo = $_POST["vuelo"];
		$clase = $_POST["claseVuelo"];
		
		$Reserva = new Reservas();
		echo $Reserva->checkCapacidadByVuelo($codVuelo, $clase);
		
	}//End method checkCapacidadByVuelo

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
		$clase = $_POST['selClase'];
		
		$tipoVuelo = $_POST['hTipoVuelo'];
		$codVueloIda = $_POST['hCodVueloIda'];
		$codAsientoIda = "null";
		$Reserva->insertaReserva($numReserva, "", 0, $codAsientoIda, $codVueloIda, $dniPasajero, $clase);
		
		if($tipoVuelo==1){
			$codVueloVuelta = $_POST['hCodVueloVuelta'];
			$codAsientoVuelta = "null";
			$Reserva->insertaReserva($numReserva, "", 0, $codAsientoVuelta, $codVueloVuelta, $dniPasajero, $clase);
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
	

	if($metodo=="realizarChecking"){
		$Reserva = new Reservas();
		$Avion = new Aviones();
		$Vuelo = new Vuelos();
		$Pasajero = new Pasajeros();
		
		//Obtengo las variables
		$numReserva = $_POST['hReserva'];
		$tipoVuelo = $_POST['hTipoVuelo'];
		
		$dniPasajero = $_POST['hDni'];
		$arrNyA = $Pasajero->getNombreyApellidoByDni($dniPasajero);
		$nyaPasajero = "";
		foreach($arrNyA as $ap){ $nyaPasajero = $ap['nombre']." ".$ap['apellido']; }//End foreach
		

		$codVueloIda = $_POST['hCodVueloIda'];
		$arrVueloIda = $Vuelo->getArrayVuelosByCodigo($codVueloIda);
		$fechaSalidaIda = "";
		$origenIda = "";
		$destinoIda = "";
		$avionIda = "";
		foreach($arrVueloIda as $avi){
			$fechaSalidaIda = $avi['fecha_salida'];
			$origenIda = $avi['origen'];
			$destinoIda = $avi['destino'];
			//$avionIda = $avi['avion'];
		}//End foreach
		$codAsientoIda = $_POST['radAsientoIda'];
		$nroAsientoIda = $Avion->getNroAsientoByCodAsiento($codAsientoIda);
		
		$contenidoQR="DNI: ".$dniPasajero."\n";
		$contenidoQR="Nombre y Apellido: ".$nyaPasajero."\n";
		$contenidoQR.="Nro. Reserva: ".$dniPasajero."\n";
		$contenidoQR.="Fecha (Vuelo Ida): ".$fechaSalidaIda."\n";
		$contenidoQR.="Asiento (Vuelo Ida): ".$nroAsientoIda."\n";
		$contenidoQR.="Origen / Destino (Vuelo Ida): ".$origenIda." / ".$destinoIda."\n";


		$Reserva->realizaCheckIn($numReserva, $dniPasajero, $codVueloIda, $codAsientoIda);
		
		if($tipoVuelo==1){
			$codVueloVuelta = $_POST['hCodVueloVuelta'];
			$arrVueloVuelta = $Vuelo->getArrayVuelosByCodigo($codVueloVuelta);
			$fechaSalidaVuelta = "";
			$origenVuelta = "";
			$destinoVuelta = "";
			$avionVuelta = "";
			foreach($arrVueloVuelta as $avv){
				$fechaSalidaVuelta = $avv['fecha_salida'];
				$origenVuelta = $avv['origen'];
				$destinoVuelta = $avv['destino'];
				//$avionVuelta = $avv['avion'];
			}//End foreach
			$codAsientoVuelta = $_POST['radAsientoVuelta'];
			$nroAsientoVuelta = $Avion->getNroAsientoByCodAsiento($codAsientoVuelta);

			$contenidoQR.="Fecha (Vuelo Vuelta): ".$fechaSalidaVuelta."\n";
			$contenidoQR.="Asiento (Vuelo Vuelta): ".$nroAsientoVuelta."\n";
			$contenidoQR.="Origen / Destino (Vuelo Vuelta): ".$origenVuelta." / ".$destinoVuelta."\n";


			$Reserva->realizaCheckIn($numReserva, $dniPasajero, $codVueloVuelta, $codAsientoVuelta);
		}//End if
		
		//Generamos el QR del boarding pass
		include("lib/phpqrcode/qrlib.php");
		$archivoQR="bp".$dniPasajero."-".$numReserva.".png";
		
		QRcode::png($contenidoQR,"media/qr_codes/".$archivoQR);
		
		//Ya grabamos la reserva así que le informamos el nro de la misma y le damos la opción de realizar el pago
		header("Location: boarding-pass.php?rc=".$numReserva."&dni=".$dniPasajero);
		
	}//End metodo grabaReservaOld

	if($metodo=="getDatosReserva"){
		$codDni = $_POST["t_codDni"];
		$codReserva = $_POST["t_codReserva"];
		$Reserva = new Reservas();
		$Reserva->getDatosReserva($codDni, $codReserva);
	}//End metodo getDatosCheckin

	
	
}//End POST

?>