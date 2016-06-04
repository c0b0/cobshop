<?php 
/**
 * mant_usuarios.php
 *
 * página en la que se muestra el producto que se va a comprar
 * con un botón para comprar
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>


<?php 
$comprador = Usuario::getUsuarioPorId($_SESSION['id_usuario']);
$producto = Producto::getProductoPorId($_POST['id_producto']);
$unidades = $_POST['unidades'];

?>

<ul id="user-tools">
	<li><a class="btn-back" href="index.php?content=cart&id_usuario=<?php echo $_SESSION['id_usuario']; ?>"><img	src="images/iconos/back.png" title="Volver atrás"></a></li>
</ul>

<?php $_SESSION['misMensajes'] = 'Proceso de pago 1/2';?>



<?php 
if ($producto->getDescuento()){
	$precioFinal = CalculaDescuento($producto->getPrecio(), $producto->getDescuento()) * $_POST['unidades'];
}else{
	$precioFinal = $producto->getPrecio() * $_POST['unidades'];
}

?>

<table id="pr_pago">
	<tr id="direccion"><td colspan="6"><?php echo ucwords($comprador->getDireccion()) .'<br / >'. $comprador->getCiudad() . '<br />' . $comprador->getCodigo_postal() . '<br />' . $comprador->getProvincia(); ?></td></tr>
	<tr id="datosProducto"><td id="udsp"><?php echo $_POST['unidades']?></td><td id="udsxp">x</td><td><?php echo $producto->getProducto(); ?></td><td><?php echo $producto->getPrecio().'€'; ?></td><td id="tpc"><?php echo '-' . $producto->getDescuento() . '%'; ?></td>
	<td id="pfinal"><?php echo $producto->getDescuento()? CalculaDescuento($producto->getPrecio(), $producto->getDescuento()) .'€' : $producto->getPrecio() . "€";  ?></td></tr>
	<tr><td></td><td></td><td></td><td></td><td>Total:</td><td id="pfinal"><?php echo $precioFinal .'€'; ?></td></tr>
	<tr><td></td><td></td><td></td><td></td><td></td><td>
		<form  method="post" action="index.php?content=confirmar_pago" >
			<input class="confirmar" type="submit" value="Confirmar pago">
			<input type="hidden" name="id_producto" value="<?php echo $_POST['id_producto']; ?>"/>
			<input type="hidden" name="precioFinal" value="<?php echo $precioFinal; ?>"/>
			<input type="hidden" name="unidades" value="<?php echo $unidades; ?>"/>
			<input type="hidden" name="task" value="realiza.compra" />
			<input type="hidden" name="cpago" value="ok"/>
		</form></td>
</table>


	



<?php 
/**
 * lo que creo que voy a hacer es:
 * poner un botón o un link a una página que se llame confirmar pago
 * En ese momento borraré el producto del carrito, y lo pasaré a compras
 * 
 * Los datos que necesito para pasar un producto del carrito a la compra son:
 * id_usuario -> lo tengo en session
 * las unidades
 * y el coste total
 * 
 */

?>
