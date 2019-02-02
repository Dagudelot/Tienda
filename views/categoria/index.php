<a href="<?=base_url?>categoria/crear" class="button button-small">Crear categoría</a>

<?php if($resultados->num_rows > 0): ?>

<h1>Categorias</h1>

<?php if(isset($_SESSION['exito'])): ?>

	<strong class="exito"><?=$_SESSION['exito'] ?></strong>
		
<?php endif; ?>

<table border="1px">
	<tr>
		<th>ID:</th>
		<th>Nombre:</th>
	</tr>
	<?php while($resultado = $resultados->fetch_object()): ?>

	<tr>
		<td><?=$resultado->id ?></td>
		<td><?=$resultado->nombre ?></td>
	</tr>

	<?php endwhile; ?>
</table>

<?php else: ?>

<h1>No hay categorias</h1>

<?php endif; ?>

<?php Utils::eliminarSesion('exito'); ?>