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
	
	public function checkCapacidadByVuelo($codVuelo, $clase){
		$Avion = new Aviones();
		$Vuelo = new Vuelos();
		
		//Primero obtengo el codigo del avion
		$codAvion = $Vuelo->getCodAvionByVuelo($codVuelo);
		
		//Luego obtengo la cantidad de asientos por clase del avion
		$cantAsientos = $Avion->getCantidadAsientosByCodAvion($codAvion, $clase);
		
		//Por ultimo obtengo la cantidad de asientos ocupados del vuelo por clase y comparo con la cantidad total
		$cantReservas = $this->getCantReservasByCodVuelo($codVuelo, $clase);
		
		$diferencia=$cantAsientos-$cantReservas;
		if($diferencia>0){
			//Hay asientos
			return 0;
		}elseif($diferencia>(-11)){
			//No hay asientos pero se puede entrar a lista de espera
			return 1;
		}else{
			//No hay asientos y no se puede entrar a lista de espera
			return 2;
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
	
	public function getCantReservasByCodVuelo($codVuelo, $clase){
		$consulta00="SELECT count(cod) as Cantidad
		FROM reserva
		WHERE cod_vuelo=".$codVuelo."
		AND clase=".$clase."
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
	
	public function insertaReserva($numReserva, $factura, $checkIn, $codAsiento, $codVuelo, $codPasajero, $clase){
		$consulta00="INSERT INTO reserva (num_reserva, factura, checkin, cod_asiento, cod_vuelo, cod_pasajero, clase)
		VALUES ('".$numReserva."', '".$factura."', ".$checkIn.", ".$codAsiento.", ".$codVuelo.", ".$codPasajero.", ".$clase.");";
		//echo "</br>".$consulta00."</br>";
		$this->db->query($consulta00);
	}//End method insertaReserva

	public function getDatosReserva($codDni, $codReserva){
		
		$result00=$this->getArrayReserva($codDni, $codReserva);
		$tipoVuelo=0;
		if(count($result00)>1){$tipoVuelo=1;}//Si hay mas de un resultado es un vuelo de ida y vuelta
		$flag=0;
		$vueloIda=$vueloVuelta=0;
		$claseVuelo=0;
		
		if(count($result00)>0){
			foreach ($result00 as $r00){
				$fechaActual = strtotime ("now"); //fecha actual en segundos
				$fechaVuelo = strtotime ($r00['fecha_sal']); // fecha de vuelo en segundos
				$fechaSegundos = $fechaVuelo-$fechaActual; //diferencia entre fecha de viaje y fecha actual en segundos
				//Condicion para check-in
				//Si el check-in no se encuentra realizado
				if($r00['factura']==0){
					echo "<div class='alert alert-info text-center' role='alert'>";
						echo "<span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> Debe abonar su pasaje antes de realizar el check-in. Para realizar el pago por favor ingrese <a href='pago.php'>AQUI</a>";
					echo "</div>";
					return 0;
				}//End if
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
										echo "<td>".$r00['codReserva']."</td>";
										echo "<td>".$r00['nombre']." ".$r00['apellido']."</td>";
										echo "<td>".$r00['origen']."</td>";
										echo "<td>".$r00['fecha_sal']."</td>";
										echo "<td>".$r00['destino']."</td>";
										echo "<td>".$r00['fecha_llegada']."</td>";
									echo "</tr>";
									if($flag==0){
										//Es el vuelo de ida
										$vueloIda=$r00['cod_vuelo'];
										$flag++;
									}else{
										$vueloVuelta=$r00['cod_vuelo'];;
									}//End if
									$claseVuelo=$r00["clase"];
							}//end foreach
							echo "</tbody>";
						echo "</table>";
						//Almaceno en variables los datos de dni y codigo pasados por POST
						echo "<input type='hidden' id='hDni' name='hDni' value='".$codDni."' />";
						echo "<input type='hidden' id='hReserva' name='hReserva' value='".$codReserva."' />";
						echo "<input type='hidden' id='hTipoVuelo' name='hTipoVuelo' value='".$tipoVuelo."' />";
						echo "<input type='hidden' id='hCodVueloIda' name='hCodVueloIda' value='".$vueloIda."' />";
						echo "<input type='hidden' id='hCodVueloVuelta' name='hCodVueloVuelta' value='".$vueloVuelta."' />";
						echo "<input type='hidden' id='hCodClase' name='hCodClase' value='".$claseVuelo."' />";						
						echo "<div class='col-md-12 col-xs-12 text-center'><button id='btnSeleccionaAsiento' type='button' class='btn btn-default btn-lg' onclick='seleccionaAsiento()'>Seleccionar Asientos<span class='glyphicon glyphicon-plane' aria-hidden='true'></span></button></div>";	
						//echo "<div class='col-md-12 col-xs-12 text-center'><button type='submit' class='btn btn-primary btn-lg'>Confirmar check-in<span class='glyphicon glyphicon-plane' aria-hidden='true'></span></button></div>";	
					} //End if condicion de horario
					else{
						echo "<div class='alert alert-danger text-center' role='alert'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> El check-in solo puede efectuarse 48hs antes del vuelo y 2 hs previas al despegue.</br> Por favor, cumpla con estos requisitos.</br> Muchas gracias</div>";
					}//End if				
				}else{
						echo "<div class='alert alert-info text-center' role='alert'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> El check-in ya ha sido realizado. En caso de requerir nuevamente la tarjeta de embarque, haga clic aqui</div>";
				}//End if chekin
				return 0;
			}//End foreach
		}else{
			echo "<div class='alert alert-info text-center' role='alert'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span>No se encontraron reservas referidas al codigo ingresado</div>";
		}//End if
	}//End method getDatosReserva

	public function getArrayReserva($codDni,$codReserva){
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
		r.checkin,
		r.cod_vuelo as cod_vuelo,
		r.clase,
		a.numero as nro_asiento
		
		FROM reserva r
		INNER JOIN pasajero p on p.dni=r.cod_pasajero
		INNER JOIN vuelo v on v.cod=r.cod_vuelo
		LEFT JOIN asiento a on a.cod=r.cod_asiento
		
		INNER JOIN aeropuerto a1 on a1.cod=v.cod_se_dirige_a
		INNER JOIN pcia p1 on p1.cod=a1.cod_pcia
		INNER JOIN pais pa1 on pa1.cod=p1.cod_pais
		
		INNER JOIN aeropuerto a2 on a2.cod=v.cod_parte_de
		INNER JOIN pcia p2 on p2.cod=a2.cod_pcia
		INNER JOIN pais pa2 on pa2.cod=p2.cod_pais
		
		INNER JOIN avion av on av.cod=v.cod_asignado_a
		
		WHERE r.num_reserva='".$codReserva."'
		AND p.dni=".$codDni."
		
		ORDER BY r.cod
		;";
		return $this->db->query($consulta00);
		

	}//End method getArrayReserva	
		
	public function getClase($clase){
		$consulta00="SELECT
		tipo
		FROM clase
		WHERE cod=".$clase.
		";";
		
		$result00=$this->db->query($consulta00);
		
		if(count($result00)>0){
				foreach($result00 as $r00){
					return $r00['tipo'];
				}//end foreach
		}else{
			return 0;
		}//End if
	}//End method getClase
	
	public function getEstadoDePago($codDni, $codReserva){
		$consulta00="SELECT
		factura
		FROM reserva
		WHERE cod_pasajero=".$codDni."
		AND num_reserva='".$codReserva."'
		;";
		
		$result00=$this->db->query($consulta00);
	
		if(count($result00)>0){
				foreach($result00 as $r00){
					return $r00['factura'];
				}//end foreach
		}else{
			return 0;
		}//End if
		
	}//End method getPago

	public function realizaCheckIn($nroReserva, $codPasajero, $codVuelo, $codAsiento){
		$consulta00="UPDATE reserva
		SET checkin=1, cod_asiento=".$codAsiento."
		WHERE num_reserva='".$nroReserva."'
		AND cod_vuelo=".$codVuelo."
		AND cod_pasajero=".$codPasajero.";";
		
		$this->db->query($consulta00);
	}//End method realizaCheckIn

	public function getPrecioVuelo($codDni, $codReserva, $clase){
		$consulta00="SELECT 
		cu.precio
		
		FROM cuesta cu 
		
		INNER JOIN clase cl on cl.cod=cu.cod_clase 
		INNER JOIN vuelo v on v.cod=cu.cod_vuelo 
		INNER JOIN reserva r on r.cod_vuelo=v.cod 
		
		WHERE r.cod_pasajero=".$codDni."
		AND r.num_reserva='".$codReserva."'
		AND cl.cod=".$clase."
		;"; 
		
		$result00=$this->db->query($consulta00);
		
		if(count($result00)>0){
			$precio=0;
			foreach ($result00 as $r00) {
				$precio=$precio+$r00['precio'];
			}
			return $precio;
		}else{
			return 0;
		}//End if
		
	}//End method getPrecioVuelo
	
	public function getUltimaFactura(){
		$consulta00="SELECT
		MAX(factura) as ultimaFct
		FROM reserva";
		
		$result00=$this->db->query($consulta00);
		
		if(count($result00)>0){
			foreach ($result00 as $r00) {
				return $r00['ultimaFct'];
			}
		}else{
			return 0;
		}//End if
	
	}//End method getUltimaFactura
	
	public function actualizaFactura($proxFct, $codDni, $codReserva){
		$consulta00 = "UPDATE reserva 
		SET factura=".$proxFct."
		WHERE cod_pasajero=".$codDni."
		AND num_reserva='".$codReserva."'
		;"; 
		
		$this->db->query($consulta00);
	
	}//End method actualizaFactura
	
}// End Class Reservas
?>