<?php 
/**
 * menu_nav.php
 *
 * menu lateral
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>


<?php 
$categorias = Categoria::getCategorias()
?>


<ul id="menu">
	<?php if (estaLogueado() && esAdmin()): ?>
	<li><a href="index.php?content=administracion">Administración</a></li>
	<?php endif; ?>
	<li><a href="index.php?content=home">Inicio</a></li>
	<?php foreach($categorias as $categoria):?>
	<li><a href="index.php?content=productos_por_categoria&categoria=<?php echo $categoria->getCategoria(); ?>"><?php echo ucwords($categoria->getCategoria());?></a></li>
	<?php endforeach;?>


</ul>