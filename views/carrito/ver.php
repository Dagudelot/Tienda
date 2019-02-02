<h1>Carrito de la compra</h1>

<table>
	<tr>
		<th>Imagen</th>
		<th>Producto</th>
		<th>Precio</th>
		<th>Cantidad</th>
		<th>Total / producto</th>
	</tr>

	<?php for ($i=0; $i < count($_SESSION['carrito']); $i++): ?>
		<tr>
			<td><a href="<?=base_url ?>producto/ver&id=<?=$_SESSION['carrito'][$i]['producto']['id'] ?>" style="text-decoration: none;"><img src="<?=base_url ?>assets/product_images/<?=$_SESSION['carrito'][$i]['producto']['imagen'] ?>" style="width: 100px; margin: 20px auto;"></a></td>
			<td><a href="<?=base_url ?>producto/ver&id=<?=$_SESSION['carrito'][$i]['producto']['id'] ?>" style="text-decoration: none;"><?=$_SESSION['carrito'][$i]['producto']['nombre'] ?></a></td>
			<td><?=$_SESSION['carrito'][$i]['producto']['precio'] ?></td>
			<td><?=$_SESSION['carrito'][$i]['cantidad']?></td>
			<td><?=(($_SESSION['carrito'][$i]['producto']['precio'])*($_SESSION['carrito'][$i]['cantidad'])) ?></td>
		</tr>
	<?php endfor; ?>

</table>