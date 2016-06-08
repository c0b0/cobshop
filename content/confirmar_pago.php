<?php 

/*
 * Peque�a trampa por aqu�
 * por seguridad no deber�a pillar estas variables que he 
 * enviado a trav�s de atributos "hidden". 
 * Ser�a mejor opci�n enviarlos a una tabla temporal y recuperarlos de ah�
 * En cualquier caso, de cara a la entrega del proyecto, as� funciona bien 
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
	 * Este script, env�a el formulario autom�ticamente al cargar la p�gina, como si 
	 * al cargarse, se aprete el bot�n submit
	 * Decidir hacerlo as�, y poner un mensaje de "Redireccionando..."
	 */
	
	?>
    <script>
	  window.onload=function(){
		// Una vez cargada la p�gina, el formulario se enviara autom�ticamente.
		document.forms["botonPapypal"].submit();
	   }
    </script>
</head>
<body>
<ul id="user-tools">
	<li><a class="btn-back" href="index.php?content=cart&id_usuario=<?php echo $_SESSION['id_usuario']; ?>"><img	src="images/iconos/back.png" title="Volver atr�s"></a></li>
</ul>

<h2>Redireccionando, espera por favor...</h2>

<table id="pr_pago">
	<tr id="direccion"><td colspan="6"><?php echo ucwords($comprador->getDireccion()) .'<br / >'. $comprador->getCiudad() . '<br />' . $comprador->getCodigo_postal() . '<br />' . $comprador->getProvincia(); ?></td></tr>
	<tr id="datosProducto"><td id="udsp"><?php echo $_POST['unidades']?></td><td id="udsxp">x</td><td><?php echo $producto->getProducto(); ?></td><td><?php echo $producto->getPrecio().'�'; ?></td><td id="tpc"><?php echo '-' . $producto->getDescuento() . '%'; ?></td>
	<td id="pfinal"><?php echo $producto->getDescuento()? CalculaDescuento($producto->getPrecio(), $producto->getDescuento()) .'�' : $producto->getPrecio() . "�";  ?></td></tr>
	<tr><td></td><td></td><td></td><td></td><td>Total:</td><td id="pfinal"><?php echo $precioFinal .'�'; ?></td></tr>
	<tr><td></td><td></td><td></td><td></td><td colspan="2">


<?php 
/*
 * Este bot�n redirecciona a la p�gina de pago de PayPal. La �nica info que aporto aqu�
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


