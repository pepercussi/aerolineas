<?php require_once('cfg/core.php') ?>
<?php
class Reportes{
	
	private $db;
	
	private $codigoAvion;

	public function __construct(){
		$this->db = new Database();
	}
	public function __destruct() {
		$this->db = null;
	}

	public function getArrayVuelosVendidos($codClase, $codDestino){
		$consulta00="SELECT
		r.cod as codigo_reserva,
		r.num_reserva as nro_reserva,
		r.factura as factura,
		r.checkin as checkin,
		r.cod_asiento as codigo_asiento,
		r.cod_vuelo as codigo_vuelo,
		r.cod_pasajero as dni_pasajero,
		r.clase as codigo_clase,
		c.tipo as nombre_clase,
		a2.cod as cod_origen,
		concat(a2.nombre, ' - ', a2.ciudad, ' - ', p2.nombre, ' - ', pa2.nombre) as origen,
		a1.cod as cod_destino,
		concat(a1.nombre, ' - ', a1.ciudad, ' - ', p1.nombre, ' - ', pa1.nombre) as destino
		
		FROM reserva r
		INNER JOIN clase c ON c.cod=r.clase
		INNER JOIN vuelo v ON v.cod=r.cod_vuelo
		
		INNER JOIN aeropuerto a2 on a2.cod=v.cod_parte_de
		INNER JOIN pcia p2 on p2.cod=a2.cod_pcia
		INNER JOIN pais pa2 on pa2.cod=p2.cod_pais
		
		INNER JOIN aeropuerto a1 on a1.cod=v.cod_se_dirige_a
		INNER JOIN pcia p1 on p1.cod=a1.cod_pcia
		INNER JOIN pais pa1 on pa1.cod=p1.cod_pais
		
		
		WHERE r.factura>0";
		
		if($codClase!=0){
			$consulta00.=" AND c.cod=".$codClase;
		}
		if($codDestino!=0){
			$consulta00.=" AND a1.cod=".$codDestino;
		}
		
		$consulta00.=";";

		return $this->db->query($consulta00);
	}//End method getArrayClases

				
}// End Class Aviones
?>

