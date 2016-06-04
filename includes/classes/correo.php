<?php

/**
 * correo.php
 *
 * Archivo para la clase correo
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */




require_once('phpmailer/class.phpmailer.php');
require_once('phpmailer/class.smtp.php');

class Correo{
	public $email;
	public $firma; //aquí meteré el html para la firma del mensaje 
		
	
	/**
	 * constructor para objetos de la clase correo
	 */
	public function __construct(){
		$this->email = new PHPMailer();
		$this->email->isSMTP();
		//$this->email->SMTPDebug = 2;
		$this->email->SMTPAuth = true;
		$this->email->SMTPSecure = "ssl";
		$this->email->Host = "smtp.gmail.com";
		$this->email->Port = 465;
		
		$this->email->Username = "cobshop.compraonline@gmail.com";
		$this->email->Password = "00_CobShop_00";
		
		$this->email->setFrom("cobshop.compraonline@gmail.com");
		$this->email->addReplyTo("cobshop.compraonline@gmail.com");
		
		
		
	}
	
	
	/**
	 * enviarMailRegistro()
	 * envía un correo al registrar un usuario
	 * @param string $nombre
	 * @param string $email
	 */
	public function enviarMailRegistro($nombre, $email){
		$imagen = "https://dl.dropboxusercontent.com/u/44402299/cabecera.png";
		//$address = "coblion@gmail.com"; // <- esto para las pruebas
		$address = $_POST['email']; //<- descomentar al poner en marcha la web
		$nombre = ucfirst($nombre);
		$this->email->Subject = "Confirmación registro en CobShop";
		$this->email->msgHTML("
				<htlm>
				<head>
				<style>
				html{
				font-size:100%;
				}
				body{
				font-size:1.5em;
				}
				</style>
				</head>
				<body style'font-size:14px; '>
					
					<h2>Saludos {$nombre}. Tu registro en CobShop ha sido completado</h2>
					<ul>
						<li>Compra desde casa</li>
						<li>Al mejor precio</li>
						<li>Envíos a todo Schamann y Escaleritas</li>
					</ul>
				
					<img src='{$imagen}'>
				</body>
				
				</html>");
		
		$this->email->addAddress($address, "cobo morera");
		
		if(!$this->email->send()){
			echo "error al enviar";
		}else{
			//echo "mensaje enviado";
		}
	}
	
	
	/**
	 * enviarMailCompraEnviada()
	 * envia un mail al comprar un producto
	 */
	public function enviarMailCompraEnviada(){
		$address = $_SESSION['email'];
		$this->email->Subject = "Tu pedido ha sido enviado";
		$this->email->msgHTML("
				<htlm>
				<head>
				<body>
				
					<p>Saludos. Tu pedido ha sido enviado</p>
				
					<img src='{$imagen}'>
				
				
				</body>
				</head>
				</html>");
	
		$this->email->addAddress($address, "cobo morera");
	
		if(!$this->email->send()){
			echo "error al enviar";
		}else{
			echo "mensaje enviado";
		}
	}
	
	
	
	public function enviarMailCompraRealizada($id_producto, $unidades, $coste_total){
		$idUser = $_SESSION['id_usuario'];
		$connection = Database::getConnection();
		$query = "SELECT productos.foto, productos.producto, productos.precio, productos.descuento FROM productos WHERE productos.id_producto = $id_producto";
		if ($result_obj = $connection->query($query)){
			$producto = $result_obj->fetch_array(MYSQLI_ASSOC);
			$imagenProducto = $producto['foto'];
			$nombreProducto = ucwords($producto['producto']);
			$precioProducto = $producto['precio'];
			$descuentoProducto = $producto['descuento'];
		};
		
		$query = "SELECT * FROM usuarios WHERE usuarios.id_usuario = $idUser ";
		//echo $query;
		if ($result_obj = $connection->query($query)){
			$datosUsuario = $result_obj->fetch_array(MYSQLI_ASSOC);
			$direccion = ucwords($datosUsuario['direccion']);
			$cp = $datosUsuario['codigo_postal'];
			$ciudad = ucwords($datosUsuario['ciudad']);
			$provincia = ucfirst($datosUsuario['provincia']);
		}
		
		$imagen = "https://dl.dropboxusercontent.com/u/44402299/cabecera.png";
		$address = "coblion@gmail.com";
		$usuario = ucfirst($_SESSION['user']);
		$this->email->Subject = "Tu pedido - $nombreProducto ha sido completado";
		$this->email->msgHTML("
				<htlm>
				<head>
				<link rel='stylesheet' type='text/css' href='http://cobshop.sytes.net/css/style.css'>
				<style>
				body{
					font-weight:bold;	
				}
				</style>
				<body>
	
				<h2>Saludos $usuario, tu compra de $nombreProducto ha sido realizada</h2>
				<img src= 'http://cobshop.sytes.net/images/productos/".$imagenProducto."'>
				<hr/>
				<table style='font-weight:bold; font-size:16px; width:450px; text-align:center' id='pr_pago'>
				<tr><td style='background-color:orange'>$unidades</td><td style='background-color:orange'>x</td><td style='background-color:orange'>$nombreProducto</td><td style='background-color:orange'>$precioProducto €</td><td style='background-color:orange'>$descuentoProducto %</td><td style='background-color:orange'>$coste_total €</td></tr>
				<tr><td></td><td></td><td></td><td></td><td style='background-color:orange'>Total:</td><td style='background-color:orange'>$coste_total €</td></tr>
				<tr></tr>
				</table>
				
				<h2>Dirección de entrega: <br/>
				$direccion<br/>
				$ciudad<br/>
				$cp <br/>
				$provincia<br/>
				</h2>
				<hr />
				
		
				<hr/>
				<img src='{$imagen}'>
	
	
				</body>
				</head>
				</html>");
	
		$this->email->addAddress($address, "cobo morera");
	
		if(!$this->email->send()){
			//echo "error al enviar";
		}else{
			//echo "mensaje enviado";
		}
	}
	
	
	public function enviarMailReseteoPassword($nuevoPassword, $email){
		$imagen = "https://dl.dropboxusercontent.com/u/44402299/cabecera.png";
		$address = $email;
		$this->email->Subject = "Reseteo password en Cobshop.sytes.net";
		$this->email->msgHTML("
				<htlm>
				<head>
				<style>
				html{
				font-size:100%;
				}
				body{
				font-size:1.2em;
				}
				</style>
				</head>
				<body style'font-size:12px; '>
					
				<h2>Saludos. A petición tuya hemos reseteado tu password</h2>
				<h2>Tu nuevo password es: <br/>
				$nuevoPassword
				</h2>
				<hr/>
				<img src='{$imagen}'>
				</body>
	
				</html>");
	
		$this->email->addAddress($address, "cobo morera");
	
		if(!$this->email->send()){
			echo "error al enviar";
		}else{
			//echo "mensaje enviado";
		}
	}
	
	
	

	
}

	
	





?>