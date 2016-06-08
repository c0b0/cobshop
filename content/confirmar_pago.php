<?php 

/*
 * Pequeña trampa por aquí
 * por seguridad no debería pillar estas variables que he 
 * enviado a través de atributos "hidden". 
 * Sería mejor opción enviarlos a una tabla temporal y recuperarlos de ahí
 * En cualquier caso, de cara a la entrega del proyecto, así funciona bien 
 */
$comprador = Usuario::getUsuarioPorId($_SESSION['id_usuario']);
$producto = Producto::getProductoPorId($_POST['id_producto']);
$unidades = $_POST['unidades'];
$precioFinal = $_POST['precioFinal'];
?>

<html>

<head>
	<?php 
	/*
	 * Este script, envía el formulario automáticamente al cargar la página, como si 
	 * al cargarse, se aprete el botón submit
	 * Decidir hacerlo así, y poner un mensaje de "Redireccionando..."
	 */
	
	?>
    <script>
	  window.onload=function(){
		// Una vez cargada la página, el formulario se enviara automáticamente.
		document.forms["botonPapypal"].submit();
	   }
    </script>
</head>
<body>
<ul id="user-tools">
	<li><a class="btn-back" href="index.php?content=cart&id_usuario=<?php echo $_SESSION['id_usuario']; ?>"><img	src="images/iconos/back.png" title="Volver atrás"></a></li>
</ul>

<h2>Redireccionando, espera por favor...</h2>

<table id="pr_pago">
	<tr id="direccion"><td colspan="6"><?php echo ucwords($comprador->getDireccion()) .'<br / >'. $comprador->getCiudad() . '<br />' . $comprador->getCodigo_postal() . '<br />' . $comprador->getProvincia(); ?></td></tr>
	<tr id="datosProducto"><td id="udsp"><?php echo $_POST['unidades']?></td><td id="udsxp">x</td><td><?php echo $producto->getProducto(); ?></td><td><?php echo $producto->getPrecio().'€'; ?></td><td id="tpc"><?php echo '-' . $producto->getDescuento() . '%'; ?></td>
	<td id="pfinal"><?php echo $producto->getDescuento()? CalculaDescuento($producto->getPrecio(), $producto->getDescuento()) .'€' : $producto->getPrecio() . "€";  ?></td></tr>
	<tr><td></td><td></td><td></td><td></td><td>Total:</td><td id="pfinal"><?php echo $precioFinal .'€'; ?></td></tr>
	<tr><td></td><td></td><td></td><td></td><td colspan="2">


<?php 
/*
 * Este botón redirecciona a la página de pago de PayPal. La única info que aporto aquí
 * es el dinero a pagar con $precioFinal
 */
?>	
<form id="botonPapypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_xclick"> 
			<input type="hidden" name="business" value="coblion-facilitator@gmail.com">
			<input type="hidden" name="item_name" value="Compra CobShop">
			<input type="hidden" name="currency_code" value="EUR"> 
			<input type="hidden" name="amount" value="<?php echo $precioFinal?>"> 
			<input type="image" src="http://www.paypal.com/es_XC/i/btn/x-click-but01.gif" name="submit"	alt="Make payments with PayPal - it's fast, free and secure!">
</form>	
	</td><td></td></tr>
</table>



</body>






</html>


