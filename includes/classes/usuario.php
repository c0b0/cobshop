<?php

/**
 * usuario.php
 *
 * Archivo para la clase usuario
 * @author 	Cobo Morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 */

class Usuario{
	
	//propiedades
	
	/**
	 * id_usuario
	 */
	protected $id_usuario;
	/*
	 * Nombre del usuario
	 * */
	protected $nombre;
	/*dirección de email del usuario
	 * 
	 */
	protected $email;
	/*
	 * password del usuario
	 * */
	protected $password;
	/*
	 * dirección del usuario*/
	protected $direccion;
	/*
	 * provincia del usuario*/
	protected $provincia;
	/*
	 * ciudad del usuario
	 */
	protected $ciudad;
	/*
	 * codigo postal del usuario
	 */
	protected $codigo_postal;
	/*
	 * teléfono del usuario
	 */
	protected $telefono;
	/*
	 * id del nivel de usuario
	 * 1=Admin | 2 = Usuario normal
	 */
	protected $id_tipo;
	/**
	 * devuelve el nivel del usuario
	 * @var string
	 */
	protected $tipo;
	
	
	/*
	 * Constructor de objetos de la clase Usuario
	 * @param array 
	 * */
	public function __construct($input = false){
		if (is_array($input)){
			foreach ($input as $key => $val) {
				$this->$key = $val;
			}
		}
	}
	
	/*
	 * devuelve el id del usuario
	 * @return int
	 */
	public function getId_usuario(){
		return $this->id_usuario;
	}
	/*
	 * devuelve el nombre del usuario
	 * @return string
	 */
	public function getNombre(){
		return $this->nombre;
	}
	/*
	 * devuelve el emaildel usuario
	 * @return string
	 */
	public function getEmail(){
		return $this->email;
	}
	
	/*
	 * devuelve el password del usuario
	 * @return string
	 */
	public function getPassword(){
		return $this->password;
	}
	
	/*
	 * devuelve la dirección del usuario
	 * @return string
	 */
	public function getDireccion(){
		return $this->direccion;
	}
	
	/*
	 * devuelve el nombre la provincia del usuario
	 * @return string
	 */
	public function getProvincia(){
		return $this->provincia;
	}
	
	/*
	 * devuelve el nombre de la ciudad del usuario
	 * @return string
	 */
	public function getCiudad(){
		return $this->ciudad;
	}
	
	/*
	 * devuelve el codigo postal del usuario
	 * @return string
	 */
	public function getCodigo_postal(){
		return $this->codigo_postal;
	}
	
	/*
	 * devuelve el teléfono del usuario
	 * @return string
	 */
	public function getTelefono(){
		return $this->telefono;
	}
	
