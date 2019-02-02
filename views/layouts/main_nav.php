<?php
 
 require_once('models/Categoria.php'); 

 $categorias = new Categoria();
 $resultado = $categorias->getAll();

 ?>

<nav id="mainNav">
	<ul>
		<li><a href="<?=base_url ?>">Inicio</a></li>
		<?php while($categoria = $resultado->fetch_object()): ?>
			<li><a href="<?=base_url ?>categoria/ver&id=<?=$categoria->id ?>"><?=$categoria->nombre ?></a></li>
		<?php endwhile; ?>
		<li><a href="">Carrito (6)</a></li>
	</ul>
</nav>