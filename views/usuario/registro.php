<h3>Regístrate</h3>


<?php if(isset($_SESSION['registro'])): ?>
	<strong class="exito"><?=$_SESSION['registro']  ?></strong>
<?php endif; ?>

<?php 

if(isset($_SESSION['datos_erroneos'])){

	if(count($_SESSION['datos_erroneos'])>1){
		for ($i=0; $i < count($_SESSION['datos_erroneos']); $i++) { 
			echo '<strong class="error">'.$_SESSION['datos_erroneos'][$i].'</strong><br>';
		}
	}else{
		echo '<strong class="error">'.$_SESSION['datos_erroneos'][0].'</strong><br>';
	}
}

?>

	

<form action="<?=base_url ?>usuario/save" method="POST">
	
	<label for="nombre">Nombre: </label>
	<input type="text" name="nombre" >

	<label for="apelido">Apelido: </label>
	<input type="text" name="apellido">

	<label for="email">Correo electrónico: </label>
	<input type="email" name="email" >

	<label for="contrasenia">Contraseña: </label>
	<input type="password" name="contrasenia" >

	<input type="submit" value="Regístrate">

</form>

<?php 
Utils::eliminarSesion('registro'); 
Utils::eliminarSesion('datos_erroneos');
?>