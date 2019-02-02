<?php 

require_once('models/Producto.php');

class carritoController{

	public function index(){
		echo "CarritoController created and workiiiing!";
	}

	public function add(){

		if (isset($_GET['id'])) {
			
			$producto_id = $_GET['id'];

			$producto = new Producto();
			$producto->setId($producto_id);
			$producto = $producto->buscarProducto();
			
			if(is_object($producto)){
				$producto = $producto->fetch_assoc();
			}else {
				header('Location: '.base_url);
			}


			if(!isset($_SESSION['carrito'])){

				$_SESSION['carrito'] = array();

				$_SESSION['carrito'][] = array(
					'cantidad' => 1,
					'producto' => $producto
				);


			}else{	

				$exists = false;

				for ($i=0; $i < count($_SESSION['carrito']); $i++) { 
					if($_SESSION['carrito'][$i]['producto']['id'] == $producto_id){
						$_SESSION['carrito'][$i]['cantidad']++;
						$exists = true;
					}
				}

				if($exists == false){
					$_SESSION['carrito'][] = array(
						'cantidad' => 1,
						'producto' => $producto
					);	
				}

			}	

			//$_SESSION['carrito'] = $this->productos;



			 var_dump($_SESSION['carrito']);

		}else{

			header('Location: '.base_url);

		}		

	}

	public function deleteItem(){

	}

	public function deleteCar(){
		unset($_SESSION['carrito']);
	}


}

?>