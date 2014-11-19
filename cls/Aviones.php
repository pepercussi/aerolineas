<?php require_once('cfg/core.php') ?>
<?php
class Aviones{
	
	private $db;
	
	private $codigoAvion;

	public function __construct(){
		$this->db = new Database();
	}
	public function __destruct() {
		$this->db = null;
	}

	public function getAsientosLibresByCodVuelo($codigoVuelo, $tipoVuelo){
		//Primero obtenco elcodigo de avion
		$this->codigoAvion = $this->getCodigoAvionByCodVuelo($codigoVuelo);
		
		$Reserva = new Reservas();
		
		echo "<table class='table'>";
			echo "<tbbody>";
			for ($f=0; $f < 30; $f++) {
				echo "<tr>";
				for ($c=0; $c < 11; $c++) { 
					// Ya en la celda pregunto el número de asiento
					$nroAsiento = $this->getNroAsiento($this->codigoAvion, $f, $c);
					$codAsiento = $this->getCodAsiento($this->codigoAvion, $f, $c);
					$claseAsiento = $this->getClaseAsiento($this->codigoAvion, $f, $c);
					
					if($nroAsiento==0){
						//Si es cero es una celada vacia
						echo "<td></td>";
					}else{
						//Hay asiento asi que pregunto si está ocupado o no
						$codReserva = $Reserva->getCodigoReservaByVueloAndAsiento($codigoVuelo, $codAsiento);
						if($codReserva==0){
							//El asiento esta libre
							if($claseAsiento==1){
								//Si es primera clase
								echo "<td class='active'>".$nroAsiento."</td>";
							}else{
								//Si es clase ejecutiva
								echo "<td class='success'>".$nroAsiento."</td>";
							}
						}else{
							//El asiento esta ocupado
							echo "<td class='danger'>".$nroAsiento."</td>";
						}//End if
						
					}//End if
					
				}//End for COLUMNAS
				echo "</tr>";
			}//End for FILAS
			echo "</tbbody>";
		echo "</table>";
	
	}//End method getAsientosLibresByCodVuelo

	public function getClaseAsiento($codigoAvion, $fila, $columna){
		$consulta00="SELECT a.cod_clase as clase_asiento
		FROM asiento a
		WHERE a.cod_tiene=".$codigoAvion."
		AND a.fila=".$fila."
		AND a.columna=".$columna."
		;";
		
		$result00=$this->db->query($consulta00);
		
		if(count($result00)>0){
			foreach($result00 as $r00){
				return $r00['clase_asiento'];
			}//end foreach
		}else{
			return 0;
		}//End if
	}//End method getCodAsientoByCodAvion
		
	public function getCodigoAvionByCodVuelo($codVuelo){
		$consulta00="SELECT cod_asignado_a as cod_avion
		FROM vuelo v
		WHERE v.cod=".$codVuelo."
		;";
		
		$result00=$this->db->query($consulta00);
		
		if(count($result00)>0){
			foreach($result00 as $r00){
				return $r00['cod_avion'];
			}//end foreach
		}else{
			return 0;
		}//End if
	}//End method getCodigoAvionByCodVuelo

	public function getCodAsiento($codigoAvion, $fila, $columna){
		$consulta00="SELECT a.cod as cod_asiento
		FROM asiento a
		WHERE a.cod_tiene=".$codigoAvion."
		AND a.fila=".$fila."
		AND a.columna=".$columna."
		;";
		
		$result00=$this->db->query($consulta00);
		
		if(count($result00)>0){
			foreach($result00 as $r00){
				return $r00['cod_asiento'];
			}//end foreach
		}else{
			return 0;
		}//End if
	}//End method getCodAsientoByCodAvion
		
	public function getNroAsiento($codigoAvion, $fila, $columna){
		$consulta00="SELECT a.numero as nro_asiento
		FROM asiento a
		WHERE a.cod_tiene=".$codigoAvion."
		AND a.fila=".$fila."
		AND a.columna=".$columna."
		;";
		
		$result00=$this->db->query($consulta00);
		
		if(count($result00)>0){
			foreach($result00 as $r00){
				return $r00['nro_asiento'];
			}//end foreach
		}else{
			return 0;
		}//End if
	}//End method getNroAsientoByCodAvion
		
}// End Class Aviones
?>