<?php 

require_once('models/Usuario.php');

class usuarioController{

	public function index(){
		echo "You are in usuarioController, and method is index";
	}

	public function registro(){
		require_once('views/usuario/registro.php');
	}

	public function save(){

		if (isset($_POST)) {
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
			$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
			$email = isset($_POST['email']) ? $_POST['email'] : null;
			$contra = isset($_POST['contrasenia']) ? $_POST['contrasenia'] : null;

			$validacion = $this->validarDatos($nombre, $apellido, $email, $contra);

			if($validacion){
				$usuario = new Usuario();
				$usuario->setNombre($nombre);
				$usuario->setApellido($apellido);
				$usuario->setEmail($email);
				$usuario->setContrasenia($_POST['contrasenia']);

				$saved = $usuario->register();

				if($saved){
					$_SESSION['registro'] = "Registrado correctamente. Ya puede iniciar sesión.";
				}else{
					$_SESSION['registro'] = "Error inesperado. Inténtelo nuevamente";
				}
			}else{
				header('Location: '.base_url.'usuario/registro');
			}
		}else{
			$_SESSION['registro'] = "Debe rellenar los campos.";
		}

		header('Location: '.base_url.'usuario/registro');

	}

	private function validarDatos($nombre, $apellido, $email, $contra){

		$errores = array();

		if($nombre == null || preg_match('/[0-9]/', $nombre) || is_numeric($nombre)){
			$errores[] = "Nombre inválido";
		}

		if($apellido == null || preg_match('/[0-9]/', $apellido) || is_numeric($apellido)){
			$errores[] = "Apellido inválido";
		}

		if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || is_numeric($email)){
			$errores[] = "Correo inválido";
		}

		if($contra == null){
			$errores[] = "La contraseña no puede estar vacía.";
		}

		if(preg_match('/'.$nombre.'/i', $contra) || preg_match('/'.$apellido.'/i', $contra)){
			$errores[] = "La contraseña no puede parecerse al nombre.";	
		}

		if(count($errores) == 0){
			return true;
		}else{
			$_SESSION['datos_erroneos'] = $errores;
			return false;
		}
	}

	public function login(){

		if(isset($_POST)){
			if(empty($_POST['email']) || empty($_POST['contrasenia'])){
				header('Location: '.base_url);
			}else{

				$correo = $_POST['email'];
				$contra = $_POST['contrasenia'];

				$usuario = new Usuario();
				$usuario->setContrasenia($contra);
				$usuario->setEmail($correo);

				$usuario->entrar();
			}
		}else{
			header('Location: '.base_url);
		}
	}

	public function logout(){

		if(isset($_SESSION['usuario'])){
			session_destroy();
		}
		header('Location: '.base_url);

	}

}

?>