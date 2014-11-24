<?php require_once('cfg/core.php') ?>
<?php
class Pasajeros{
	
	private $db;
	
	public function __construct(){
		$this->db = new Database();
	}
	public function __destruct() {
		$this->db = null;
	}
	
	public function actualizaPasajeroByDni($dni, $apellido, $nombre, $mail, $f_nac){
		$consulta00="UPDATE pasajero
		SET apellido='".$apellido."', nombre='".$nombre."', mail='".$mail."', f_nac='".$f_nac."'
		WHERE dni=".$dni.";";
		$this->db->query($consulta00);
	}//End method actualizaPasajeroByDni
	
	public function controlaPasajeroByDni($dni){
		$consulta00="SELECT dni FROM pasajero WHERE dni=".$dni.";";
		$result00=$this->db->query($consulta00);
		
		if(count($result00)>0){
			return 1;
		}else{
			return 0;
		}//End if
	}//End method controlaPasajero
	
	public function getNombreyApellidoByDni($dni){
		$consulta00="SELECT nombre, apellido FROM pasajero where dni=".$dni.";";
		return $this->db->query($consulta00);
	}//End method getNombreyApellidoByDni
	
	public function getArrayPasajerosEnEspera($codVuelo, $clase, $totAsientos, $puestosLibres){
		$limiteHasta=$totAsientos+$puestosLibres;
		$consulta00="SELECT 
		r.num_reserva as nro_reserva,
		p.dni as dni,
		p.apellido as apellido,
		p.nombre as nombre,
		p.mail as mail,
		p.f_nac as f_nacimiento
		
		FROM reserva r
		INNER JOIN pasajero p ON p.dni=r.cod_pasajero
		WHERE r.cod_vuelo=".$codVuelo."
		AND clase=".$clase."
		ORDER BY r.cod
		LIMIT ".$totAsientos.", ".$limiteHasta."
		;";
		
		return $this->db->query($consulta00);
		
	}//End method
	
	public function insertaPasajero($dni, $apellido, $nombre, $mail, $f_nac){
		$consulta00="INSERT INTO pasajero (dni, apellido, nombre, mail, f_nac)
		VALUES (".$dni.", '".$apellido."', '".$nombre."', '".$mail."', '".$f_nac."');";
		$this->db->query($consulta00);
	}//End method insertaPasajero
	
}// End Class Pasajeros
?>