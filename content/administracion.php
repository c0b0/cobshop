<?php 
/**
 * administracion.php
 *
 * pagina para el menu de administración
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>

<?php if (estaLogueado() && esAdmin()): ?>
<table id="menu-admin">
	<tr>
		<td><a href="index.php?content=usuarios"><img
				src="images/iconos/user.png" title="usuarios" /></a></td>
		<td><a href="index.php?content=productos"><img
				src="images/iconos/product.png" title="productos" /></a></td>
	</tr>
	<tr>
		<td><a href="index.php?content=categorias"><img
				src="images/iconos/categoria.png" title="categorias" /></a></td>
		<td><a href="index.php?content=ventas"><img
				src="images/iconos/ventas.png" title="ventas" /></a></td>
	</tr>

</table>
<?php else:?>
<?php header("location: index.php?content=login")?>
<?php endif; ?>

