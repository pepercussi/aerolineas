<?php require_once('cfg/core.php') ?>
<?php

if(isset($_POST['metodo'])){
	$metodo=$_POST['metodo'];

	if($metodo=="buscaPasajesVendidos"){
		$Reporte = new Reportes();
		$categoria = $_POST['cod_categoria'];
		$destino = $_POST['cod_aeropuerto'];
		$arrReporte = $Reporte->getArrayVuelosVendidos($categoria, $destino);
		$cantVuelos = count($arrReporte);
		
		if($cantVuelos>0){
			require_once ('lib/src/jpgraph/jpgraph.php');
			require_once ('lib/src/jpgraph/jpgraph_pie.php');
			require_once ('lib/src/jpgraph/jpgraph_pie3d.php');
			
			echo "<table class='table table-striped'>";
				echo "<thead>";
					echo "<tr>";
						echo "<th>C&oacute;digo Reserva</th>";
						echo "<th>Origen</th>";
						echo "<th>Destino</th>";
						echo "<th>DNI Pasajero</th>";
						echo "<th>Categor&iacute;a</th>";
						echo "<th>Factura</th>";
					echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				foreach($arrReporte as $ar){
					echo "<tr>";
						echo "<td>".$ar['nro_reserva']."</td>";
						echo "<td>".$ar['origen']."</td>";
						echo "<td>".$ar['destino']."</td>";
						echo "<td>".$ar['dni_pasajero']."</td>";
						echo "<td>".$ar['nombre_clase']."</td>";
						echo "<td>".$ar['factura']."</td>";
					echo "</tr>";
				}//End foreach
				echo "</tbody>";
			echo "</table>";
			echo "<p class='bg-success text-center'><span class='glyphicon glyphicon-ok'></span>&nbsp;Se han encontrado <strong>".$cantVuelos."</strong> registros.</p>";
		}else{
			echo "<p class='bg-info text-center'><span class='glyphicon glyphicon-info-sign'></span>&nbsp;Su b&uacute;squeda no arroj&oacute; resultados.</p>";
		}//End if
		
	}//End method buscaPasajesVendidos
	
	if($metodo=="buscaOcupacion"){
		$Reporte = new Reportes();
		$vuelo=$_POST['cod_vuelo'];
		$arrReporte = $Reporte->getOcupacionByVuelo($vuelo);
		
	}//End method buscarOcupacion

}//End if post
