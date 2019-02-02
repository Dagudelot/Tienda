<?php 

class Utils{

	public static function eliminarSesion($sesionName){
		if(isset($_SESSION[$sesionName])){
			$_SESSION[$sesionName] = null;
		}
	}

	public static function isAdmin(){
		if(isset($_SESSION['usuario'])){

			if($_SESSION['usuario']->rol == 'admin'){
				return true;
			}else{
				header('Location: '.base_url);
			}

		}else{
			header('Location: '.base_url);
		}
	}

}

?>