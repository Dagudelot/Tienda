<?php 

session_start();
require_once('config/utils.php');

require_once('autoload.php');
require_once('config/database/database.php');
require_once('config/parameters.php');

require_once('views/layouts/header.php');
require_once('views/layouts/main_nav.php');
require_once('views/layouts/barra_lateral.php');

function wrong_page(){
	$error = new errorController();
	$error->index();
}

if(isset($_GET['controller'])){
	
	$class_name = $_GET['controller']."Controller";

	if(class_exists($class_name)){

		$object = new $class_name();

		if(isset($_GET['accion'])){
			$method = $_GET['accion'];

			if(method_exists($class_name, $method)){
				$object->$method();
			}else{
				wrong_page();
			}
		}
		
	}else{
		wrong_page();
	}

}else{
	$controlador_defecto = default_controller;
	$accion_defecto = default_action;

	$object = new $controlador_defecto();
	$object->$accion_defecto();
}

require_once('views/layouts/footer.php');

?>