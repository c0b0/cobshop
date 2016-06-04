<?php 
/**
 * articulo.php
 *
 * pagina para mostrar individualmente un articulo
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>

<?php
$id = $_GET ['id_articulo'];
$articulo = Producto::getProductoPorIdParaCarrito ( $id );
$comentarios = Comentario::getComentariosPorId ( $id );

$url = pillaURL (); //guardo esta variable para usarla en la creación del link
// echo $url . '<br />';
?>

<div id="articulo-lista">
	<?php if ($articulo->getDescuento()): ?>
	<div class="art-offer-desc">-<?php echo $articulo->getDescuento() . '%'; ?></div>
	<div class="art-offer-price"><?php echo CalculaDescuento($articulo->getPrecio(),$articulo->getDescuento())?>€</div>
	<div class="art-offer"></div>
	<?php endif;?>

	<!-- Articulo lista -->
	<img src="images/productos/<?php echo $articulo->getFoto(); ?>" />

	<div id="art-lista-description">
		<ul>
			<li>Codigo del producto: <?php echo str_pad( $articulo->getId_producto(), 5, '0' , STR_PAD_LEFT); ?></li>
			<li>Nombre del producto: <?php echo $articulo->getProducto(); ?></li>
			<li>Características: <?php echo $articulo->getCaracteristicas(); ?></li>
		</ul>
	</div>

	<div id="art-lista-precio">
		<strong><?php echo $articulo->getPrecio(); ?>€</strong>
	</div>

<a class="btn carrito" href="index.php?content=articulo&id_articulo=<?php echo $id?>&task=articulo.addToCart"></a>

</div>
<!-- Fin Articulo lista -->




<!-- Opiniones de usuarios sobre este artículo -->

<?php if ($comentarios): ?>
<?php foreach ($comentarios as $comentario): ?>

<div class="opinion">
	<?php if (estaLogueado() && esAdmin()):?>
	<a href="index.php?content=borrar&tabla=comentarios&id=<?php echo $comentario['id_comentario']; ?>&id_articulo=<?php echo $articulo->getId_producto();?>"><img style="width:15px;height:15px;"class="noShadow" alt="" src="images/iconos/borrar-xxsmall.png"></a>
	<?php endif;?>
	<h3><?php echo ucfirst( $comentario['nombre'])?></h3>
	<small><?php echo $comentario['fecha']?></small>
	<p><?php echo $comentario['comentario']?></p>
</div>
<?php endforeach; ?>
<?php endif; ?>
<!--  Fin de las opiniones de los usuarios -->


<?php if (estaLogueado()): ?>
<!--  Inicio del div para introducir un nuevo comentario -->
<div id="nueva-opinion">
	<form id="formOpinion" method="post" action="index.php?content=articulo&id_articulo=<?php echo $articulo->getId_producto() ;?>">
		<textarea id="comentario" name="comentario" placeholder="Déjanos tu opinión" cols="85" rows="6"></textarea>
		<input type="submit" value="enviar">
		<input type="hidden" name="task" value="comenta.articulo">
		<input type="hidden" name="id_comentario" value=""/>
	</form>
</div>
<!--  Fin del div para introducir un nuevo comentario -->




<div id="pag">
	<!-- Paginacion-->
	<p>[Primera][2][3][4][Última]</p>
</div>
<!-- Fin de Paginacion-->

<?php endif; ?>

