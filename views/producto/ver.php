<?php if($producto->num_rows == 1): ?>

<?php $producto = $producto->fetch_object(); ?>

	<div id="detail_product">
		<h2><?=$producto->nombre ?></h2>
		<img src="<?=base_url ?>assets/product_images/<?=$producto->imagen ?>" class="image">		
		<div class="data">
			<p><strong>Categoría: </strong> <?=$producto->nombre_categoria ?></p>
			<p class="description"><strong>Descripción: </strong><?=$producto->descripcion ?></p>
			<a href="<?=base_url ?>carrito/add&id=<?=$producto->id ?>" class="button price">Comprar</a>
		</div>
	</div>

<?php else: ?>

	<h3><strong>Error. </strong>No se pudo encontrar ese producto.</h3>
	<?php header('Refresh: 5;url='.base_url); ?>

<?php endif; ?>