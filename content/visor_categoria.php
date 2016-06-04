<?php
/**
 * visor_categoria.php
 *
 * pagina para mostrar una categoria en concreto en la zona de administracion
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>
<?php 
$id = $_GET['id_categoria'];
$categoria = Categoria::getCategoriaPorId($id);
?>

<?php if (estaLogueado() && esAdmin()): ?>
<ul id="user-tools">
	<li><a class="btn-edit" href="index.php?content=mant_categorias&id_categoria=<?php echo $categoria->getId_categoria(); ?>"><img src="images/iconos/edit-small.png" title="Editar categoria"></a></li>
	<li><a class="btn-delete" href="index.php?content=visor_categoria&id_categoria=<?php echo $categoria->getId_categoria();?>&action=borrar"><img src="images/iconos/delete-small.png" title="Borrar categoria"></a></li>
</ul>

<?php if (isset($_GET['action']) && $_GET['action'] == 'borrar') : ?>
<p class="mensaje">Va a borrar este registro, está seguro?</p>
<a class="btn" href="index.php?content=visor_categoria&id_categoria=<?php echo $categoria->getId_categoria(); ?>">No</a>
<a class="btn" href="index.php?content=borrar&tabla=categorias&id=<?php echo $categoria->getId_categoria(); ?>">Sí</a>
<?php endif; ?>

<div id="perfil">
	<table class="datos">
		<tr>
			<td>Id de la categoría</td><td><?php echo $categoria->getId_categoria(); ?></td>
		<tr>
		<tr>
			<td>Nombre de la categoría:</td><td><?php echo $categoria->getCategoria(); ?></td>
		<tr>
	</table>
</div>
<?php else: ?>
<?php header("location: index.php?content=login"); ?>
<?php endif; ?>





