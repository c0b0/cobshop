<?php 
/**
 * barra.php
 *
 * pagina para la barra superior
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>


<?php if (!estaLogueado()): ?>
<div id="login-reg-user">
	<a href="index.php?content=login">Log In</a>/<a
		href="index.php?content=mant_usuarios">Registrarse</a>
</div>
<div id="icono-carrito">
	<a href="index.php?content=login">0</a>
</div>
<?php else :?>
<div id="login-reg-user2">
	Bienvenido <a
		href="index.php?content=mant_usuarios&id_usuario=<?php echo $_SESSION['id_usuario']; ?>"><?php echo ucfirst(cortarNombre($_SESSION['user'])); ?></a>/<a
		href="index.php?content=salir">Salir</a>
</div>
<div id="icono-carrito">
	<?php if (isset($_POST['cpago'])){
		//este +1 es una pequeña trampa, para que no se vea que el artículo se borra antes de la redirección 
		//a PayPal
		$articulosEnCarrito = Carrito::articulosEnCarrito() + 1;
	}else{
		$articulosEnCarrito = Carrito::articulosEnCarrito();
	}
	
	?>
	<a
		href="index.php?content=cart&id_usuario=<?php echo $_SESSION['id_usuario']?>"><?php echo $articulosEnCarrito; ?></a>
</div>
<?php endif;?>