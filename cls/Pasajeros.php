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
	
	public function insertaPasajero($dni, $apellido, $nombre, $mail, $f_nac){
		$consulta00="INSERT INTO pasajero (dni, apellido, nombre, mail, f_nac)
		VALUES (".$dni.", '".$apellido."', '".$nombre."', '".$mail."', '".$f_nac."');";
		$this->db->query($consulta00);
	}//End method insertaPasajero
	
}// End Class Pasajeros
?>