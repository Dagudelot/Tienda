<h1>Nueva Categoría</h1>

<p>Crea una nueva categoria para tus usuarios</p>

<?php if(isset($_SESSION['error'])): ?>

	<strong class="error"><?=$_SESSION['error'] ?></strong>
		
<?php endif; ?>

<form action="<?=base_url?>categoria/save" method="POST">
	<label for="nombre">Nombre de la categoría: </label>
	<input type="text" name="nombre">

	<input type="submit" value="Crear categoría">
</form>

<?php Utils::eliminarSesion('error'); ?>