<?php
/**
 * productos.php
 *
 * pagina para mostrar los productos en la parte de administracion
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
 * aqu� declaro una serie de variablas que me van a servir en el proceso de paginaci�n
 *
 * $registros por p�ginas indica el n�mero de registros que quiero que se vean de una vez
 * intento que sea una cantidad razonable para que el usuario no deba hacer scroll en la p�gina
 * de forma interminable
 *
 * $numero de registros indica la cantidad de filas que tengo en esa tabla, de modo que
 * dividiendo  por el n�mero de registros que quiero por p�ginas (redondeando hacia arriba)
 * tendr� el n�mero de p�ginas en total
 */
$registrosPorP�gina = 14;
$numeroRegistros = hallarNumeroRegistros ( 'productos' );
$numeroPaginas = round ( $numeroRegistros / $registrosPorP�gina );
//las siguientes variables las creo para que se entienda que las voy a usar para completar la consulta
$offset = 14; //este es el numero de registro desde el que empezar� // si es 14, empezar� en el puesto 14
//limit es el n�mero m�ximo de registros que se toman de la base de datos 
//por ejemplo limit 15 , offset 5 toma 15 registros, empezando del quinto en adelante
if ($numeroRegistros < 14 ){
	$limit = $numeroRegistros;
}else{
	$limit = 14;
}




//echo "el n�mero de registros es:  $numeroRegistros <br />";
//echo "el n�mero de paginas ser�: $numeroPaginas <br />";
?>


<?php 
if (isset ( $_GET ['pag'] )) {
	$pag = $_GET ['pag'];
	// consulta con el offset correspondiente
	$productos = Producto::getProductosParaPaginacion ( $pag, $limit, $offset);
} else {
	$pag = 1;
	$productos = Producto::getProductosParaPaginacion ( $pag, $limit, $offset);
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


<?php if (estaLogueado() && esAdmin()): ?>
<ul id="user-tools">
	<li><a class="btn-back" href="index.php?content=administracion"><img	src="images/iconos/back.png" title="Volver atr�s"></a></li>
	<li><a class="btn-add" href="index.php?content=mant_productos&id_producto=0"><img	src="images/iconos/add-small.png" title="A�adir producto"></a></li>
</ul>

<table id="grid">
	<thead>
		<tr>
			<th>ID</th>
			<th id="colProducto">Producto</th>
			<th>Categor�a</th>
			<th>PVP</th>
			<th>Desc</th>
			<th>P.Desc</ht>
			<th>Stock</th>
			<th>Ver</th>
			<th>Edit</th>
			<th>Del</th>
		</tr>
	</thead>
	<tfoot>
	</tfoot>
	<tbody>
	<?php foreach($productos as $i=>$producto): ?>
	<?php if ($producto->getStock() < 5){
		$stockBajo = true;
	}else{
		$stockBajo = false;
	}
	
	if ($producto->getDescuento()){
		$precioDesc = CalculaDescuento($producto->getPrecio(), $producto->getDescuento());
	}else{
		$precioDesc = $producto->getPrecio();
	}
	
		?>
		<tr class="row<?php echo $i % 2; ?>">
			<td><?php echo $producto->getId_producto(); ?></td>
			<td><?php echo formateaString($producto->getProducto()); ?></td>
			<td><?php echo $producto->getCategoria(); ?></td>
			<td><?php echo $producto->getPrecio(); ?>�</td>
			<td><?php echo $producto->getDescuento(); ?>%</td>
			<td><?php echo $precioDesc . '�'; ?></td>
			
			<td class="stock <?php 
			if ($stockBajo){
				echo 'stockBajo';
			}else{
				echo '';
			}
			
			?>"><?php echo $producto->getStock(); ?></td>
			<td><a href="index.php?content=visor_producto&id_producto=<?php echo $producto->getId_producto(); ?>"><img class="noShadow" title="Ver Producto" src="images/iconos/ver.png"/></a></td>
			<td><a href="index.php?content=mant_productos&id_producto=<?php echo $producto->getId_producto(); ?>"><img class="noShadow" title="Ver Producto" src="images/iconos/edit-xxsmall.png"/></a></td>
			<td><a href="index.php?content=visor_producto&id_producto=<?php echo $producto->getId_producto();?>&action=borrar"><img  class="noShadow" alt="borrar" title="Borrar producto" src="images/iconos/borrar-xxsmall.png"></a></td>
		</tr>
	<?php endforeach; ?>
	</tbody>

</table>



<div id="pag">
	<ul id="paginacion">
			<?php if ($pag > 1 && $numeroPaginas > 2): //si estoy en una p�gina mayor de 1, pongo un link a la primera, si no hay m�s de 2 p�ginas no la pongo?>
			<li><a href="index.php?content=productos&pag=1">[<?php echo htmlspecialchars('<<')?>]</a></li>
			<?php endif; ?>			
			
			<?php if ($anterior): ?>
			<li><a href="index.php?content=productos&pag=<?php echo $anterior; ?>">[<?php echo htmlspecialchars('<'); ?>]</a></li>
			<?php endif;?>	
			<?php if ($siguiente): ?>
			<li><a href="index.php?content=productos&pag=<?php echo $siguiente; ?>">[<?php echo htmlspecialchars('>'); ?>]</a></li>
			<?php endif;?>
			
			
			<?php if ($pag < $numeroPaginas && $numeroPaginas > 2): //si estoy en una p�gina menor que el n�mero total de p�ginas pongo un link a la �ltima, si no hay mas de 2 p�ginas no la pongo?>
			<li><a href="index.php?content=productos&pag=<?php echo $numeroPaginas; ?>">[<?php echo htmlspecialchars('>>')?>]</a></li>
			<?php endif; ?>
	</ul>	

</div>
<!-- Fin de Paginacion-->
<?php else: ?>
<?php header("location: index.php?content=login")?>
<?php endif; ?>



