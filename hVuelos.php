<?php require_once('cfg/core.php') ?>
<?php

if(isset($_POST['metodo'])){
	$metodo=$_POST['metodo'];
	
	if($metodo=="buscaVuelos00"){
		$fecha = $_POST["fechaVuelo"];
		$codigoOrigen = $_POST["origen"];
		$codigoDestino = $_POST["destino"];
		$tipo = $_POST["tipoVuelo"];
		
		$Vuelo = new Vuelos();
		
		
		
		if($tipo=="ida"){
			$arrVuelos = $Vuelo->getArrayVuelos($fecha, $codigoOrigen, $codigoDestino);
			echo "<h1>Vuelos de Ida</h1>";
			if(count($arrVuelos)>0){
				echo "<input type='hidden' id='hIda' value='1' />";
				echo "<table class='table table-striped'>";
					echo "<thead>";
						echo "<th>Origen</th>";
						echo "<th>Destino</th>";
						echo "<th>Fecha de Salida</th>";
						echo "<th>Fecha de Llegada</th>";
						echo "<th>Seleccionar</th>";
					echo "</thead>";
					echo "<tbody>";
					foreach($arrVuelos as $av){
						echo "<td>".$av['origen']."</td>";
						echo "<td>".$av['destino']."</td>";
						echo "<td>".$av['fecha_salida']."</td>";
						echo "<td>".$av['fecha_llegada']."</td>";
						echo "<td class='text-center'><input type='radio' name='radVueloIda' id='radVueloIda' value='".$av['codigo_vuelo']."'></input></td>";
					}//End foreach
					echo "</tbody>";
				echo "</table>";
			}else{
				echo "Su busqueda no trajo resultados";
			}
			
		}//End if Ida

		if($tipo=="vuelta"){
			$arrVuelos = $Vuelo->getArrayVuelos($fecha, $codigoOrigen, $codigoDestino);
			echo "<h1>Vuelos de Vuelta</h1>";
			if(count($arrVuelos)>0){
				echo "<input type='hidden' id='hVuelta' value='1' />";
				echo "<table class='table table-striped'>";
					echo "<thead>";
						echo "<th>Origen</th>";
						echo "<th>Destino</th>";
						echo "<th>Fecha de Salida</th>";
						echo "<th>Fecha de Llegada</th>";
						echo "<th>Seleccionar</th>";
					echo "</thead>";
					echo "<tbody>";
					foreach($arrVuelos as $av){
						echo "<td>".$av['origen']."</td>";
						echo "<td>".$av['destino']."</td>";
						echo "<td>".$av['fecha_salida']."</td>";
						echo "<td>".$av['fecha_llegada']."</td>";
						echo "<td class='text-center'><input type='radio' name='radVueloVuelta' id='radVueloVuelta' value='".$av['codigo_vuelo']."'></input></td>";
					}//End foreach
					echo "</tbody>";
				echo "</table>";
			}else{
				echo "Su busqueda no trajo resultados";
			}
			
		}//End if vuelta
				
		
	}//End metodo buscaVuelos00
	
	
}//End POST

?>