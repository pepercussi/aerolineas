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

	public function getDatosReserva($codDni, $codReserva){
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
		concat(av.marca, ' - ', av.modelo) as avion
		
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
			echo "<table class='table'>"; //Dibujo tabla con los resultados de la reserva
					echo "<thead>";
						echo "<tr>";
							echo "<th> Nombre y apellido </th>";
							echo "<th> Origen </th>";
							echo "<th> Fecha de salida </th>";
							echo "<th> Destino </th>";
							echo "<th> Fecha de llegada </th>";
							echo "<th> Codigo de vuelo </th>";
						echo "</tr>";
					echo "</thead>";
			foreach ($result00 as $r00) {
				
					echo "<tbbody>";
						echo "<tr>";
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
							echo "<td>";
								echo $r00['codReserva'];
							echo "</td>";
						echo "</tr>";
					echo "</tbody>";
				echo "</table>";	
								
			}//end foreach
		}else{
			return 0;
		}//End if
	}//End method getDatosReserva
		
}// End Class Aviones
?>