<?php 

$productos = array();

for ($i=0; $i < 5; $i++) { 
	array_push($productos, array(
		"id" => ($i+1),
		"nombre" => "Buso"

	));
}


//echo $productos[1]['cantidad'];

var_dump($productos);
 ?>