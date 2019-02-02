<?php 

require_once('models/Categoria.php');
require_once('models/Producto.php');

class categoriaController{

	public function index(){

		$categoria = new Categoria();
		$resultados = $categoria->getAll();

		require_once('views/categoria/index.php');

	}

	public function crear(){
		Utils::isAdmin();
		require_once('views/categoria/crearCategoria.php');
	}

	public function save(){
		if(isset($_POST) && !empty($_POST['nombre'])){

			$nombre_categoria = $_POST['nombre'];

			$categoria = new Categoria();
			$categoria->setNombre($nombre_categoria);

			$resultado = $categoria->save();

			if($resultado){
				$_SESSION['exito'] = "Categoría creada satisfactoriamente.";
				header('Location: '.base_url.'categoria/index');
			}else{
				$_SESSION['error'] = "Error inesperado. Inténtelo de nuevo.";
			}
		}else{
			$_SESSION['error'] = "Por favor, ingrese un nombre para la categoria.";
			header('Location: '.base_url.'categoria/crear');
		}
	}

	public function ver(){
		if (isset($_GET['id'])) {
			$categoria_id = $_GET['id'];
			$categoria = new Categoria();
			$categoria = $categoria->getCategoria($categoria_id);
			$categoria = $categoria->fetch_object();

			//Buscamos todos los productos de esa categoría
			$producto = new Producto();
			$productos = $producto->getByCategory($categoria->id);

			require_once('views/categoria/ver.php');

		} else {
			echo "<h1>La categoría que estás buscando no existe.</h1>";
			header('Refresh: 4; url='.base_url);
		}
		
	}

}

?>