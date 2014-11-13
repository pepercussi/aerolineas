<?php require_once('cfg/core.php') ?>
<?php
class Aeropuertos{
	private $db;

	public function __construct(){
		$this->db = new Database();
	}
	public function __destruct() {
		$this->db = null;
	}

	public function getArrayAeropuertos(){
		$consulta = "SELECT 
		a.cod as codigo_aeropuerto,
		a.nombre as nombre_aeropuerto,
		a.direccion as direccion,
		a.ciudad as ciudad,
		p.cod as codigo_provincia,
		p.nombre as provincia,
		pa.cod as codigo_pais,
		pa.nombre as pais
		
		FROM aeropuerto a
		INNER JOIN pcia p ON p.cod=a.cod_pcia
		INNER JOIN pais pa ON pa.cod=p.cod_pais
		ORDER BY pa.nombre, p.nombre, a.nombre
		;";
		
		
		return $this->db->query($consulta);
		
	}//End getArrayAeropuertos

}// End Class Aeropuertos
?>