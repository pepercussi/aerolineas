<?php require_once('cfg/core.php') ?>
<?php

if(isset($_POST['metodo'])){
	$metodo=$_POST['metodo'];

	if($metodo=="buscaPasajesVendidos"){
		$Reporte = new Reportes();
		$categoria = $_POST['cod_categoria'];
		$destino = $_POST['cod_aeropuerto'];
		$arrReporte = $Reporte->getArrayVuelosVendidos($categoria, $destino);
		$arrGraficoDestinos = $Reporte->getArrayVuelosVendidosGroupByDestino($categoria, $destino);
		$arrGraficoClases = $Reporte->getArrayVuelosVendidosGroupByClase($categoria, $destino);
		$cantVuelos = count($arrReporte);
		
		if($cantVuelos>0){
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
			
			//Preparo los graficos
			// content="text/plain; charset=utf-8"
			require_once ('lib/jpgraph/src/jpgraph.php');
			require_once ('lib/jpgraph/src/jpgraph_pie.php');
			require_once ('lib/jpgraph/src/jpgraph_pie3d.php');
			//Primero el grafico por destino
			//Cargo el array de datos
			$i=0;
			$arrGDVal=array();
			foreach($arrGraficoDestinos as $gd){
				$arrGDVal[$i]=$gd['cant'];
				$i++;
			}//End foreach
			//Luego cargo el array en la variable data
			$data = $arrGDVal;
			//Creamos el grafico de torta
			$graph = new PieGraph(350,250);
			$theme_class= new VividTheme;
			$graph->SetTheme($theme_class);
			//le ponemos un titulo
			$graph->title->Set("Cantidad de vuelos x destino");
			//Creamos
			$p1 = new PiePlot3D($data);
			$graph->Add($p1);
			$p1->ShowBorder();
			$p1->SetColor('black');
			$p1->ExplodeSlice(1);
			$fileGraphDestino="media/img/tmp_g_vuelosVendidosByDest-".date("YmdHis").".png";
			$graph->Stroke($fileGraphDestino);

			//Luego el grafico por clases
			//Cargo el array de datos
			$i=0;
			$arrGCVal=array();
			foreach($arrGraficoClases as $gc){
				$arrGCVal[$i]=$gc['cant'];
				$i++;
			}//End foreach
			//Luego cargo el array en la variable data
			$data = $arrGCVal;
			//Creamos el grafico de torta
			$graph = new PieGraph(350,250);
			$theme_class= new VividTheme;
			$graph->SetTheme($theme_class);
			//le ponemos un titulo
			$graph->title->Set("Cantidad de vuelos x clase");
			//Creamos
			$p1 = new PiePlot3D($data);
			$graph->Add($p1);
			$p1->ShowBorder();
			$p1->SetColor('black');
			$p1->ExplodeSlice(1);
			$fileGraphClase="media/img/tmp_g_vuelosVendidosByClas-".date("YmdHis").".png";
			$graph->Stroke($fileGraphClase);

			
			//Imprimo los grafios
			echo "<div class='row rowFiltro00'>";
				echo "<div class='col-md-6 col-xs-12 text-center'>";
					echo "<img class='img-responsive img-thumbnail' alt='grafico por destinos' src='".$fileGraphDestino."'/>";
				echo "</div>";
				echo "<div class='col-md-6 col-xs-12 text-center'>";
					echo "<img class='img-responsive img-thumbnail' alt='grafico por destinos' src='".$fileGraphClase."'/>";
				echo "</div>";
			echo "</div>";
			
		}else{
			echo "<p class='bg-info text-center'><span class='glyphicon glyphicon-info-sign'></span>&nbsp;Su b&uacute;squeda no arroj&oacute; resultados.</p>";
		}//End if
		
	}//End method buscaPasajesVendidos
	
	if($metodo=="buscaOcupacion"){
		$Reporte = new Reportes();
		$cod_vuelo=$_POST['cod_vuelo'];
		$arrReporte = $Reporte->getOcupacionByVuelo($cod_vuelo);
		
	}//End method buscarOcupacion

	if($metodo=="buscaReservasCaidas"){
		$Reporte = new Reportes();
		$cod_vuelo=$_POST['cod_vuelo'];
		$arrReporte = $Reporte->getReservasCaidas($cod_vuelo);
		$cantCaidas=count($arrReporte);
		echo "Caidas: ".$cantCaidas;
		foreach($arrReporte as $arr){
			echo $arr['cod'];
		}
	
	}//End method buscarOcupacion
}//End if post
