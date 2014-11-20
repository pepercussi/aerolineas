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
		VALUES ('".$numReserva."', ".$factura.", ".$checkIn.", ".$codAsiento.", ".$cod_vuelo.", ".$codPasajero.");";
		
		$this->db->query($consulta00);
	}//End method insertaReserva
		
}// End Class Reservas
?>