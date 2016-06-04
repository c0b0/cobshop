<?php 
/**
 * mant_productos.php
 *
 * formulario para agregar/editar productos
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>



<?php 
//pillo la id de la barra de dirección
isset($_GET['id_producto']) ? $id = (int)$_GET['id_producto'] : $id = 0;
//1.- si ya existe esta id, se pilla ese registro
//2.- si no, se crea un usuario nuevo
if ($id && $id > 0){
	//1.-buscamos el producto
	$item = Producto::getProductoPorId($id);
}else{
	$item = new Producto();
}
$categorias = Categoria::getCategorias();


/*$item = new Producto();
//esto es para el selector de la categoría del producto
*/ 
?>
<?php if (estaLogueado() && esAdmin() ): ?>
<ul id="user-tools">
	<li><a class="btn-back" href="index.php?content=productos"><img	src="images/iconos/back.png" title="Volver atrás"></a></li>
</ul>

<form action="index.php?content=mant_productos" method="post" name="maint" id="maint" enctype="multipart/form-data">
	<table id="formulario">
		<tr>
			<td><label for="producto">Producto</label></td>
			<td><input id="producto" required type="text" id="producto" name="producto" value="<?php echo $item->getProducto(); ?>"/></td>
		</tr>
		<tr>
			<td colspan="2"><label for="caracteristicas">Características</label><br />
			<textarea id="caracteristicas" name="caracteristicas" cols="52" rows="6"><?php echo $item->getCaracteristicas(); ?></textarea>
			</td>
			
		</tr>
		<tr>
			<td><label for="precio">Precio</label></td>
			<td><input required type="text" id="precio_producto" name="precio" value="<?php echo $item->getPrecio(); ?>"/></td>
		</tr>
		<tr>
			<td><label for="stock">Stock</label></td>
			<td><input required type="text" id="stock" name="stock" value="<?php echo $item->getStock(); ?>"></td>
		</tr>
		<tr>
			<td><label  for="foto">Foto</label></td>
			<td><input  type="file" id="foto" name="foto" value=""></td>
		</tr>
		<tr>
			<td><label for="descuento">Descuento</label></td>
			<td>
				<select name="descuento" id="descuento">
					<option value= "0" <?php if ($item->getDescuento() == 0 ){ echo 'selected="selected"';  } ?>>0%</option>
					<option value= "5" <?php if ($item->getDescuento() == 5 ){ echo 'selected="selected"';  } ?>>	5%	</option>
					<option value= "10"<?php if ($item->getDescuento() == 10 ){ echo 'selected="selected"';  } ?>>10%	</option>
					<option value= "25"<?php if ($item->getDescuento() == 25 ){ echo 'selected="selected"';  } ?>>25%	</option>
					<option value= "50"<?php if ($item->getDescuento() == 50 ){ echo 'selected="selected"';  } ?>>50%	</option>					
				</select>				
			</td>
		</tr>
		<tr>
			<td><label>Tipo</label></td>
			<td><select name="id_categoria">
					<?php foreach ($categorias as $categoria): ?>
						<option value="<?php echo $categoria->getId_categoria(); ?>"<?php  if ($categoria->getCategoria() == $item->getCategoria()){echo 'selected = "selected"'; } ;  ?>><?php echo $categoria->getCategoria(); ?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
	</table>
	
<?php 
//creo un token
$salt = 'SomeSalt';
$token = sha1(mt_rand(1, 1000000) . $salt);
$_SESSION['token'] = $token;
?>
<input type="hidden" name="id_producto" id="id" value="<?php echo $item->getId_producto(); ?>"/>
<input type="hidden" name="task" value="producto.mantenimiento" />
<input type="hidden" name="token" value='<?php echo $token; ?>' />
<input type="submit" name="guardar" value="Guardar" />
<a class="btnCancel" href="index.php?content=productos">Cancelar</a>

<input type="hidden" name="picture" value="<?php echo $item->getFoto(); ?>" >

</form>
<?php else: ?>
<?php header("location: index.php?content=login"); ?>
<?php endif;?>

