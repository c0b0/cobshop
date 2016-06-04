<?php
/**
 * productos_por_categoria.php
 *
 * pagina para mostrar los productos para una categoria en particular
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>
<?php
/*
 * aquí declaro una serie de variablas que me van a servir en el proceso de paginación
 *
 * $registros por páginas indica el número de registros que quiero que se vean de una vez
 * intento que sea una cantidad razonable para que el usuario no deba hacer scroll en la página
 * de forma interminable
 *
 * $numero de registros indica la cantidad de filas que tengo en esa tabla, de modo que
 * dividiendo  por el número de registros que quiero por páginas (redondeando hacia arriba)
 * tendré el número de páginas en total
 */
$categoria = $_GET['categoria'];
$registrosPorPágina = 3;
$numeroRegistros = hallarNumeroRegistros ( "propag WHERE categoria = '$categoria' " );
$numeroPaginas = round ( $numeroRegistros / $registrosPorPágina );
//echo "el número de registros es:  $numeroRegistros <br />";
//echo "el número de paginas será: $numeroPaginas <br />";
?>
<?php
if (isset($_GET['pag'])){
	$pag = $_GET['pag'];
	$items = Producto::getProductos_por_categoriaParaPaginacion($_GET['categoria'], $pag);
}else{
	$pag = 1;
	$items = Producto::getProductos_por_categoriaParaPaginacion($_GET['categoria'], $pag);
}
?>
<?php 
/*-------------------------------------------------------------------------------*/
if ($pag + 1 > $numeroPaginas){
	$siguiente = 0;
}else{
	$siguiente = $pag +1 ;
}
if ($pag - 1 < 1){
	$anterior = 0; 
}else{
	$anterior = $pag - 1; 
}
?>

<?php 
//por si la categoría está vacía
if ($items): ?> 
<?php foreach ($items as $item): ?>
<?php if (Producto::hayStock($item->getId_producto())):?>
<div id="articulo-lista">
	<?php if ($item->getDescuento()): ?>
	<div class="art-offer-desc">-<?php echo $item->getDescuento() . '%'; ?></div>
	<div class="art-offer-price"><?php echo CalculaDescuento($item->getPrecio(),$item->getDescuento())?>€</div>
	<div class="art-offer"></div>
	<?php endif; ?>


	<!-- Articulo lista -->
	<div id="art-lista-precio">
		<strong><?php echo $item->getPrecio() . " &euro;" ; ?></strong>
	</div>
	<img src="images/productos/<?php echo $item->getFoto(); ?>" />

	<div id="art-lista-description">
		<ul>
			<li>Código de producto: <?php echo str_pad( $item->getId_producto(), 5, '0' , STR_PAD_LEFT); ?></li>
			<li>Nombre producto: <?php echo $item->getProducto(); ?> </li>
			<li><?php echo $item->getCaracteristicas(); ?></li>
		</ul>
	</div>

	
	<a class="btn carrito" href="index.php?content=productos_por_categoria&categoria=<?php echo $item->getCategoria(); ?>&task=articulo.addToCart&id_articulo=<?php echo $item->getId_producto(); ?>"></a>
	<a class="btn" href="index.php?content=articulo&id_articulo=<?php echo $item->getId_producto(); ?>">Ver</a>
	
</div>
<?php endif;?>

<!-- Fin Articulo lista -->

<?php endforeach;?>
<?php endif; ?>



<div id="pag"><!-- Paginacion-->
		
	<ul id="paginacion">
		<?php if ($pag > 1 && $numeroPaginas > 2): ///si estoy en una página mayor de 1, pongo un link a la primera, si no hay más de 2 páginas no la pongo?>
		<li><a href="index.php?content=productos_por_categoria&categoria=<?php echo $_GET['categoria']; ?>&pag=1">[<?php echo htmlspecialchars('<<')?>]</a></li>
		<?php endif; ?>			
		
		<?php if ($anterior): ?>
		<li><a href="index.php?content=productos_por_categoria&categoria=<?php echo $_GET['categoria']; ?>&pag=<?php echo $anterior; ?>">[<?php echo htmlspecialchars('<'); ?>]</a></li>
		<?php endif;?>	
		<?php if ($siguiente): ?>
		<li><a href="index.php?content=productos_por_categoria&categoria=<?php echo $_GET['categoria']; ?>&pag=<?php echo $siguiente; ?>">[<?php echo htmlspecialchars('>'); ?>]</a></li>
		<?php endif;?>
		
		
		<?php if ($pag < $numeroPaginas && $numeroPaginas > 2): //si estoy en una página menor que el número total de páginas pongo un link a la última, si no hay mas de 2 páginas no la pongo?>
		<li><a href="index.php?content=productos_por_categoria&categoria=<?php echo $_GET['categoria']; ?>&pag=<?php echo $numeroPaginas; ?>">[<?php echo htmlspecialchars('>>')?>]</a></li>
		<?php endif; ?>
	</ul>
	
</div><!-- Fin de Paginacion-->

