<?php 
/**
 * mant_usuarios.php
 *
 * formulario para agregar/editar usuarios
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
isset($_GET['id_usuario']) ? $id = (int)$_GET['id_usuario']: $id = 0;
//1.-si ya existe esta id, se pilla ese registro
//2.-si no, se crea un usuario nuevo
if ($id && $id > 0){
	//1.-buscamos el usuario
	$item = Usuario::getUsuarioPorId($id);
	//$nivel = $item->getId_tipo();
}else{
	//2.-usuario nuevo
	$item = new Usuario();
}
$tipos = Tipo::getTipos();
?>



<ul id="user-tools">
	<li><a class="btn-back" href="index.php?content=usuarios"><img	src="images/iconos/back.png" title="Volver atrás"></a></li>
</ul>

<form action="index.php?content=mant_usuarios" method="post" name="maint" id="maint">
	<table id="formulario">
		<tr>
			<td><label for="nombre">User*</label></td>
			<td><input  autofocus type="text" id="nombre" name="nombre" value="<?php echo ucwords($item->getNombre()) ;?>"/></td>
		</tr>
		<tr>
			<td><label for="password">Password*</label></td>
			<td><input  type="password" id="password" name="password" value=""/></td>
		</tr>
		<tr>
			<td><label for="password2">Confirmar password*</label></td>
			<td><input  type="password" id="password2" name="password2" value=""/></td>
		</tr>
		<tr>
			<td><label for="email">Email*</label></td>
			<td><input  type="email" id="email" name="email" value="<?php echo $item->getEmail(); ?>"/></td>
		</tr>
		<?php if (estaLogueado() && esAdmin()): ?>
			<tr>
			<td><label>Tipo*</label></td>
			<td><select name="id_tipo">
					<option value="0">--</option>
					<?php foreach ($tipos as $tipo): ?>
						<?php if ($tipo->getId_tipoUsuario() == $item->getId_tipo()){
							$atributo = "selected = 'selected'";
						}else{
							$atributo = '';
						}
								
						?>
						<option value="<?php echo $tipo->getId_tipoUsuario(); ?>" <?php echo $atributo; ?> ><?php echo ucfirst($tipo->getTipoUsuario()); ?></option>
					<?php endforeach;?>
			</select></td>
		</tr>
				
		<?php endif; ?>
		
		
		<tr>
			<td><label for="direccion" >Dirección*</label></td>
			<td><input type="text"  id="direccion" name="direccion" value="<?php echo ucwords( $item->getDireccion()); ?>"/></td>
			
		</tr>
		<tr>
			<td><label for="ciudad">Ciudad*</label></td>
			<td><input  type="text" id="ciudad" name="ciudad" value="<?php echo ucwords($item->getCiudad()); ?>"></td>
		</tr>
		<tr>
			<td><label  for="codigo_postal">Código Postal*</label></td>
			<td><input  type="text" maxlength="5" id="codigo_postal" name="codigo_postal" value="<?php echo $item->getCodigo_postal(); ?>"></td>
		</tr>
		<tr>
			<td><label for="provincia">Provincia*</label></td>
			<td><input  type="text" id="provincia" name="provincia" value="<?php echo ucwords($item->getProvincia()); ?>"></td>
		</tr>


	</table>
	
<?php 
//creo un token
$salt = 'SomeSalt';
$token = sha1(mt_rand(1, 1000000) . $salt);
$_SESSION['token'] = $token;

?>
<input type="hidden" name="id_usuario" id="id" value="<?php echo $item->getId_usuario(); ?>"/>
<input type="hidden" name="task" value="usuario.mantenimiento" />
<input type="hidden" name="token" value='<?php echo $token; ?>' />
<input type="submit" name="guardar" value="Guardar" />
<a class="btnCancel" href="index.php?content=usuarios">Cancelar</a>
</form>




