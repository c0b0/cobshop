<?php 
/**
 * cart.php
 *
 * pagina para mostrar el carrito
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>



<?php
$items = Carrito::getCarritoDelUsuario( $_SESSION ['id_usuario'] );
?>

<?php if ($items): ?>
<ul id="user-tools">
	<li><a class="btn-back" href="index.php?content=cart&id_usuario=<?php echo $_SESSION['id_usuario']; ?>"><img	src="images/iconos/back.png" title="Volver atrás"></a></li>
</ul>
	<div id="lista-carrito">
	
	
	
	<table>
		<thead>
			<tr>
				
				<th></th>
				<th id="tcart_producto">Producto</th>
				<th>Uds.</th>
				<th id="tcart_precio">Precio</th>
				<th id="tcart_descuento">Descuento</th>
				<th id="tcart_preciof">Precio final</th>
				<th></th>
				<th></th>
				
			</tr>
		</thead>
		<tbody>
			
		
			<?php foreach ($items as $i=>$item): ?>
				
				<form method="post" action="index.php?content=proceso_pago&id_usuario=<?php echo $_SESSION['id_usuario']; ?>">
								
				<tr class="row<?php echo $i % 2; ?>">
				
				<td><img src="images/productos/<?php echo $item['foto']; ?>" /></td>
				<td><?php echo $item['producto']; ?></td>
				<td>
					<select name="unidades">
						<?php for($i = 1; $i <= 10; $i ++): ?>
							<option value="<?php echo $i; ?>" <?php echo isset($_POST['unidades']) && $_POST['unidades'] == $i ? "selected='selected" : ''; ?> ><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
				
				</td>
				<td><?php echo $item['precio']?></td>
				<td><?php echo $item['descuento'].'%'; ?></td>
				<td><?php echo $item['descuento'] ? CalculaDescuento($item['precio'], $item['descuento']): $item['precio'] .'€'; ?></td>
				<td><a href="index.php?content=borrar&tabla=carritos&id=<?php echo $item['id_producto']; ?>"><img style="width:30px;height:30px;"class="noShadow" alt="" src="images/iconos/borrar-small.png"></a></td>
				<td><input type="submit" value="Comprar"></td>
				
				</tr>
				<input type="hidden" name="task" value="send.compra">
				<input type="hidden" name="id_producto" value="<?php echo $item['id_producto']; ?>"/>
				</form>		
			<?php endforeach;?>

		</tbody>
	</table>
	
	
</div>
<?php else: ?>
<?php echo 'No hay artículos en este carrito'; ?>
<?php endif;?>




