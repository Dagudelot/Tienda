<h2>Edición: </h2>

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

<?php $product = $prod->fetch_object(); ?>

<p>Edita tu producto.</p>

<form action="<?=base_url?>producto/actualizarProducto" method="POST" enctype="multipart/form-data">
	<label for="categoria">Categoria</label>

	<input type="hidden" name="producto_id" value="<?=$product->id?>">

	<select name="categoria_id">
	<?php while($categoria = $categorias->fetch_object()): ?>
		<option value="<?=$categoria->id ?>" <?php if($categoria->id == $product->categoria_id){echo "selected";} ?>><?=$categoria->nombre ?></option>
	<?php endwhile; ?>
	</select>

	<label for="titulo">Nombre del producto: </label>
	<input type="text" name="titulo" value="<?=$product->nombre?>">

	<label for="descripcion">Descripción del producto: </label>
	<textarea name="descripcion" cols="30" rows="10"><?=$product->descripcion?></textarea>

	<label for="precio">Precio: </label>
	<input type="number" min="0.01" step="0.01" name="precio" value="<?=$product->precio?>">

	<label for="oferta">Oferta</label>
	<select name="oferta">
		<option value="null">Seleccionar</option>
		<option value="true" <?php if($product->oferta == 1){echo "selected";} ?>>Sí</option>
		<option value="false" <?php if($product->oferta == 0){echo "selected";} ?>>No</option>
	</select>

	<label for="stock">Stock del producto: </label>
	<input type="number" name="stock" step="1" value="<?=$product->stock?>">

	<label for="imagen">Imagen del producto: </label>
	<img src="<?=base_url?>assets/product_images/<?=$product->imagen ?>" style="width: 200px;">
	<input type="file" name="imagen">

	<input type="submit" value="Actualizar producto">
</form>

<?php Utils::eliminarSesion('errores'); ?>
<?php Utils::eliminarSesion('error'); ?>