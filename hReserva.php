<?php require_once('cfg/core.php') ?>
<?php

if(isset($_POST['metodo'])){
	$metodo=$_POST['metodo'];

	if($metodo=="alertaReservasSinConfirmar"){
		$Avion = new Aviones();
		$Pasajero = new Pasajeros();
		$Reserva = new Reservas();
		$Vuelos = new Vuelos();
		//Primero buscamos los vuelos por vencer
		$arrVuelos = $Vuelos->getArrayVuelosPorVencer(1);
		
		if($arrVuelos>0){
			foreach($arrVuelos as $av){
				$arrClases = $Avion->getArrayClases();
				foreach($arrClases as $ac){
					
					//Obtengo los puestos libres para esa clase y ese vuelo
					$cantTotAsientos=$Avion->getCantidadAsientosByCodAvion($av['cod_avion'], $ac['cod']);
					$cantConfirmadaAsientos=$Reserva->getReservasConfirmadasByVueloAndClase($av['cod'], $ac['cod']);
					$puestosLibres=$cantTotAsientos-$cantConfirmadaAsientos;
					
					echo "<p class='bg-success'><span class='glyphicon glyphicon-plane'></span>&nbsp;Procesando vuelo codigo: ".$av['cod']." para la clase ".$ac['tipo']."...</p>";
					
					if($puestosLibres>0){//Si hay puestos libres busco pasajeros en lista de espera
						$arrPasajeros=$Pasajero->getArrayPasajerosEnEspera($av['cod'], $ac['cod'], $cantTotAsientos, $puestosLibres);
						
						echo "<p class='bg-success'><span class='glyphicon glyphicon-briefcase'></span>&nbsp;Se encontraron puestos libres en el vuelo codigo: ".$av['cod'].". Buscando pasajeros en lista de espera...</p>";
						
						if(count($arrPasajeros)>0){//Si hay pasajeros en espera les informo
						
							echo "<p class='bg-success'><span class='glyphicon glyphicon-send'></span>&nbsp;Enviando correos a pasajeros del vuelo codigo: ".$av['cod']."...</p>";
							foreach($arrPasajeros as $ap){//Envio los correos a los pasajeros en lista de espera
								require("lib/php-mailer/class.phpmailer.php");
								$cuerpoMail="
								<html>
									<head>
										<title>Aerolineas - Disponibilidad de Plazas</title>
									</head>
									<body>
										<h1>Aerolineas - Disponibilidad de Plazas</h1>
										<h2>Estimado/a ".$ap['nombre']." ".$ap['apellido']."</h2>
										<p>A la fecha se encuentran plazas disponibles para que usted pueda realizar el vuelo solicitado oportunamente con el c&oacute;digo de reserva ".$ap['nro_reserva']." .</p>
										<p>Si a&uacute;n desea viajar debe abonar el mismo ingrsando <a href='http://localhost/aerolineas/pago.php'>aqu&iacute;</a> y luego realizar el check-in correspondiente.</p>
										<p>Aerolineas le desea un placentero viaje.</p>
									</body>
								</html>";

								$mail = new PHPMailer();
								$mail->IsSMTP();
								$mail->SMTPAuth = true;
								$mail->Host = 'smtp.stooge.com.ar'; // SMTP a utilizar. Por ej. smtp.elserver.com
								$mail->Username = 'test@stooge.com.ar'; // Correo completo a utilizar
								$mail->Password = 'aerolineas2015'; // Contraseña
								$mail->Port = 25; // Puerto a utilizar
								
								$mail->From = 'test@stooge.com.ar'; // Desde donde enviamos (Para mostrar)
								$mail->FromName = "Aerolineas";


								$mail->AddAddress($ap['mail']); // Esta es la direccion a donde enviamos
								
								$mail->IsHTML(true); // El correo se envía como HTML
								$mail->Subject = "Aerolineas - Disponibilidad de Plazas"; // Este es el titulo del email.
								$mail->Body = $cuerpoMail; // Mensaje a enviar
								$mail->Timeout = 600;
								//$exito = $mail->Send(); // Envía el correo.
								echo "<p class='bg-success'><span class='glyphicon glyphicon-ok'></span>&nbsp;Se envio el correo a : ".$ap['mail']."</p>";

							}//End foreach pasajeros
						}else{
							echo "<p class='bg-info'><span class='glyphicon glyphicon-info-sign'></span>&nbsp;No hay pasajeros en lista de espera para el vuelo codigo: ".$av['cod']."...</p>";
						}//End if pasajeros en espera
						
					}else{
						echo "<p class='bg-info'><span class='glyphicon glyphicon-info-sign'></span>&nbsp;No hay puestos libres en el vuelo codigo: ".$av['cod']."...</p>";
					}//End if puestos libres
					
				}//End foreach Clases
			}//End foreach vuelos
		}else{
			echo "<p class='bg-info'><span class='glyphicon glyphicon-info-sign'></span>&nbsp;No se encontraron vuelos proximos a vencer.</p>";
		}//End if
	}//End method alertaReservasSinConfirmar

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
		$contenidoQR.="Nro. Reserva: ".$numReserva."\n";
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