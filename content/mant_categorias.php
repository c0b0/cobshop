<?php 
/**
 * mant_categorias.php
 *
 * formulario para agregar/editar categorias
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
isset($_GET['id_categoria']) ? $id = (int)$_GET['id_categoria']: $id = 0;
//1.-si ya existe esta id, se pilla ese registro
//2.-si no, se crea una categoria  nueva
if ($id && $id > 0){
	//1.-buscamos el usuario
	$item = Categoria::getCategoriaPorId($id);
}else{
	//2.-categoria nueva
	$item = new Categoria();
}
?>
<?php if (estaLogueado() && esAdmin()): ?>
<ul id="user-tools">
	<li><a class="btn-back" href="index.php?content=categorias"><img	src="images/iconos/back.png" title="Volver atrás"></a></li>
</ul>


<form action="index.php?content=mant_categorias" method="post" name="maint" id="maint" enctype="multipart/form-data">
	
	<table id="formulario">
		<tr>
			<td><label for="categoría">Nombre de la Categoría</label></td>
			<td><input required type="text" id="categoria" name="categoria" value="<?php echo $item->getCategoria(); ?>"/></td>
		</tr>
	</table>
	
<?php 
//creo un token
$salt = 'SomeSalt';
$token = sha1(mt_rand(1, 1000000) . $salt);
$_SESSION['token'] = $token;
?>
<input type="hidden" name="id_categoria" id="id" value="<?php echo $item->getId_categoria(); ?>"/>
<input type="hidden" name="task" value="categoria.mantenimiento" />
<input type="hidden" name="token" value='<?php echo $token; ?>' />
<input type="submit" name="guardar" value="Guardar" />
<a class="btnCancel" href="index.php?content=categorias">Cancelar</a>
</form>
<?php else:?>
<?php header("location: index.php?content=login"); ?>
<?php endif;?>

