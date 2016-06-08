<?php
/**
 * visor_usuario.php
 *
 * pagina para mostrar usuario en concreto en la zona de administracion
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>
<?php 
$id = $_GET['id_usuario'];
$usuario = Usuario::getUsuarioPorId($id);
$compras = Compra::getCompraPorUsuario($id);
$tipo = $usuario->getId_tipo() == 1 ? $tipo = 'Admin' : $tipo = 'Normal';
?>

<?php if (estaLogueado() && esAdmin()): ?>
<ul id="user-tools">
	<li><a class="btn-edit" href="index.php?content=mant_usuarios&id_usuario=<?php echo $usuario->getId_usuario(); ?>"><img src="images/iconos/edit-small.png" title="Editar usuario"></a></li>
	<?php if (esAdminElUsuario($usuario->getId_usuario())): ?>
	<li><img class="noShadow" src="images/iconos/borrar-small-grey.png" title="No puedes borrar a otro administrador"></li>
	<?php else: ?>
	<li><a class="btn-delete" href="index.php?content=visor_usuario&id_usuario=<?php echo $usuario->getId_usuario();?>&action=borrar"><img src="images/iconos/borrar-small.png" title="Borrar usuario"></a></li>
	<?php endif;?>
	
</ul>

<?php if (isset($_GET['action']) && $_GET['action'] == 'borrar') : ?>
<p class="mensaje">Va a borrar este registro, está seguro?</p>
<a class="btn" href="index.php?content=visor_usuario&id_usuario=<?php echo $usuario->getId_usuario(); ?>">No</a>
<a class="btn" href="index.php?content=borrar&tabla=usuarios&id=<?php echo $usuario->getId_usuario(); ?>">Sí</a>
<?php endif; ?>

<div id="perfil">
	<table class="datos">
		<tr>
			<td>Id:</td><td><?php echo str_pad( $usuario->getId_usuario(), 5, '0' , STR_PAD_LEFT)?></td>
		<tr>
		<tr>
			<td>Nombre:</td><td><?php echo ucwords($usuario->getNombre()); ?></td>
		<tr>
		<tr>
			<td>Email:</td><td><?php echo $usuario->getEmail()?></td>
		<tr>
		<tr>
			<td>Nivel:</td><td><?php echo ucfirst($tipo); ?></td>
		<tr>
		<tr>
			<td>Dirección:</td><td><?php echo ucwords($usuario->getDireccion()); ?></td>
		<tr>
		<tr>
			<td>C.P.:</td><td><?php echo $usuario->getCodigo_postal(); ?></td>
		<tr>
		<tr>
			<td>Provincia</td><td><?php echo ucwords($usuario->getProvincia()); ?></td>
		<tr>
		<tr>
			<td>Ciudad:</td><td><?php echo ucwords($usuario->getCiudad()); ?></td>
		<tr>
		
	</table>

</div>




<?php if ($compras): ?>
<table id="grid">
	<thead>
		<tr>
			<th colspan="4">Compras de <?php echo ucwords($usuario->getNombre()); ?></th>
		</tr>
	</thead>
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Producto</th>
			<th>Unidades</th>
			<th>Coste</th>
			
		</tr>
	</thead>
	<tfoot>
	</tfoot>
	<tbody>
		<?php foreach ($compras  as $i=>$compra): ?>
			<tr class="row<?php echo $i % 2 ;?>">
			<td><?php echo $compra['fecha']; ?></td>
			<td><?php echo $compra['producto']; ?></td>
			<td><?php echo $compra['unidades']; ?></td>
			<td><?php echo $compra['coste_total'] . ' €'; ?></td>
			
		</tr>
		
		<?php endforeach;?>
	
</table>
<?php endif; ?>

<?php else :?>
<?php header("location: index.php?content=login")?>


<?php endif; ?>


