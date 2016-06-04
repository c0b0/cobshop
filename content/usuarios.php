<?php
/**
 * productos.php
 *
 * pagina para mostrar los usuarios en la parte de administracion
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
$registrosPorPágina = 14;
$numeroRegistros = hallarNumeroRegistros ( 'usuarios' );
$numeroPaginas = round ( $numeroRegistros / $registrosPorPágina );
//las siguientes variables las creo para que se entienda que las voy a usar para completar la consulta
$offset = 14 ; //este es el numero de registro desde el que empezará // si es 14, empezará en el puesto 14
//limit es el número máximo de registros que se toman de la base de datos
//por ejemplo limit 15 , offset 5 toma 15 registros, empezando del quinto en adelante
if ($numeroRegistros < 14 ){
	$limit = $numeroRegistros;
}else{
	$limit = 14;
}


if (isset($_GET['order'])){
	$order = $_GET['order'];
}else{
	$order = 'id_usuario';
}


//echo "el número de registros es:  $numeroRegistros <br />";
//echo "el número de paginas será: $numeroPaginas <br />";
?>


<?php 
if (isset ( $_GET ['pag'] )) {
	$pag = $_GET ['pag'];
	// consulta con el offset correspondiente
	$items = Usuario::getUsuariosParaPaginacion( $pag, $offset, $limit, $order);
} else {
	$pag = 1;
	$items = Usuario::getUsuariosParaPaginacion( $pag, $offset, $limit, $order);
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
<?php if ($items): ?>
<ul id="user-tools">
	<li><a class="btn-back" href="index.php?content=administracion"><img	src="images/iconos/back.png" title="Volver atrás"></a></li>
	<li><a class="btn-add" href="index.php?content=mant_usuarios&id_usuario=0"><img	src="images/iconos/add-small.png" title="Añadir usuario"></a></li>
</ul>

<table id="grid">
	<thead>
		<tr>
			<th><a class="white" href="index.php?content=usuarios&order=id_usuario">Id</a></th>
			<th><a class="white" href="index.php?content=usuarios&order=nombre">Usuario</a></th>
			<th><a class="white" href="index.php?content=usuarios&order=email">Email</a></th>
			<th><a class="white" href="index.php?content=usuarios&order=tipo">Tipo</a></th>
			<th><a class="white" href="index.php?content=usuarios&order=ciudad">Ciudad</a></th>
			
			<th>Ver</th>
			<th>Edit</th>
			<th>Del</th>
		</tr>
	</thead>
	<tfoot>
	</tfoot>
	<tbody>
		<?php foreach ($items as $i=>$item): ?>
			<?php $item->getId_tipo() == 1 ? $tipo = 'Admin' : $tipo = 'Normal' ;?>
			<tr class="row<?php echo $i % 2 ;?>">
			<td><?php echo $item->getId_usuario();?></td>
			<td><?php echo ucwords($item->getNombre()); ?></td>
			<td><?php echo $item->getEmail();?></td>
			<td><?php echo ucfirst($item->getTipo()); ; ?></td> 
			<td><?php echo ucwords($item->getCiudad()); ?></td>
			
			<td><a href="index.php?content=visor_usuario&id_usuario=<?php echo $item->getId_usuario(); ?>"><img class="noShadow" alt="ver" title="Ver datos del usuario" src="images/iconos/ver.png"></a></td>
			<td><a href="index.php?content=mant_usuarios&id_usuario=<?php echo $item->getId_usuario(); ?>"><img class="noShadow" alt="editar" title="Editar usuario" src="images/iconos/edit-xxsmall.png"></a></td>
			<?php if (esAdminElUsuario($item->getId_usuario())): ?>
			<td><img  class="noShadow" alt="borrar" title="Borrar usuario" src="images/iconos/borrar-xxsmall-grey.png" title="No puedes borrar a otro administrador"></td>
			<?php else: ?>
			<td><a href="index.php?content=visor_usuario&id_usuario=<?php echo $item->getId_usuario(); ?>&action=borrar"><img  class="noShadow" alt="borrar" title="Borrar usuario" src="images/iconos/borrar-xxsmall.png" title="Borrar usuario"></a></td>			
			<?php endif; ?>
			
		</tr>
		
		<?php endforeach;?>
	
</table>



<div id="pag">
		<ul id="paginacion">
			<?php if ($pag > 1 && $numeroPaginas > 2): //si estoy en una página mayor de 1, pongo un link a la primera, si no hay más de 2 páginas no la pongo?>
			<li><a href="index.php?content=usuarios&pag=1">[<?php echo htmlspecialchars('<<')?>]</a></li>
			<?php endif; ?>			
			
			<?php if ($anterior): ?>
			<li><a href="index.php?content=usuarios&pag=<?php echo $anterior; ?>">[<?php echo htmlspecialchars('<'); ?>]</a></li>
			<?php endif;?>	
			<?php if ($siguiente): ?>
			<li><a href="index.php?content=usuarioss&pag=<?php echo $siguiente; ?>">[<?php echo htmlspecialchars('>'); ?>]</a></li>
			<?php endif;?>
			
			
			<?php if ($pag < $numeroPaginas && $numeroPaginas > 2): //si estoy en una página menor que el número total de páginas pongo un link a la última, si no hay mas de 2 páginas no la pongo?>
			<li><a href="index.php?content=usuarios&pag=<?php echo $numeroPaginas; ?>">[<?php echo htmlspecialchars('>>')?>]</a></li>
			<?php endif; ?>
	</ul>
</div>
<!-- Fin de Paginacion-->
<?php else: ?>
<?php echo 'Aún no hay usuarios registrados'?>
<?php endif;?>
<?php else: ?>
<?php header("location: index.php?content=login")?>
<?php endif;?>

