<?php 
/**
 * borrar.php
 *
 * pagina para el borrado de registros
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */
?>


<?php



/**
 * este archivo lo usar� �nicamente para borrar registros
 * y redireccionar a continuaci�n a la p�gina que muestra
 * todos los registros de ese tipo
 * Es decir, al borrar un usuario, se borrar� y se redirecciona a usuarios.php
 * Si se borra un producto, se borrar� y se redireccionar� a productos
 * y as�..
 */
if (estaLogueado()){
	$tabla = $_GET['tabla'];
	$id = $_GET['id'];
	$id_articulo = $_GET['id_articulo'];

	
	switch ($tabla) {
		case 'usuarios':
			Usuario::borrarUsuario($tabla, $id);
			header("location: index.php?content=usuarios");
			break;
		case 'productos':
			Producto::borrarProducto($tabla, $id);
			header("location: index.php?content=productos");
			break;
		case 'categorias':
			Categoria::borrarCategoria($tabla, $id);
			header("location: index.php?content=categorias");
			break;
		case 'carritos':
			echo 'borrando carrito';
			$idUsuario = $_SESSION['id_usuario'];
			Carrito::borraCarrito($tabla, $id);
			header("location: index.php?content=cart&id_usuario=$idUsuario");
			break;
		case 'comentarios':
			Comentario::borraComentario($tabla, $id_articulo, $id);
			header("location: index.php?content=articulo&id_articulo=$id_articulo");
			break;
		default:
			;
			break;
	}
	
	
}else{
	header("location: index.php?content=home");
}






?>

