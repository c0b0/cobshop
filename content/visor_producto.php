<?php
/**
 * visor_producto.php
 *
 * pagina para mostrar un producto en concreto en la zona de administracion
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>
<?php 
$id = $_GET['id_producto'];
$producto= Producto::getProductoPorId($id);
?>


<?php if (estaLogueado() && esAdmin()): ?>
<ul id="user-tools">
	<li><a class="btn-edit" href="index.php?content=mant_productos&id_producto=<?php echo $producto->getId_producto(); ?>"><img src="images/iconos/edit-small.png" title="Editar producto"></a></li>
	<li><a class="btn-delete" href="index.php?content=visor_producto&id_producto=<?php echo $producto->getId_producto();?>&action=borrar"><img src="images/iconos/delete-small.png" title="Borrar producto"></a></li>
</ul>

<?php if (isset($_GET['action']) && $_GET['action'] == 'borrar') : ?>
<p class="mensaje">Va a borrar este registro, está seguro?</p>
<a class="btn" href="index.php?content=visor_producto&id_producto=<?php echo $producto->getId_producto(); ?>">No</a>
<a class="btn" href="index.php?content=borrar&tabla=productos&id=<?php echo $producto->getId_producto(); ?>">Sí</a>
<?php endif; ?>
<div id="perfil">
	<table class="datos">
		<tr>
			<td>Id del Producto:</td><td><?php echo str_pad( $producto->getId_producto(), 5, '0' , STR_PAD_LEFT); ?></td>
		<tr>
		<tr>
			<td>Nombre:</td><td><?php echo $producto->getProducto(); ?></td>
		<tr>
		<tr>
			<td>Características:</td><td><?php echo $producto->getCaracteristicas(); ?></td>
		<tr>
		<tr>
			<td>Precio:</td><td><?php echo $producto->getPrecio(); ?></td>
		<tr>
		<tr>
			<td>Stock:</td><td><?php echo $producto->getStock(); ?></td>
		<tr>

		<tr>
			<td>Categoría</td><td><?php echo $producto->getCategoria();?></td>
		<tr>
		<tr>
			<td>Descuento</td><td><?php echo $producto->getDescuento();?></td>
		<tr>
		<tr>
			<td>Url-Foto</td><td><?php echo $producto->getFoto(); ?></td>
		<tr>
		<tr>
			<td colspan="2">Imagen:</td>
		</tr>		
		<tr>
			<td colspan="2"><img class="noShadow" alt="" src="images/productos/<?php echo $producto->getFoto(); ?>"></td>
		</tr>		
	</table>
	
</div>
<?php else :?>
<?php header("location: index.php?content=login"); ?>
<?php endif; ?>




