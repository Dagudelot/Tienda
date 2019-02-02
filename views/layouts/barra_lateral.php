<aside id="barra_lateral">

	<h3>Carrito de compra</h3>

	<ul>
		<li>Productos (<?= isset($_SESSION['cantidad_pedido']) ? $_SESSION['cantidad_pedido'] : 0; ?>)</li>
		<li>Total: $<?= isset($_SESSION['total_pedido']) ? $_SESSION['total_pedido']: 0; ?></li>
	</ul>

	<?php if(!isset($_SESSION['usuario'])): ?>

		<h3>Inicia sesión</h3>

		<?php if(isset($_SESSION['error'])): ?>

			<strong class="error"><?=$_SESSION['error'] ?></strong>
		
		<?php endif; ?>

		<form action="<?=base_url ?>usuario/login" method="POST">

			<label for="email">Correo electrónico: </label>
			<input type="text" name="email" placeholder="Correo">

			<label for="contrasenia">Contraseña: </label>
			<input type="password" name="contrasenia" placeholder="Contraseña">

			<input type="submit" class="button" value="Entrar">

			<a href="<?=base_url ?>usuario/registro" class="button button-blue">Regístrate aquí</a>

		</form>

	<?php else: ?>
		
		<h3><?=$_SESSION['usuario']->nombre.' '.$_SESSION['usuario']->apellido ?></h3>

	<ul>
		<li><a href="">Mis pedidos</a></li>
		<?php if($_SESSION['usuario']->rol == 'admin'): ?>
			<li><a href="<?=base_url ?>categoria/index">Gestionar categorías</a></li>
			<li><a href="<?=base_url ?>producto/gestionar">Gestionar productos</a></li>
		<?php endif; ?>
		<li><a href="<?=base_url ?>usuario/logout">Salir</a></li>
	</ul>

	<?php endif; ?>

</aside>

<?php Utils::eliminarSesion('error'); ?>

<div id="contenido">