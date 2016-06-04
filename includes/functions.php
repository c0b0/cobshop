<?php 
/*
 * carga dinámicamente las diferentes páginas cuando es necesario
 * loadContent
 * @param $default
 * */
function loadContent(){
	$content = '';
	if (isset($_GET['content'])){
		$content = $_GET['content'];
		filter_var($content, FILTER_SANITIZE_STRING);
	}
	
	$content = (empty($content)) ? "home" : $content;
	include 'content/'. $content .'.php';
}

/**
 * toma el password introducido en el formulario
 * y lo encripta 
 * @param $tring $password
 */
function encriptarPassword($password){
	$salt = 'SomeSalt';
	$password = hash_hmac('whirlpool', $password, $salt);
	return $password;
}


/**
 * maintUsuario()
 * 
 * Primero se comprobará que se ha usado el botón 'guardar', y de ser así
 * que el token es el correcto y coincide en $_POST y en $_SESSION
 * Entonces, tomará los datos del formulario que se encuentran en 
 * la variable global $_POST[]
 * y se irán incluyendo en un array asociativo, que luego se enviará
 * al método que se encarga de crear un nuevo objeto Usuario para
 * introducirlo en la base de datos
 */
function maintUsuario(){
	$results = '';
	if (isset($_POST['guardar']) AND $_POST['guardar'] == 'Guardar'){
		//se comprueba el token
		$badToken = true;
		if (!isset($_POST['token'])
		|| !isset($_SESSION['token'])
		|| empty($_POST['token'])
		|| $_POST['token'] !== $_SESSION['token']){
		
			$results = array('' , 'Ha habido un problema de seguridad, por favor, vuelve atrás');
			$badToken = true;
		}else{
			$badToken = false;
			unset($_SESSION['token']);
									 
			//se ponen las variables saneadas en un array asociativo
			$item = array(
					'id_usuario'	=> (int)$_POST['id_usuario'],
					'nombre'		=> filter_var($_POST['nombre'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES),
					'password'  	=> filter_var($_POST['password'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES),
					'email'			=> filter_var($_POST['email'], FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
					'id_tipo'		=> isset($_POST['id_tipo']) ? $_POST['id_tipo'] : '2',
					'direccion'		=> filter_var($_POST['direccion'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES),
					'ciudad'		=> filter_var($_POST['ciudad'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES),
					'codigo_postal'	=> filter_var($_POST['codigo_postal'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES),
					'provincia'		=> filter_var($_POST['provincia'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)
					
					
			);
			
			//prepara un objeto Usuario basado en los datos de arriba
			$user = new Usuario($item);
			if ($user->getId_usuario()){
				$results = $user->editUsuario();
			}else{
				$results = $user ->addUsuario();
			}
		}
	}
	
	return $results;
}


/**
 * maintProducto()
 *
 * Primero se comprobará que se ha usado el botón 'guardar', y de ser así
 * que el token es el correcto y coincide en $_POST y en $_SESSION
 * Entonces, tomará los datos del formulario que se encuentran en
 * la variable global $_POST[]
 * y se irán incluyendo en un array asociativo, que luego se enviará
 * al método que se encarga de crear un nuevo objeto Producto para
 * introducirlo en la base de datos
 */
function maintProducto(){
	$results = '';
	if (isset($_POST['guardar']) AND $_POST['guardar'] == 'Guardar'){
		//se comprueba el token
		$badToken = true;
		if (!isset($_POST['token'])
				|| !isset($_SESSION['token'])
				|| empty($_POST['token'])
				|| $_POST['token'] !== $_SESSION['token']){

					$results = array('' , 'Ha habido un problema de seguridad, por favor, vuelve atrás');
					$badToken = true;
		}else{
			$badToken = false;
			unset($_SESSION['token']);
			
			if ($_FILES['foto']['name']){
				$foto =  $_FILES['foto']['name'];
			}else{
				$foto = $_POST['picture'];
			}
										
			//se ponen las variables saneadas en un array asociativo
			$item = array(
					'id_producto'		=> (int)$_POST['id_producto'],
					'producto'			=> filter_var($_POST['producto'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES),
					'caracteristicas'	=> filter_var($_POST['caracteristicas'], FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES),
					'precio'			=> (int)$_POST['precio'],
					'stock'				=> (int)$_POST['stock'],
					'foto'				=> $foto,
					'descuento'			=> filter_var($_POST['descuento'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES),
					'id_categoria'		=> (int)$_POST['id_categoria']
									
			);
			
			//prepara un objeto Usuario basado en los datos de arriba
			$product = new Producto($item);
			if ($product->getId_producto()){
				$results = $product->editProducto();
			}else{
				$results = $product->addProducto();
			}
			
		}
	}

	return $results;
}

/**
 * maintCategoria()
 *
 * Primero se comprobará que se ha usado el botón 'guardar', y de ser así
 * que el token es el correcto y coincide en $_POST y en $_SESSION
 * Entonces, tomará los datos del formulario que se encuentran en
 * la variable global $_POST[]
 * y se irán incluyendo en un array asociativo, que luego se enviará
 * al método que se encarga de crear un nuevo objeto Producto para
 * introducirlo en la base de datos
 */

function maintCategoria(){
	$results = '';
	if (isset($_POST['guardar']) AND $_POST['guardar'] == 'Guardar'){
		//se comprueba el token
		$badToken = true;
		if (!isset($_POST['token'])
				|| !isset($_SESSION['token'])
				|| empty($_POST['token'])
				|| $_POST['token'] !== $_SESSION['token']){

					$results = array('' , 'Ha habido un problema de seguridad, por favor, vuelve atrás');
					$badToken = true;
		}else{
			$badToken = false;
			unset($_SESSION['token']);

			//se ponen las variables saneadas en un array asociativo
			$item = array(
					'id_categoria'		=> (int)$_POST['id_categoria'],
					'categoria'			=> filter_var($_POST['categoria'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)
			);
				
			//prepara un objeto Usuario basado en los datos de arriba
			$nuevaCategoria = new Categoria($item);
			if ($nuevaCategoria->getId_categoria()){
				$results = $nuevaCategoria->editCategoria();
			}else{
				$results = $nuevaCategoria->addCategoria();
			}
						
		}
		
	}

	return $results;
}


function prepComentario(){
	$results = '';
	$items = array(
			'comentario'  	=> filter_var($_POST['comentario'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES),
			'id_usuario' 	=> $_SESSION['id_usuario'],
			'id_producto' 	=> $_GET['id_articulo']
			
	);
	$nuevoComentario = new Comentario($items);
	$results = $nuevoComentario->addComentario();
	return $results;
}



function loginUsuario(){
	$results = '';
	if (isset($_POST['login']) and $_POST['login'] == 'Log In'){
		$badToken = true;
		if (!isset($_POST['token'])
				|| !isset($_SESSION['token'])
				|| empty($_POST['token'])
				|| $_POST['token'] !== $_SESSION['token']){
						
					$results = array('' , 'Ha habido un problema de seguridad, por favor, vuelve atrás');
					$badToken = true;
		}else{
			$email = 	filter_var($_POST['email'], FILTER_SANITIZE_EMAIL, FILTER_FLAG_NO_ENCODE_QUOTES);
			$password = 	filter_var($_POST['password'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			$results = Usuario::login($email, $password);
		}
			
	}else{
		
	}
	return $results;
}

/**
 * devuelve si el usuario está logueado
 * es decir, busca en la variable global de sessión
 * si existe una variable email, lo que significaría que el
 * usuario está, efectivamente, logueado
 */
function estaLogueado(){
	return isset($_SESSION['email']);
}

/**
 * esAdin
 * comprueba si el nivel del usuario logueado es 1, lo cual quiere decir que es administrador
 */
function esAdmin() {
	if (isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1){
		return true;
	}else{
		return false;
	}
}


/**
 * comprueba si el nivel del usuario cuya id se pasa como argumento es o no admin
 * @param unknown $id_usuario
 */
function esAdminElUsuario($id_usuario){
	$connection = Database::getConnection();
	$query = "SELECT usuarios.id_tipo FROM usuarios WHERE usuarios.id_usuario = '".$id_usuario."'";
	if ($result_object = $connection->query($query)){
		$resultado = $result_object->fetch_array(MYSQLI_ASSOC);
		if ($resultado['id_tipo'] == 1){
			return true;
		}else{
			return false;
		}
	}
}

/**
 * crea, a partir de acceder a distingas variables globales 
 * una string que sería igual a la url en la que hacemos la petición
 */
function pillaURL(){
	$url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
	return $url;
}

/**
 * para tener solo el primero nombre de usuario para mostrar si el usuario está logueado
 * corto la string y tomo solo el primer valor
 * @param unknown $nombre
 */
function cortarNombre($nombre){
	$string = explode(' ', $nombre);
	return $string['0'];
}



/**
 * addToCart()
 */

function addToCart(){
	
	if (!estaLogueado()){
		$results = array('' , 'Debes estar logueado para añadir artículos al carrito');
		return $results;
	}else{
		//si el producto ya está en el carrito
		if (Carrito::estaEnCarrito($_GET['id_articulo'])){
			
			//no se puede volver a meter
			$results = array('addToCart', 'El artículo ya está en tu carrito','');
			return $results;
		}else{
			
			$items = array(
					'id_producto'	=> (int) $_GET['id_articulo'],
					'id_usuario' 	=> (int) $_SESSION['id_usuario']
			);
			
			$cart = new Carrito($items);
			$results = $cart->addArticuloACarrito();
			return $results;
		}
		
		return $results;
		
	}
	
	return $results;
}


/**
 * obtiene la cantidad de filas de una tabla
 * @param string $tabla
 */
function hallarNumeroRegistros($tabla){
	$connection = Database::getConnection();
	$query = "SELECT COUNT(*) FROM $tabla";
	//echo $query;
	$result_obj = $connection->query($query);
	if ($row = $result_obj->fetch_array(MYSQLI_NUM)){

		return $row['0'];
	}

}

/**
 * toma el precio del producto y devuelve su precio 
 * actual con el correspondiente descuento
 * @param unknown $precio
 * @param unknown $descuento
 */
function CalculaDescuento($precio, $descuento){
	$precioFinal = $precio - (($precio * $descuento) / 100);
	return $precioFinal;
}


function realizaCompra(){
	$id_producto = $_POST['id_producto'];
	$unidades = $_POST['unidades'];
	$id_usuario = $_SESSION['id_usuario'];
	$coste_total = $_POST['precioFinal'];
	
;
	Compra::addCompra($id_usuario, $id_producto, $unidades, $coste_total);
	Carrito::borraCarrito('carritos' , $id_producto);
	
}

function resetPassword(){
	$email = $_POST['email'];
	//echo $email;
	if (Usuario::existeEmail($email)){
		// ya pasamos a resetear
		Usuario::resetPass($email);
		$return = array('', 'Se ha enviado el nuevo password a la dirección de correo electrónico indicada', '');
		return $return;
			
			
	}else{
		$return = array('', 'La dirección de correo electrónico proporcionada no está registrada en esta web' ,''); 
		return $return;
	}
	
	
}



function formateaString($string){
	if (strlen($string) > 29){
		$string = substr($string, 0 , 32) . '...';
	}else{
		return $string;
	}
	return $string;
}



function tieneSoloLetras($nombre){
	$soloLetras = true;
	for ($i = 0; $i < strlen($nombre) ; $i ++){
		if (is_numeric($nombre[$i])){
			$soloLetras = false;
		}
	}
	return $soloLetras;
}


function esValidoElPass($password){
	if (strlen($password) >= 8 ){
		$valido = true;
	}else{
		$valido = false;
	}
	return $valido;
}




/**
 * subir foto()
 * 
 * sube la foto seleccionada en el formulario de productos
 * al servidor web, medianten una conexión al servidor ftp
 */
function subirFoto(){
	if (is_uploaded_file($_FILES['foto']['tmp_name'])){
		//$host = "cobshop.sytes.net";
		$host = "localhost";
		//$port = 21;
		$user = 'jacobo';
		$password = 'jacmorram';
		$ruta = '/var/www/cobshop.sytes.net/images/productos/';
	
		//conectamos con el servidor
	
		$conn_id = ftp_connect($host);
		if ($conn_id){
	
			if (@ftp_login($conn_id, $user, $password)){
					
				if (@ftp_chdir($conn_id, $ruta)){
	
					if (@ftp_put($conn_id, $_FILES['foto']['name'], $_FILES['foto']['tmp_name'], FTP_BINARY)){
							
						//echo 'archivo subido correctamente';
					}else{
						//echo 'no ha sido posible subir el fichero';
					}
	
	
				}else{
					//echo 'no existe el directorio';
				}
					
			}else{
				//echo 'el usuario o contraseña no son correctos';
			}
			ftp_close($conn_id);
		}else{
			//echo ' no ha sido posible conectar con el servidor';
		}
	
	
	}else{
		//echo 'selecciona un arhivo';
	}
}


