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


		
}// End Class Aviones
?>