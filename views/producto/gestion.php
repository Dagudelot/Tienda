<h1>Gestión de productos</h1>

<a href="<?=base_url?>producto/agregar" class="button button-small">Agregar producto</a>

<?php if($productos->num_rows > 0): ?>

<h1>Productos</h1>

<?php if(isset($_SESSION['exito'])): ?>

	<strong class="exito"><?=$_SESSION['exito'] ?></strong>
		
<?php endif; ?>

<?php if(isset($_SESSION['error'])): ?>

	<strong class="error"><?=$_SESSION['error'] ?></strong>
		
<?php endif; ?>


<table border="1px">
	<tr>
		<th>ID:</th>
		<th>Nombre:</th>
		<th>Precio: </th>
		<th>Stock: </th>
		<th>Acciones: </th>
	</tr>
	<?php while($resultado = $productos->fetch_object()): ?>

	<tr>
		<td><?=$resultado->id ?></td>
		<td><?=$resultado->nombre ?></td>
		<td><?=$resultado->precio ?></td>
		<td><?=$resultado->stock ?></td>
		<td>
			<a href="<?=base_url ?>producto/editar&id=<?=$resultado->id ?>" class="button">Editar</a>
			<a href="<?=base_url ?>producto/eliminar&id=<?=$resultado->id ?>" class="button button-red">Eliminar</a>
		</td>
	</tr>

	<?php endwhile; ?>
</table>

<?php else: ?>

<h1>No hay productos dispobibles</h1>

<?php endif; ?>

<?php Utils::eliminarSesion('exito'); ?>
<?php Utils::eliminarSesion('error'); ?>