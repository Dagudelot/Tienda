<?php 

$nombre = "Justin";
$pass = "justin123";

if(preg_match('/'.$nombre.'/i', $pass)){
	echo "Coinciden";
}else{
	echo "NO coinciden";
}

?>