	/*
	 * devuelve el tipo de usuario
	 * (en realidad devuelve la clave foránea 
	 * que hace referencia a la clave de la tabla tipo)
	 * 1 = Admin
	 * 2 = Usuario normal
	 * @return int
	 */
	public function getId_tipo(){
		return $this->id_tipo;
	}
	/**
	 * devuelve el nivel del usuario
	 * @return string
	 */
	public function getTipo(){
		return $this->tipo;
	}
	
	
	/**
	 * devuelve un array de objetos de la clase usuario
	 * @return string|unknown|boolean
	 */
	static function getUsuarios(){
		//limpia los resultados
		$items = '';
		//crea la conexión a la bbdd
		$connection = Database::getConnection();
		//crea la consulta
		$query = "SELECT usuarios.id_usuario, usuarios.nombre, usuarios.email, usuarios.password, usuarios.direccion, usuarios.provincia, usuarios.ciudad, usuarios.codigo_postal, usuarios.codigo_postal, usuarios.telefono, usuarios.id_tipo, tipos.id_tipo, tipos.tipo 
				FROM usuarios 
				INNER JOIN tipos 
				ON usuarios.id_tipo = tipos.id_tipo;
		; ";
		//ejecuta la consulta
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_object('Usuario')){
				$items[] = $result;
			}
			return ($items);
		} catch (Exception $e) {
			return false;
		}
	
	}
	
	
	/**
	 * devuelve un objeto de la clase usuario
	 * @param unknown $id
	 * @return Objeto Usuario
	 */
	static function getUsuarioPorId($id){
		//limpia los resultados
		$item = '';
		//crea la conexión a la bbdd
		$connection = Database::getConnection();
		//crea la consulta
		$query = "SELECT * FROM `usuarios` WHERE id_usuario = '". $id ."'";
		
		//ejecuta la consulta
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_object('Usuario')){
				$item = $result;
			}
			return ($item);
		} catch (Exception $e) {
			return false;
		}
		
	}
	
	
	/**
	 * verifyInput()
	 * compruea que los campos requeridos están rellenos.
	 * devuelve false si hay algún error
	 */
	protected function _verifyInput(){
		$error = false;
		if (!trim($this->nombre)){
			$error = true;
		}
		$error = false;
		if (!trim($this->password)){
			$error = true;
		}
		if (!trim($_POST['password2'])){
			$error = true;
		}
		$error = false;
		if (!trim($this->email)){
			$error = true;
		}
		$error = false;
		if (!trim($this->direccion)){
			$error = true;
		}
		$error = false;
		if (!trim($this->ciudad)){
			$error = true;
		}
		$error = false;
		if (!trim($this->codigo_postal)){
			$error = true;
		}
		$error = false;
		if (!trim($this->provincia)){
			$error = true;
		}		
		if ($error){
			return false;;
		}else{
			return true;
		}
		
	}
	

	
	
	
	/**
	 * comprueba si el artículo ya se encuentra en el carrito del usuario
	 * @param int $id_producto
	 */
	static function yaExisteElEmail($email){
		$connection = Database::getConnection();
		$query = "SELECT * FROM usuarios WHERE usuarios.email = '". $_POST['email'] ."'";
		
		$result_obj = $connection->query($query);
		$encontrado = false;
		$i = 0;
		while ( $i <= $result_obj->num_rows && !$encontrado){
			$row = $result_obj->fetch_array(MYSQLI_BOTH);
			if ($row['email'] == $email){
				$encontrado = true;
				//echo 'encontrado <br/>';
				return $encontrado;
			}
			$i ++;
		}
		return $encontrado;
	}
	
	
	static function existeEmail($email){
		$connection = Database::getConnection();
		$query = "SELECT * FROM usuarios";
		
		$result_obj = $connection->query($query);
		$encontrado = false;
		$i = 0;
		while ( $i <= $result_obj->num_rows && !$encontrado){
			$row = $result_obj->fetch_array(MYSQLI_BOTH);
			if ($row['email'] == $email){
				$encontrado = true;
				//echo 'encontrado <br/>';
				return $encontrado;
			}
			$i ++;
		}
		return $encontrado;
	}
	
	
	/**
	 * addUsuario()
	 * verifica que están los datos necesarios,
	 * conecta con la base de datos, prepara los datos
	 * e inserta los datos en la tabla
	 */
	public function addUsuario(){

		//verifica los campos		
		if ($this->_verifyInput()){
			

			//voy comprobando si todo está correcto
			//si ya existe el mail
			if($this->yaExisteElEmail($this->getEmail())){
				$return = array('' , 'El mail ya está registrado');
				return $return;
			}
			if (!tieneSoloLetras($this->getNombre())){
				$return = array('','El nombre solo puede incluir letras','');
				return $return;
			}
			
			if(!esValidoElPass($this->getPassword())){
				$return = array('','El password debe tener al menos 8 caracteres','');
				return $return;
			}
			
			//si los pass no coinciden
			if($this->getPassword() !== $_POST['password2']){
				$return = array('', 'Los passwords no coinciden');
				return $return;
			}
			
			if ($this->getId_tipo() == 0){
				$return = array('','Debes elegir un nivel de usuario','');
				return $return ;
			}
			
			//si el cp no es número
			if (!is_numeric($this->codigo_postal)){
				$return = array('', 'El código postal no puede llevar letras' , '');
				return $return;
			}
			

			
			//conecta con la base de datos
			$connection = Database::getConnection();
			
			//prepara los datos
			$query = "INSERT INTO usuarios
					(nombre, email, password, direccion, provincia, ciudad, codigo_postal, telefono, id_tipo) 
					VALUES 
					('".strtolower(Database::prep($this->nombre))."', '". strtolower(Database::prep($this->email)) ."', '". encriptarPassword(Database::prep($this->password))."', '".strtolower(Database::prep($this->direccion))."', '".strtolower(Database::prep($this->provincia))."', '". strtolower(Database::prep($this->ciudad))."', '".Database::prep($this->codigo_postal)."', '".Database::prep($this->telefono)."',".Database::prep($this->id_tipo).")";
			
			//lanza la sql
			if ($connection->query($query)){
				//$return = array('', 'Usuario añadido correctamente.', '');
				//se envia el mensaje indicando que se ha añadido el usuario
				
				//finalmente envío un correo al usuario
				$correo = new Correo();
				$correo->enviarMailRegistro($this->nombre, $this->email);
				$return = array('', 'Usuario añadido correctamente.', '', '<br/> Se ha enviado un correo de confirmación a la cuenta proporcionada');
				return $return;
			}else{
				//se envia un mensaje indicando que no se ha podido añadir el usuario
				//y redirecciona a mant_usuarios
				$return = array('mant_usuarios' , 'No se ha podido añadir el usuario', '');
				return $return;
			}
			
		}else{
			//se envía un mensaje indicando que no se ha podido añadir el usuario
			//en este caso la razón es qu falta inforación requerida
			//luego redirecciona a mant_usuarios
			$return = array('mant_usuarios', 'No se ha podido añadir el usuario. Falta información requerida para el proceso','');
			return $return;
		}
	}
	
	/**
	 * editUsuario()
	 * toma los datos y realiza los cambios sobre un registro ya existente
	 */
	
	public function editUsuario(){
		//verifica los campos
		if ($this->getPassword() && $_POST['password2']){
			
			if ($this->getPassword() == $_POST['password2']){
				
				if ($this->_verifyInput()){
						
						
						
					//conecta con la base de datos
					$connection = Database::getConnection();
						
					//prepara el 'preparad statement'
					$query = "UPDATE usuarios
						SET nombre=?,
						email=?,
						password=?,
						direccion=?,
						provincia=?,
						ciudad=?,
						codigo_postal=?,
						telefono=?,
						id_tipo=?
						WHERE id_usuario =?";
					$statement = $connection->prepare($query);
					//enlaza los parámetros
					$statement->bind_param('ssssssssii', strtolower($this->nombre), strtolower($this->email), encriptarPassword($this->password), strtolower($this->direccion), strtolower($this->provincia), strtolower($this->ciudad), $this->codigo_postal, $this->telefono, $this->id_tipo, $this->id_usuario);
						
					if ($statement){
						$statement->execute();
						$statement->close();
						//añade mensaje indicando que todo ha ido bien
						$return = array('', 'Usuario editado correctamente.', '');
						return $return;
					}else{
						$return = array('mant_usuarios', 'No se ha podido editar el usuario', (int)$this->id_usuario);
				
						return $return;
					}
						
				}
				
				
			}else{
				$return = array('' , 'Los passwords no coinciden' );
				return $return;
			}
			
			
		}
		//aquí no se edita el pass
		if ($this->_verifyInput()){
				
			//conecta con la base de datos
			$connection = Database::getConnection();
			
			//prepara el 'preparad statement'
			$query = "UPDATE usuarios
						SET nombre=?, 
						email=?,
						direccion=?, 
						provincia=?, 
						ciudad=?, 
						codigo_postal=?, 
						telefono=?, 
						id_tipo=?
						WHERE id_usuario =?";
			$statement = $connection->prepare($query);
			//enlaza los parámetros
			$statement->bind_param('sssssssii', strtolower($this->nombre), strtolower($this->email), strtolower($this->direccion), strtolower($this->provincia), strtolower($this->ciudad), $this->codigo_postal, $this->telefono, $this->id_tipo, $this->id_usuario);
			
			if ($statement){
				$statement->execute();
				$statement->close();
				//añade mensaje indicando que todo ha ido bien
				$return = array('', 'Usuario editado correctamente.', '');
				return $return;
			}else{
				$return = array('mant_usuarios', 'No se ha podido editar el usuario', (int)$this->id_usuario);
				
				return $return;
			}
			
		}
	}
	
	/**
	 * borra el usuario
	 * @param unknown $tabla
	 * @param unknown $id
	 */
	static function borrarUsuario($tabla, $id){
		$connection = Database::getConnection();
		$query = "DELETE FROM $tabla WHERE id_usuario = $id";
		if ($connection->query($query)){
			$_SESSION['message'] = 'Registro borrado';
			header("location: index.php?content=usuarios"); 
		}
	}
	
	
	/**
	 * realiza el proceso de logueo del usuario
	 * @param unknown $email
	 * @param unknown $password
	 * @return string[]
	 */
	static function login($email, $password){
		$connection = Database::getConnection();
		$query = "SELECT * FROM usuarios 
					WHERE usuarios.email = '".$email."' ";
				
		$result_obj = '';
		$result_obj = $connection->query($query);
		
		
		
		if ($row = $result_obj->fetch_array(MYSQLI_ASSOC)){
			//echo 'Aquí pasamos todo a $result' . '<br />';
			//echo 'El nombre de este usuario es: ' . $row['nombre'] . '<br />';
			//echo 'El nivel de usuario es : ' . $row['id_tipo'] . '<br />';
			$_SESSION['pass1'] = encriptarPassword($password);
			$_SESSION['pass2'] = $row['password'];
			if (encriptarPassword($password) !== $row['password']){
				$return = array('','La combinacion de User y Password es incorrecta');
				return $return;
				
			}else{
				
				$_SESSION['id_usuario'] = $row['id_usuario'];
				$_SESSION['user'] = $row['nombre'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['nivel'] = $row['id_tipo'];
				header("location: index.php?content=administracion");
			}
		}
	}
	
	/**
	 * devuelve un array de objetos de la clase usuario
	 * en un rango determinado
	 * @return string|unknown|boolean
	 */
	static function getUsuariosParaPaginacion($pag, $offset, $limit, $order){
		
		if($pag == 1){
			$offset = 0;
		}else{
			$offset = ($pag - 1) * $offset;
		}
		//echo 'El número de esta página de productos es ' . $pag . '<br />' ;
		//echo 'el offset es: ' . $offset . '<br />';
		//limpia los resultados
		$items = '';
		//crea la conexión a la bbdd
		$connection = Database::getConnection();
		//crea la consulta
		$query = "SELECT usuarios.id_usuario, usuarios.nombre, usuarios.email, usuarios.password, usuarios.direccion, usuarios.provincia, usuarios.ciudad, usuarios.codigo_postal, usuarios.codigo_postal, usuarios.telefono, usuarios.id_tipo, tipos.id_tipo, tipos.tipo
					FROM usuarios
					INNER JOIN tipos
					ON usuarios.id_tipo = tipos.id_tipo 
					ORDER BY $order
					LIMIT  ".$limit."
					OFFSET  ".$offset."
					";	
		//ejecuta la consulta
		
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_object('Usuario')){
				$items[] = $result;
			}
			return ($items);
		} catch (Exception $e) {
			return false;
		}
	
	}
	
	
	
	/**
	 * resetPass()
	 * 
	 * envía un password aleatorio al mail indicado
	 * para crear el password genero un número aleatorio entre 1 y 1000
	 * lo paso por un algoritmo de encriptación
	 * y finalmente lo corto en 8 caracteres
	 * @param string $email
	 */
	static function resetPass($email){
		
			$salt = rand(1,1000);
			$nuevoPassword = sha1($salt . $email);
			$nuevoPassword = substr($nuevoPassword, 0, 8);
			$passEncriptado = encriptarPassword($nuevoPassword);
			$connection = Database::getConnection();
			//echo $nuevoPassword . '<br />';
			$query = "UPDATE usuarios 
					SET usuarios.password = '".$passEncriptado."' 
					WHERE usuarios.email = '".$email."'";
			
			if ($connection->query($query)){
				//echo 'reseteado correctamente';
				$nuevoCorreo = new Correo();
				if ($nuevoCorreo->enviarMailReseteoPassword($nuevoPassword, $email)){
					return $return;
				}
			}else{
				echo 'no se ha reseteado';
			}
			
		
	}
	
	
}