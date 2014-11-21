<?php require_once('cfg/core.php') ?>
<?php
class Reservas{
	
	private $db;
	
	public function __construct(){
		$this->db = new Database();
	}
	public function __destruct() {
		$this->db = null;
	}
	
	public function checkCapacidadByVuelo($codVuelo){
		$Avion = new Aviones();
		$Vuelo = new Vuelos();
		
		//Primero obtengo el codigo del avion
		$codAvion = $Vuelo->getCodAvionByVuelo($codVuelo);
		
		//Luego obtengo la cantidad de asientos del avion
		$cantAsientos = $Avion->getCantidadAsientosByCodAvion($codAvion);
		
		//Por ultimo obtengo la cantidad de asientos ocupados del vuelo y comparo con la cantidad total
		$cantReservas = $this->getCantReservasByCodVuelo($codVuelo);
		
		if(($cantAsientos-$cantReservas)>0){
			//Hay asientos
			return 1;
			//return 0;
		}else{
			//No hay asientos
			return 0;
		}

	}//End method checkCapacidadByVuelo
	
	public function checkReserva($numReserva, $dniPasajero){
		$consulta00="SELECT cod FROM reserva WHERE num_reserva='".$numReserva."' AND cod_pasajero=".$dniPasajero.";";
		$result00=$this->db->query($consulta00);
		//echo "</br>".$consulta00."</br>";
		if(count($result00)>0){
			return 1;
		}else{
			return 0;
		}
		
	}//End method checkReserva
	
	public function getCantReservasByCodVuelo($codVuelo){
		$consulta00="SELECT count(cod) as Cantidad
		FROM reserva
		WHERE cod_vuelo=".$codVuelo."
		;";
		
		$result00=$this->db->query($consulta00);
		
		if(count($result00)>0){
			foreach($result00 as $r00){
				return $r00['Cantidad'];
			}//End foreach
		}else{
			return 0;
		}//End if

	}//End method getCantReservasByCodVuelo
	
	public function getCodigoReservaByVueloAndAsiento($codigoVuelo, $codigoAsiento){
		$consulta00="SELECT r.cod as cod_reserva
		FROM reserva r
		WHERE r.cod_asiento=".$codigoAsiento."
		AND r.Cod_vuelo=".$codigoVuelo."
		;";

		$result00=$this->db->query($consulta00);
		
		if(count($result00)>0){
			foreach($result00 as $r00){
				return $r00['cod_reserva'];
			}//end foreach
		}else{
			return 0;
		}//End if

	}//End method

