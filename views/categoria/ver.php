
<h3><?=$categoria->nombre ?></h3>

<?php if($productos->num_rows > 0): ?>

	<?php while($producto = $productos->fetch_object()): ?>
		<div class="product">
			<a href="<?=base_url ?>producto/ver&id=<?=$producto->id ?>"><img src="<?=base_url ?>assets/product_images/<?=$producto->imagen ?>"></a>
			<a href="<?=base_url ?>producto/ver&id=<?=$producto->id ?>"><h2><?=$producto->nombre ?></h2></a>
			<p><?=$producto->precio ?></p>
			<a href="<?=base_url ?>carrito/add&id=<?=$producto->id ?>" class="button">Comprar</a>
		</div>
	<?php endwhile; ?>

<?php else: ?>

	<h3>No hay productos de ésta categoría.</h3>
	<?php header('Refresh: 5; url='.base_url); ?>

<?php endif; ?>
