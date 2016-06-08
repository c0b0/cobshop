<?php 
/**
 * categorias.php
 *
 * pagina para mostrar el grid de  categorias
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>

<?php 
$items =Categoria::getCategorias();
?>
<?php if (estaLogueado() && esAdmin()): ?>
<ul id="user-tools">
	<li><a class="btn-back" href="index.php?content=administracion"><img	src="images/iconos/back.png" title="Volver atrás"></a></li>
	<li><a class="btn-add" href="index.php?content=mant_categorias"><img	src="images/iconos/add-small.png" title="Añadir categoría"></a></li>
</ul>

<table id="grid">
	<thead>
		<tr>
			<th>Id</th>
			<th>Categoría</th>
			<th>Ver</th>
			<th>Edit</th>
			<th>Del</th>
		</tr>
	</thead>
	<tfoot>
	</tfoot>
	<tbody>
		<?php foreach ($items as $i=>$item): ?>
			<tr class="row<?php echo $i % 2 ;?>">
			<td><?php  echo $item->getId_categoria(); ?></td>
			<td><?php echo $item->getCategoria(); ?></td>
			<td><a href="index.php?content=visor_categoria&id_categoria=<?php echo $item->getId_categoria(); ?>"><img class="noShadow" title="Ver Categoria" src="images/iconos/ver.png" /></a></td>
			<td><a href="index.php?content=mant_categorias&id_categoria=<?php echo $item->getId_categoria(); ?>"><img class="noShadow" title="Editar Categoria" src="images/iconos/edit-xxsmall.png" /></a></td>
			<td><a href="index.php?content=visor_categoria&id_categoria=<?php echo $item->getId_categoria();?>&action=borrar"><img  class="noShadow" alt="borrar" title="Borrar categoria" src="images/iconos/borrar-xxsmall.png"></a></td>
		</tr>
		
		<?php endforeach;?>
	
</table>



<!-- Fin de Paginacion-->
<?php else: ?>
<?php header("location: index.php?content=login"); ?>
<?php endif;?>

