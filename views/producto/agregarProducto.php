<h1>Agrega un nuevo producto</h1>

<p>Agrega un nuevo producto para que tus clientes puedan comprarlo.</p>


<?php if(isset($_SESSION['errores'])): ?>

	<?php if(count($_SESSION['errores']) > 1): ?>
		
		<?php for ($i=0; $i < count($_SESSION['errores']); $i++): ?>

			<strong class="error"><?=$_SESSION['errores'][$i] ?></strong><br>

		<?php endfor; ?>

	<?php endif; ?>

<?php endif; ?>

<?php if(isset($_SESSION['error'])): ?>

	<strong class="error"><?=$_SESSION['error'] ?></strong><br>

<?php endif; ?>

<form action="<?=base_url?>producto/save" method="POST" enctype="multipart/form-data">
	<label for="categoria">Categoria</label>

	<select name="categoria_id">
	<?php while($categoria = $categorias->fetch_object()): ?>
		<option value="<?=$categoria->id ?>"><?=$categoria->nombre ?></option>
	<?php endwhile; ?>
	</select>

	<label for="titulo">Nombre del producto: </label>
	<input type="text" name="titulo">

	<label for="descripcion">Descripción del producto: </label>
	<textarea name="descripcion" cols="30" rows="10"></textarea>

	<label for="precio">Precio: </label>
	<input type="number" min="0.01" step="0.01" name="precio" placeholder="$">

	<label for="oferta">Oferta</label>
	<select name="oferta">
		<option value="null">Seleccionar</option>
		<option value="true">Sí</option>
		<option value="false">No</option>
	</select>

	<label for="stock">Stock del producto: </label>
	<input type="number" name="stock" step="1">

	<label for="imagen">Imagen del producto: </label>
	<input type="file" name="imagen">

	<input type="submit" value="Agregar producto">
</form>

<?php 

Utils::eliminarSesion('errores');
Utils::eliminarSesion('error');

?>