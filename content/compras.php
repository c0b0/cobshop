<?php 
/**
 * compras.php
 *
 * pagina para mostrar el grid de  compras
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>



<?php 
$items = Compra::getCompras();
?>

<ul id="user-tools">
	<li><a class="btn-add" href="usuariomant.html"><img	src="images/iconos/add-small.png" title="Añadir usuario"></a></li>
</ul>

<table id="grid">
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
		<?php foreach ($items as $i=>$item): ?>
			<tr class="row<?php echo $i % 2 ;?>">
			<td><?php echo str_pad( $item['id_compra'], 5, '0' , STR_PAD_LEFT); ?></td>
			<td><?php echo $item['nombre'];?></td>
			<td><?php echo $item['fecha']; ?></td>
			<td><?php echo $item['producto'];?></td>
			<td><?php echo $item['unidades']; ?></td>
			<td><?php echo $item['coste_total']; ?></td>
		</tr>
		
		<?php endforeach;?>
	
</table>



<div id="pag">
	<!-- Paginacion-->
	<p>[Primera][2][3][4][Última]</p>
</div>
<!-- Fin de Paginacion-->
