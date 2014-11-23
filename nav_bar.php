<?php
$path = $_SERVER['PHP_SELF'];
$arrPath = explode("/", $path);
$direccionActual = "";
foreach($arrPath as $ap){
	$direccionActual = $ap;
}//End foreach

?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">AEROLINEAS</a>
	    </div>
	    <div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
		        <li <?php if($direccionActual=="reserva-00.php"){echo "class='active'";}?>><a href="reserva-00.php">Reservar</a></li>
		        <li <?php if($direccionActual=="pago.php"){echo "class='active'";}?>><a href="pago.php">Pagar</a></li>
		        <li <?php if($direccionActual=="checkin.php"){echo "class='active'";}?>><a href="checkin.php">Check-in</a></li>
	      	</ul>
	    </div>
	</div>
</nav>
