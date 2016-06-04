<?php
/**
 * home.php
 *
 * pagina para mostrar contenido de inicio
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
$registrosPorPágina = 6;
$numeroRegistros = hallarNumeroRegistros ( 'productos' );
$numeroPaginas = round ( $numeroRegistros / $registrosPorPágina );
//las siguientes variables las creo para que se entienda que las voy a usar para completar la consulta
$limit = 6 ; //esto representa el número de registros que quiero que aparezcan en la consulta
$offset = 6; //este es el numero de registro desde el que empezará // si es 14, empezará en el puesto 14
//echo "el número de registros es:  $numeroRegistros <br />";
//echo "el número de paginas será: $numeroPaginas <br />";
?>


<?php
if (isset ( $_GET ['pag'] )) {
	$pag = $_GET ['pag'];
	// consulta con el offset correspondiente
	$productos = Producto::getProductosParaPaginacionHome( $pag, $limit, $offset);
} else {
	$pag = 1; 
	$productos = Producto::getProductosParaPaginacionHome( $pag, $limit, $offset );
}
?>
<?php if ($productos): ?>
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




<?php foreach ($productos as $producto): ?>

<?php if (Producto::hayStock($producto->getId_producto())):?>

<div id="articulo-index">
	<?php if ($producto->getDescuento()): ?>
	<div class="art-offer-desc">-<?php echo $producto->getDescuento() . '%'; ?></div>
	<div class="art-offer-price"><?php echo CalculaDescuento($producto->getPrecio(),$producto->getDescuento())?>€</div>
	<div class="art-offer"></div>
	<?php endif; ?>
	
	<div id="precio">
		<strong><?php echo $producto->getPrecio();?>€</strong>
	</div>
	<div class="centrado">
		<img src="images/productos/<?php echo $producto->getFoto(); ?>" />
	</div>


	<div id="index-description">
		<p><?php echo $producto->getProducto(); ?></p>
	</div>

	<a class="btn carrito"
		href="index.php?content=home&id_articulo=<?php echo $producto->getId_producto(); ?>&task=articulo.addToCart"></a>
	<a class="btn btn-index"
		href="index.php?content=articulo&id_articulo=<?php echo $producto->getId_producto(); ?>">Ver</a>

</div>

<?php endif; ?>


<?php endforeach;?>



<div id="pag"><!-- Paginacion-->
	<ul id="paginacion">
			<?php if ($pag > 1 && $numeroPaginas > 2): //si estoy en una página mayor de 1, pongo un link a la primera, si no hay más de 2 páginas no la pongo?>
			<li><a href="index.php?content=home&pag=1">[<?php echo htmlspecialchars('<<')?>]</a></li>
			<?php endif; ?>			
			
			<?php if ($anterior): ?>
			<li><a href="index.php?content=home&pag=<?php echo $anterior; ?>">[<?php echo htmlspecialchars('<'); ?>]</a></li>
			<?php endif;?>	
			<?php if ($siguiente): ?>
			<li><a href="index.php?content=home&pag=<?php echo $siguiente; ?>">[<?php echo htmlspecialchars('>'); ?>]</a></li>
			<?php endif;?>
			
			
			<?php if ($pag < $numeroPaginas && $numeroPaginas > 2): //si estoy en una página menor que el número total de páginas pongo un link a la última, si no hay mas de 2 páginas no la pongo?>
			<li><a href="index.php?content=home&pag=<?php echo $numeroPaginas; ?>">[<?php echo htmlspecialchars('>>')?>]</a></li>
			<?php endif; ?>
	</ul>
</div><!-- Fin de Paginacion-->
<?php else: ?>
<?php echo 'Aún no hay productos'; ?>
<?php endif;?>