	public function getRandomCode($length = 5) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++){
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}//End method getRandomCode
	
	public function insertaReserva($numReserva, $factura, $checkIn, $codAsiento, $codVuelo, $codPasajero){
		$consulta00="INSERT INTO reserva (num_reserva, factura, checkin, cod_asiento, cod_vuelo, cod_pasajero)
		VALUES ('".$numReserva."', '".$factura."', ".$checkIn.", ".$codAsiento.", ".$codVuelo.", ".$codPasajero.");";
		//echo "</br>".$consulta00."</br>";
		$this->db->query($consulta00);
	}//End method insertaReserva

	public function getDatosReserva($codDni, $codReserva){
		$consulta00="SELECT
		p.nombre, 
		p.apellido, 
		v.fecha_sal, 
		v.fecha_llegada,  
		r.num_reserva as codReserva,	
		r.factura,	
		a1.cod as cod_destino,
		concat(a1.nombre, ' - ', a1.ciudad, ' - ', p1.nombre, ' - ', pa1.nombre) as destino,
		a2.cod as cod_origen,
		concat(a2.nombre, ' - ', a2.ciudad, ' - ', p2.nombre, ' - ', pa2.nombre) as origen,
		av.cod as codigo_avion,
		r.checkin
		
		FROM reserva r
		INNER JOIN pasajero p on p.dni=r.cod_pasajero
		INNER JOIN vuelo v on v.cod=r.cod_vuelo
		INNER JOIN asiento a on a.cod=r.cod_asiento
		
		INNER JOIN aeropuerto a1 on a1.cod=v.cod_se_dirige_a
		INNER JOIN pcia p1 on p1.cod=a1.cod_pcia
		INNER JOIN pais pa1 on pa1.cod=p1.cod_pais
		
		INNER JOIN aeropuerto a2 on a2.cod=v.cod_parte_de
		INNER JOIN pcia p2 on p2.cod=a2.cod_pcia
		INNER JOIN pais pa2 on pa2.cod=p2.cod_pais
		
		INNER JOIN avion av on av.cod=v.cod_asignado_a
		
		WHERE r.num_reserva='".$codReserva."'
		AND p.dni=".$codDni."
		;";
		$result00=$this->db->query($consulta00);
		
		if(count($result00)>0){
			foreach ($result00 as $r00){
				$fechaActual = strtotime ("now"); //fecha actual en segundos
				$fechaVuelo = strtotime ($r00['fecha_sal']); // fecha de vuelo en segundos
				$fechaSegundos = $fechaVuelo-$fechaActual; //diferencia entre fecha de viaje y fecha actual en segundos
				//Condicion para check-in
				//Si el check-in no se encuentra realizado
				if($r00['factura']==NULL){
					echo "<div class='alert alert-info text-center' role='alert'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span>Debe abonar su pasaje antes de realizar el check-in. Ingrese AQUI</div>";
					return 0;
				}	
				if($r00['checkin']==0){
					if($fechaSegundos > 7200 && $fechaSegundos < 172800){ //48 hs antes del vuelo y 2 hs previas al despegue
						echo "<table class='table'>"; //Dibujo tabla con los resultados de la reserva
							echo "<thead>";
								echo "<tr>";
									echo "<th> Codigo de vuelo </th>";
									echo "<th> Nombre y apellido </th>";
									echo "<th> Origen </th>";
									echo "<th> Fecha de salida </th>";
									echo "<th> Destino </th>";
									echo "<th> Fecha de llegada </th>";
								echo "</tr>";
							echo "</thead>";
							echo "<tbbody>";
							foreach ($result00 as $r00) {				
									echo "<tr>";
										echo "<td>";
											echo $r00['codReserva'];
										echo "</td>";
										echo "<td>";
											echo $r00['nombre']." ".$r00['apellido'];
										echo "</td>";
										echo "<td>";
											echo $r00['origen'];
										echo "</td>";
										echo "<td>";
											echo $r00['fecha_sal'];
										echo "</td>";
										echo "<td>";
											echo $r00['destino'];
										echo "</td>";
										echo "<td>";
											echo $r00['fecha_llegada'];
										echo "</td>";
									echo "</tr>";
							}//end foreach
							echo "</tbody>";
						echo "</table>";
						//Almaceno en variables los datos de dni y codigo pasados por POST
						echo "<input type='hidden' name='hDni' value='".$codDni."' />";
						echo "<input type='hidden' name='hReserva' value='".$codReserva."' />";			
						echo "<div class='col-md-5'></div>";
						echo "<div class='col-md-2'><button type='submit' class='btn btn-primary btn-lg'>Confirmar check-in<span class='glyphicon glyphicon-plane' aria-hidden='true'></span></button></div>";	
						echo "<div class='col-md-5'></div>";
						} //End if condicion de horario
					else{
						echo "<div class='alert alert-danger text-center' role='alert'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span>El check-in solo puede efectuarse 48hs antes del vuelo y 2 hs previas al despegue.</br> Por favor, cumpla con estos requisitos.</br> Muchas gracias</div>";
					}//End if				
				}
				else{
						echo "<div class='alert alert-info text-center' role='alert'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span>El check-in ya ha sido realizado. En caso de requerir nuevamente la tarjeta de embarque, haga clic aqui</div>";
				}
				return 0;
			}
		}
		else{
			echo "<div class='alert alert-info text-center' role='alert'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span>No se encontraron reservas referidas al codigo ingresado</div>";
		}//End if
	}//End method getDatosReserva

	function getArrayReserva($hDni,$hReserva){
		$consulta00="SELECT
		p.nombre, 
		p.apellido, 
		v.fecha_sal, 
		v.fecha_llegada,  
		r.num_reserva as codReserva,		
		a1.cod as cod_destino,
		concat(a1.nombre, ' - ', a1.ciudad, ' - ', p1.nombre, ' - ', pa1.nombre) as destino,
		a2.cod as cod_origen,
		concat(a2.nombre, ' - ', a2.ciudad, ' - ', p2.nombre, ' - ', pa2.nombre) as origen,
		av.cod as codigo_avion,
		r.checkin
		
		FROM reserva r
		INNER JOIN pasajero p on p.dni=r.cod_pasajero
		INNER JOIN vuelo v on v.cod=r.cod_vuelo
		INNER JOIN asiento a on a.cod=r.cod_asiento
		
		INNER JOIN aeropuerto a1 on a1.cod=v.cod_se_dirige_a
		INNER JOIN pcia p1 on p1.cod=a1.cod_pcia
		INNER JOIN pais pa1 on pa1.cod=p1.cod_pais
		
		INNER JOIN aeropuerto a2 on a2.cod=v.cod_parte_de
		INNER JOIN pcia p2 on p2.cod=a2.cod_pcia
		INNER JOIN pais pa2 on pa2.cod=p2.cod_pais
		
		INNER JOIN avion av on av.cod=v.cod_asignado_a
		
		WHERE r.num_reserva='".$hReserva."'
		AND p.dni=".$hDni."
		;";
		return $this->db->query($consulta00);
		
	}		
}// End Class Reservas
?>