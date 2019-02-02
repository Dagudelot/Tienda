<?php 

require_once('models/Categoria.php');
require_once('models/Producto.php');


class productoController{

	public function index(){
		$producto = new Producto();
		$productos = $producto->getRandom(6);

		require_once('views/producto/destacados.php');
	}

	public function gestionar(){
		Utils::isAdmin();

		$producto = new Producto();
		$productos = $producto->getAll();

		require_once('views/producto/gestion.php');
	}

	public function agregar(){
		Utils::isAdmin();

		$categoria = new Categoria();
		$categorias = $categoria->getAll();

		require_once('views/producto/agregarProducto.php');
	}

	public function save(){

		if(isset($_POST)){

			$nombre_producto = isset($_POST['titulo']) ? $_POST['titulo'] : null;
			$categoria_id = isset($_POST['categoria_id']) ? $_POST['categoria_id'] : null;
			$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
			$precio = isset($_POST['precio']) ? $_POST['precio'] : null;
			$oferta = !$_POST['oferta'] == null ? $_POST['oferta'] : false;
			//Datos de la imagen
			$imagen = isset($_FILES['imagen']) ? $_FILES['imagen'] : null;		
			$nombre_imagen = $imagen['name'];
			$mimetype = $imagen['type'];
			$ubicacion_imagen = $imagen['tmp_name'];

			//Validamos que sea una imagen y no otro tipo de archivo
			if($mimetype == 'image/jpeg' || $mimetype == 'image/jpg' || $mimetype == 'image/png'){

				if(!is_dir('assets/product_images')){
					mkdir('assets/product_images', 0777, true);
				}

				move_uploaded_file($ubicacion_imagen, 'assets/product_images/'.$nombre_imagen);

			}else{
				$_SESSION['error'] = "El archivo que adjuntó NO es una imagen. Por favor inténtelo de nuevo.";
				header('Location '.base_url.'producto/agregar');
			}

			$stock = isset($_POST['stock']) ? $_POST['stock'] : null;

			$validacion = $this->validarDatos($nombre_producto, $descripcion, $precio, $stock, $imagen);

			if($validacion){
				$producto = new Producto();
				$producto->setCategoriaId($categoria_id);
				$producto->setNombre($nombre_producto);
				$producto->setDescripcion($descripcion);
				$producto->setPrecio($precio);
				$producto->setOferta($oferta);
				$producto->setImagen($imagen);
				$producto->setStock($stock);

				$producto_guardado = $producto->save();

				if($producto_guardado){			
		
					$_SESSION['exito'] = "El producto ha sido agregado correctamente.";
					header('Location: '.base_url.'producto/gestionar');

				}else{
					$_SESSION['error'] = "Ha ocurrido un error inesperado. Inténtelo de nuevo.";
					header('Location: '.base_url.'producto/agregar');
				}

			}else{
				header('Location: '.base_url.'producto/agregar');
			}

		}else{
			$_SESSION['errores'] = "Por favor, rellene todos los campos.";
			header('Location: '.base_url.'producto/agregar');
		}	

	}

	private function validarDatos($nombre, $descripcion, $precio, $stock, $imagen='default.jpg'){

		$errores = array();

		if($nombre == null || is_numeric($nombre)){
			$errores[] = "El nombre del producto no puede estar vacío y no puede ser numérico";
		}

		if($descripcion == null || is_numeric($descripcion)){
			$errores[] = "La descripcion del producto no puede estar vacía y no puede ser numérico";
		}

		if($precio == null || !is_numeric($precio) || $precio == 0){
			$errores[] = "El precio del producto no puede ser cero y debe ser numérico";
		}

		if($stock == null || !is_numeric($stock)){
			$errores[] = "El stock del producto no puede estar vacío y debe ser numérico";
		}

		if($imagen == null){
			$errores[] = "Debe adjuntar una imagen para el producto.";
		}

		if(count($errores) > 0){
			$_SESSION['errores'] = $errores;
			return false;
		}else{
			return true;
		}

	}

	public function editar(){
		if(isset($_GET['id'])){

			Utils::isAdmin();

			$categoria = new Categoria();
			$categorias = $categoria->getAll();

			$producto_id = $_GET['id'];

			$producto = new Producto();
			$producto->setId($producto_id);
			$prod = $producto->buscarProducto();


			require_once('views/producto/editar.php');
		}
	}

	public function eliminar(){
		if(isset($_GET['id'])){
			 $producto_id = $_GET['id'];

			$producto = new Producto();
			$producto->setId($producto_id);

			$resultado = $producto->eliminar();

			if($resultado){
				$_SESSION['exito'] = "El producto ha sido eliminado correctamente.";				
			}else{
				$_SESSION['error'] = "No pudo eliminarse el producto debido un error desconocido. Inténtelo de nuevo más tarde.";
			}

			header('Location: '.base_url.'producto/gestionar');

		}else{
			header('Location: '.base_url);
		}
	}

	public function actualizarProducto(){
		if(isset($_POST)){

			$id_producto = $_POST['producto_id'];
			$nombre_producto = isset($_POST['titulo']) ? $_POST['titulo'] : null;
			$categoria_id = isset($_POST['categoria_id']) ? $_POST['categoria_id'] : null;
			$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
			$precio = isset($_POST['precio']) ? $_POST['precio'] : null;
			$oferta = $_POST['oferta'] != null ? $_POST['oferta'] : false;
			$stock = isset($_POST['stock']) ? $_POST['stock'] : null;

			$validacion = $this->validarDatos($nombre_producto, $descripcion, $precio, $stock);

			if($validacion){
				$producto = new Producto();
				$producto->setId($id_producto);
				$producto->setCategoriaId($categoria_id);
				$producto->setNombre($nombre_producto);
				$producto->setDescripcion($descripcion);
				$producto->setPrecio($precio);
				$producto->setOferta($oferta);

				if(isset($_FILES['imagen'])){
					//Datos de la imagen
					$imagen = isset($_FILES['imagen']) ? $_FILES['imagen'] : null;		
					$mimetype = $imagen['type'];

					//Validamos que sea una imagen y no otro tipo de archivo
					if($mimetype == 'image/jpeg' || $mimetype == 'image/jpg' || $mimetype == 'image/png'){

						$nombre_imagen = $imagen['name'];
						$ubicacion_imagen = $imagen['tmp_name'];

						if(!is_dir('assets/product_images')){
							mkdir('assets/product_images', 0777, true);
						}

						move_uploaded_file($ubicacion_imagen, 'assets/product_images/'.$nombre_imagen);
						$producto->setImagen($nombre_imagen);

					}

				}
				
				$producto->setStock($stock);

				$producto_guardado = $producto->update();

				if($producto_guardado){			
		
					$_SESSION['exito'] = "El producto ha sido actualizado correctamente.";
					header('Location: '.base_url.'producto/gestionar');

				}else{
					$_SESSION['error'] = "Ha ocurrido un error inesperado. Inténtelo de nuevo.";
					header('Location: '.base_url.'producto/editar');
				}

			}else{
				header('Location: '.base_url.'producto/editar&id='.$id_producto);
			}

		}else{
			$_SESSION['errores'] = "Por favor, rellene todos los campos.";
			header('Location: '.base_url.'producto/editar');
		}
	}

	public function ver(){
		if(isset($_GET['id'])){
			$producto_id = $_GET['id'];
			$producto = new Producto();
			$producto = $producto->getOne($producto_id);

			require_once('views/producto/ver.php');
		}else{
			header('Refresh: 5; url='.base_url);
		}
	}

}

?>