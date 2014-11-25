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

	public function getOcupacionByVuelo($codVuelo){
		$consulta00="SELECT cod_vuelo		
		FROM reserva r
		INNER JOIN vuelo v on v.cod=r.cod_vuelo
		WHERE r.cod_vuelo=".$codVuelo."
 		";
 		
 		$resultado00 = $this->db->query($consulta00);
 		
 		$cantVuelos = count ($resultado00); //cantidad de reservas en ese vuelo
 		
 		$consulta01="SELECT t.total_plazas
		FROM vuelo v
		INNER JOIN avion a on a.cod=v.cod_asignado_a
		INNER JOIN tipo t on t.cod=a.cod_tipo
		WHERE v.cod_asignado_a=".$codVuelo."
		LIMIT 1;";
		
		$resultado01 = $this->db->query($consulta01);
		
		$cantTotal=0;
		$cantOcupada=0;
		if($cantVuelos!=0){
			foreach($resultado01 as $r01){
				echo "<p class='bg-success text-center'><span class='glyphicon glyphicon-ok'></span>&nbsp;La cantidad de asientos ocupados es de <strong>".$cantVuelos."</strong> sobre <strong>".$r01['total_plazas']."</strong> plazas disponibles</p>";
				$cantTotal=$r01['total_plazas'];
				$cantOcupada=$cantTotal-$cantVuelos;
			}	
		}else{
			echo "<p class='bg-success text-center'><span class='glyphicon glyphicon-ok'></span>&nbsp;El avion se encuentra disponible en el 100% de sus plazas.</p>";
		}
		
		
	}//End method getOcupacionByVuelo
	
}// End Class Aviones
?>

