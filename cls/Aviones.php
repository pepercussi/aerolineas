<?php require_once('cfg/core.php') ?>
<?php
class Aviones{
	
	private $db;

	public function __construct(){
		$this->db = new Database();
	}
	public function __destruct() {
		$this->db = null;
	}

	public function getAsientosLibresByCodVuelo(){
		
	}//End method
}// End Class Aviones
?>