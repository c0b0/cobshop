<?php
/**
 * init.php
*
* Archivo de inicialización
*
* @version 1.0 2016-05-02
* @package CobShop
* @copyright Copyright (c) 2016 CobShop
*/
session_start(); //inicia una nueva sesión, o resume la existente
//inicializa el mensaje
$message = '';
if(isset($_SESSION['message'])){
	$message = htmlentities($_SESSION['message']);
	unset($_SESSION['message']); 
}

/**
 * MAGIC_QUOTES_ACTIVE era una opción que se usaba en php
 * para tratar con las comillas de las strings.
 * Defino esta constante para saber si está o no activo
 * y en consecuencia usar o no el método de la clase
 * mysqli para escapar comillas
 * @var unknown
 */
define('MAGIC_QUOTES_ACTIVE',get_magic_quotes_gpc());

require_once 'functions.php';

/**
 * carga las clases cuando se va necesitando
 * evita tener que hacer includes al principio de los archivos
 * @param unknown $class_name
 * @throws Exception
 */
function __autoload($class_name){
	try {
		$class_file = 'includes/classes/' . strtolower($class_name) . '.php';
		if (is_file($class_file)){
			require_once 'includes/classes/' . strtolower($class_name) . '.php';
		}else{
			throw new Exception("Unable to load class $class_name in file $class_file.");
		}

	} catch (Exception $e) {
		echo 'Exception caught: ' , $e->getMessage(), "\n";
	}
}

//Proceso basado en la variable $_POST['task']
/**
 * En los formularios introduzco un atributo "hidden"
 * de nombre $task
 * que indica qué se está haciendo.
 * 
 * Cada vez que la página se recarga (siempre, aunque no se
 * trate de un formulario) el recorrido que hace es
 * 1.- ir al index
 * 2.- en index hay un require que carga init (por eso siempre pasará por aquí)
 * 3.- al llegar aquí comprueba si existe la variable $task
 * 
 * De existir, esta variable se pasa por este switch case.
 * y dependiendo de su valor, procesará que se añada un usuario
 * que se borre, etc, casi siempre llamando a una función
 * que está en el archivo 'functions.php' que a su vez
 * llamaría a un método de la clase correspondiente
 * 
 * En resumen:
 * index->init->functions->metododelaclasecorrespondiente
 * 
 * @param string $_POST['task']
 */
$task = filter_input(INPUT_POST, 'task', FILTER_SANITIZE_STRING);
switch ($task){
	//USUARIOS
	case 'usuario.mantenimiento' :
		//procesa el matenimiento
		$results = maintUsuario();
		$message .= $results[1];
		if (isset($results[3])){
			$message .= '<br />' . $results[3];
		}
		//Si hubiera información para redirigir
		//redirige hacia esa página
		if ($results[0] == 'mant_usuario'){
			if ($results[1]){
				$_SESSION['message'] = $results[1];
			}
		header("Location: index.php?content=mant_usuarios&id_usuario=$results[2]");
		exit;
		}
		break;
	// PRODUCTOS
	case 'producto.mantenimiento' :
		//procesa el matenimiento
		$results = maintProducto();
		$message .= $results[1];
		//Si hubiera información para redirigir
		//redirige hacia esa página
		if ($results[0] == 'mant_productos'){
			if ($results[1]){
				$_SESSION['message'] = $results[1];
			}
		header("location: index.php?content=mant_productos&id_producto=$results[2]");
		exit;
		}
		break;
	// CATEGORÍAS
	case 'categoria.mantenimiento' :
		//procesa el matenimiento
		$results = maintCategoria();
		$message .= $results[1];
		//Si hubiera información para redirigir
		//redirige hacia esa página
		if ($results[0] == 'mant_categorias'){
			if ($results[1]){
				$_SESSION['message'] = $results[1];
			}
			header("location: index.php?content=mant_categorias&id_categoria=$results[2]");
			exit;
		}
		break;
		//LOGIN
		case 'usuario.login' :
			//procesa el matenimiento
			$results = loginUsuario();
			$message .= $results[1];
			//Si hubiera información para redirigir
			//redirige hacia esa página
			if ($results[0] == 'login'){
				if ($results[1]){
					$_SESSION['message'] = $results[1];
				}
			header("location: index.php?content=login");
			exit;
		}
		break;
		//Send.compra
		case 'send.compra':
		//echo 'ola k ase, estamos en send.compra';	
		break;
		//comenta.articulo
		case 'comenta.articulo':
			$results = prepComentario();
		break;
		case 'realiza.compra':
		//echo 'estamos en realiza.compra';
		$results = realizaCompra();
		break;
		case 'resetea.password':
		//echo 'estamos en resetea.password';
		$results = resetPassword();
		$message .= $results[1];
		
		break;		
		
}



/**
 * La razón de este switch es que en un primer momento intenté enviar el  artículo 
 * al carrito a través de un formulario, lo cual daba el problema de no poder dar
 * atrás en la página, ya que aparecía el mensaje de que había que reenviar
 * datos (ya que el formulario se ejecutaba por post)
 * Por lo tanto, reasigno a la variable $task un valor que le doy por $_GET
 * mediante un link, y a partir de ahí hago el proceso de inserción
 * del producto en el carrito
 * @var string $_GET['task']
 */
$task = filter_input(INPUT_GET, 'task', FILTER_SANITIZE_STRING);
switch ($task) {
	case 'articulo.addToCart':
		//procesa el matenimiento
		$results = addToCart();
		$message .= $results[1];
		
		$idDelArticulo = $_GET['id_articulo'];
			

			
		header("location = index.php?content=articulo&id_producto=$idDelArticulo");
		
		
		
	break;

}
