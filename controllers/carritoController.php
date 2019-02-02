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

			$_SESSION['total_pedido'] = 0;
			$_SESSION['cantidad_pedido'] = 0;

			for ($i=0; $i < count($_SESSION['carrito']); $i++) { 
				$_SESSION['total_pedido'] += (($_SESSION['carrito'][$i]['producto']['precio'])*($_SESSION['carrito'][$i]['cantidad']));
				$_SESSION['cantidad_pedido']++;
			}

			header('Location: '.base_url.'carrito/add');

		}else{

			if(count($_SESSION['carrito']) > 0){

				require_once('views/carrito/ver.php');

			}else{
				header('Location: '.base_url);
			}

		}		

	}

	public function deleteItem(){

	}

	public function deleteCar(){
		unset($_SESSION['carrito']);
		unset($_SESSION['total_pedido']);
		unset($_SESSION['cantidad_pedido']);
		header('Location: '.base_url);
	}


}

?>