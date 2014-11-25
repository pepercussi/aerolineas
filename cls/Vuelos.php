<?php require_once('cfg/core.php') ?>
<?php
class Vuelos{
	
	private $db;

	public function __construct(){
		$this->db = new Database();
	}
	public function __destruct() {
		$this->db = null;
	}

	public function getArrayVuelos($fecha, $codOrigen, $codDestino){
		$consulta = "SELECT
		v.cod as codigo_vuelo,
		v.fecha_sal as fecha_salida,
		v.fecha_llegada as fecha_llegada,
		a1.cod as cod_destino,
		concat(a1.nombre, ' - ', a1.ciudad, ' - ', p1.nombre, ' - ', pa1.nombre) as destino,
		a2.cod as cod_origen,
		concat(a2.nombre, ' - ', a2.ciudad, ' - ', p2.nombre, ' - ', pa2.nombre) as origen,
		av.cod as codigo_avion,
		concat(av.marca, ' - ', av.modelo) as avion
		
		
		FROM vuelo v
		
		INNER JOIN aeropuerto a1 on a1.cod=v.cod_se_dirige_a
		INNER JOIN pcia p1 on p1.cod=a1.cod_pcia
		INNER JOIN pais pa1 on pa1.cod=p1.cod_pais
		
		INNER JOIN aeropuerto a2 on a2.cod=v.cod_parte_de
		INNER JOIN pcia p2 on p2.cod=a2.cod_pcia
		INNER JOIN pais pa2 on pa2.cod=p2.cod_pais
		
		INNER JOIN avion av on av.cod=v.cod_asignado_a
		
		WHERE v.fecha_sal LIKE '".$fecha."%'
		AND a2.cod=".$codOrigen."
		AND a1.cod=".$codDestino."
		;";

		//echo "<br/>".$consulta."<br/>";
		
		return $this->db->query($consulta);
		
	}//End getArrayAeropuertos

	public function getArrayVuelosByCodigo($codigo){
		$consulta = "SELECT
		v.cod as codigo_vuelo,
		v.fecha_sal as fecha_salida,
		v.fecha_llegada as fecha_llegada,
		a1.cod as cod_destino,
		concat(a1.nombre, ' - ', a1.ciudad, ' - ', p1.nombre, ' - ', pa1.nombre) as destino,
		a2.cod as cod_origen,
		concat(a2.nombre, ' - ', a2.ciudad, ' - ', p2.nombre, ' - ', pa2.nombre) as origen,
		av.cod as codigo_avion,
		concat(av.marca, ' - ', av.modelo) as avion
		
		
		FROM vuelo v
		
		INNER JOIN aeropuerto a1 on a1.cod=v.cod_se_dirige_a
		INNER JOIN pcia p1 on p1.cod=a1.cod_pcia
		INNER JOIN pais pa1 on pa1.cod=p1.cod_pais
		
		INNER JOIN aeropuerto a2 on a2.cod=v.cod_parte_de
		INNER JOIN pcia p2 on p2.cod=a2.cod_pcia
		INNER JOIN pais pa2 on pa2.cod=p2.cod_pais
		
		INNER JOIN avion av on av.cod=v.cod_asignado_a
		
		WHERE v.cod=".$codigo."
		;";

		//echo "<br/>".$consulta."<br/>";
		
		return $this->db->query($consulta);
		
	}//End getArrayVuelosByCodigo
	
	public function getArrayVuelosPorVencer($dias){
		$consulta00="SELECT cod, fecha_sal, fecha_llegada, cod_se_dirige_a, cod_parte_de, cod_asignado_a as cod_avion
		FROM vuelo
		WHERE fecha_sal>=NOW() AND fecha_sal<=DATE_ADD(NOW(), INTERVAL ".$dias." DAY);";
		
		return $this->db->query($consulta00);

	}//End method getArrayVuelosPorVencer
	
	public function getCodAvionByVuelo($codVuelo){
		$consulta00="SELECT cod_asignado_a as cod_avion
		FROM vuelo
		WHERE cod=".$codVuelo.";";
		
		$result00=$this->db->query($consulta00);
		
		if(count($result00)>0){
			foreach($result00 as $r00){
				return $r00['cod_avion'];
			}//End foreach
		}else{
			return 0;
		}//End if
		
		
	}//End method getCodAvionByVuelo
	
	public function getAllVuelos(){
		$consulta = "SELECT
		v.cod as codigo_vuelo,
		v.fecha_sal as fecha_salida,
		v.fecha_llegada as fecha_llegada,
		a1.cod as cod_destino,
		concat(a1.nombre, ' - ', pa1.nombre) as destino,
		a2.cod as cod_origen,
		concat(a2.nombre, ' - ', pa2.nombre) as origen,
		av.cod as codigo_avion,
		concat(av.marca, ' - ', av.modelo) as avion
		
		
		FROM vuelo v
		
		INNER JOIN aeropuerto a1 on a1.cod=v.cod_se_dirige_a
		INNER JOIN pcia p1 on p1.cod=a1.cod_pcia
		INNER JOIN pais pa1 on pa1.cod=p1.cod_pais
		
		INNER JOIN aeropuerto a2 on a2.cod=v.cod_parte_de
		INNER JOIN pcia p2 on p2.cod=a2.cod_pcia
		INNER JOIN pais pa2 on pa2.cod=p2.cod_pais
		
		INNER JOIN avion av on av.cod=v.cod_asignado_a
		;";

		//echo "<br/>".$consulta."<br/>";
		
		return $this->db->query($consulta);
	}
	
}// End Class Vuelos
?>