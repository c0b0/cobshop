<?php
/**
 * productos.php
 *
 * pagina para mostrar las ventas en la parte de administracion
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
$totalCompras = Compra::getTotalCompras();
$registrosPorP�gina = 14;
$numeroRegistros = hallarNumeroRegistros ( 'compras' );
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
	$ventas = Compra::getVentasParaPaginacion( $pag, $limit, $offset);
} else {
	$pag = 1;
	$ventas = Compra::getVentasParaPaginacion( $pag, $limit, $offset);
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
<?php if ($ventas): ?>

<ul id="user-tools">
	<li><a class="btn-back" href="index.php?content=administracion"><img	src="images/iconos/back.png" title="Volver atr�s"></a></li>
	<li><a class="btn-add" href="usuariomant.html"><img	src="images/iconos/add-small.png" title="A�adir usuario"></a></li>
</ul>

<table id="grid">
	<thead>
	<tr style='color:black;'><td>T.Ventas:</td><td><?php echo $totalCompras . ' �' ;?></td></tr>
	</thead>
	<thead>
		<tr>
			<th>Id</th>
			<th>Usuario</th>
			<th>Fecha</th>
			<th>Producto</th>
			<th>Unidades</th>
			<th>Coste total</th>
		</tr>
	</thead>
	<tfoot>
	</tfoot>
	<tbody>
		<?php foreach ($ventas as $i=>$venta): ?>
			<tr class="row<?php echo $i % 2 ;?>">
			<td><?php echo str_pad( $venta['id_compra'], 5, '0' , STR_PAD_LEFT); ?></td>
			<td><?php echo ucwords($venta['nombre']);?></td>
			<td><?php echo $venta['fecha']; ?></td>
			<td><?php echo ucwords($venta['producto']);?></td>
			<td><?php echo $venta['unidades']; ?></td>
			<td><?php echo $venta['coste_total'] . ' �'; ?></td>
		</tr>
		
		<?php endforeach;?>
	
</table>



<div id="pag">
	<ul id="paginacion">
			<?php if ($pag > 1 && $numeroPaginas > 2): //si estoy en una p�gina mayor de 1, pongo un link a la primera, si no hay m�s de 2 p�ginas no la pongo?>
			<li><a href="index.php?content=ventas&pag=1">[<?php echo htmlspecialchars('<<')?>]</a></li>
			<?php endif; ?>			
			
			<?php if ($anterior): ?>
			<li><a href="index.php?content=ventas&pag=<?php echo $anterior; ?>">[<?php echo htmlspecialchars('<'); ?>]</a></li>
			<?php endif;?>	
			<?php if ($siguiente): ?>
			<li><a href="index.php?content=ventas&pag=<?php echo $siguiente; ?>">[<?php echo htmlspecialchars('>'); ?>]</a></li>
			<?php endif;?>
			
			
			<?php if ($pag < $numeroPaginas && $numeroPaginas > 2): //si estoy en una p�gina menor que el n�mero total de p�ginas pongo un link a la �ltima, si no hay mas de 2 p�ginas no la pongo?>
			<li><a href="index.php?content=ventas&pag=<?php echo $numeroPaginas; ?>">[<?php echo htmlspecialchars('>>')?>]</a></li>
			<?php endif; ?>
	</ul>
</div>
<?php else:?>
<?php echo "A�n no hay compras"?>
<?php endif; ?>

<!-- Fin de Paginacion-->
<?php else :?>
<?php header("location: index.php&content=login")?>
<?php endif;?>

