<?php

/**
 * producto.php
 *
 * Archivo para la clase producto
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */




class Producto {
	
	//propiedades
	
	/*
	 * id del producto
	 */
	protected $id_producto;
	/*
	 * nombre del producto
	 */
	protected $producto;
	/*
	 * características del producto
	 */
	protected $caracteristicas;
	/*
	 * precio del producto
	 */
	protected $precio;
	/*
	 * stock en tienda
	 */
	protected $stock;
	/*
	 * nombre y extensión del archivo de imagen
	 */
	protected $foto;
	/*
	 * descuento
	 */
	protected $descuento;
	/*
	 * id de la categoría a la que pertenece el producto
	 */
	protected $id_categoria;
	/*
	 * nombre de la categoría a la que pertenece el producto
	 */
	protected $categoria;
	
	
	/**
	 * constructor de objetos de la clase compra
	 * @param array $input
	 */
	public function __construct($input = false){
			if (is_array($input)){
				foreach ($input as $key => $val) {
					
					$this->$key = $val;
				}
			}
		}
	
	
	/**
	 * devuelve la id del producto
	 * @return int
	 */
	public function getId_producto(){
		return $this->id_producto;
	}
	/**
	 * devuelve el nombre del producto
	 * @return string
	 */
	public function getProducto(){
		return $this->producto;
	}
	
	/**
	 * devuelve un texto que expresa algunas características
	 * del producto
	 * @return string
	 * 
	 */
	public function getCaracteristicas(){
		return $this->caracteristicas;
	}
	
	/**
	 * devuelve el precio del producto
	 * @return int
	 */
	public function getPrecio(){
		return $this->precio;
	}
	
	/**
	 * devuelve el stock del producto que 
	 * queda en la tienda
	 * @return int
	 */
	public function getStock(){
		return $this->stock;
	}
	
	/**
	 * devuelve el nombre y la extensión del archivo 
	 * de imagen que señala la foto dle producto
	 * @return string
	 */
	public function getFoto(){
		return $this->foto;
	}
	
	/**
	 * devuelve el descuento de este producto
	 */
	public function getDescuento(){
		return $this->descuento;
	}
	
	/**
	 * devuelve la id de la catgoría a la que 
	 * pertenece el producto
	 */
	public function getId_categoria(){
		return $this->id_categoria;
	}
	/**
	 * devuelve la categoria
	 */
	public function getCategoria(){
		return $this->categoria;
	}
	
	/**
	 * devuelve un array con el resultado de la consulta que incluye el método
	 * la consulta devuelve una serie de filas que incluyen todos los productos 
	 * y su categoría
	 * @return array
	 */
	static function getProductos(){
		//limpia los resultados
		$items = '';
		//crea la conexión a la bbdd
		$connection = Database::getConnection();
		//crea la consulta
		$query = "SELECT productos.id_producto, productos.producto, productos.precio, categorias.categoria, productos.stock, productos.foto, productos.descuento, productos.id_categoria
					FROM productos
					INNER JOIN categorias
					ON productos.id_categoria = categorias.id_categoria
					ORDER BY id_producto";
		//ejecuta la consulta
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_object('Producto')){
				$items[] = $result;
			}
			return ($items);
		} catch (Exception $e) {
			return false;
		}
	
	}
	
	
	/**
	 * devuelve un array con el resultado de la consulta que incluye el método
	 * la consulta devuelve una serie de filas que incluyen todo los productos
	 * que se incluyen en una categoría concreta
	 * @param $string -> categoria de los productos
	 * @return array
	 */
	static function getProductos_por_categoria($categoria){
		//limpia los resultados
		$items = '';
		//crea la conexión a la bbdd
		$connection = Database::getConnection();
		//crea la consulta
		$query = "SELECT productos.id_producto, productos.producto, productos.caracteristicas, productos.precio, productos.stock, productos.foto, productos.descuento, productos.id_categoria, categorias.id_categoria, categorias.categoria from productos INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria WHERE categorias.categoria = '".$categoria."'";
		//ejecuta la consulta
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_object('Producto')){
				$items[] = $result;
			}
			return ($items);
		} catch (Exception $e) {
			return false;
		}
	
	}
	
	/**
	 * devuelve un array con el resultado de la consulta que incluye el método
	 * la consulta devuelve un único producto, según la id proporcionada
	 * @param int -> id
	 * @return array
	 */
	static function getProductoPorId($id){
		//limpia los resultados
		$item = '';
		//crea la conexión a la bbdd
		$connection = Database::getConnection();
		//crea la consulta
		$query = "SELECT productos.id_producto,productos.producto,productos.caracteristicas,productos.precio,productos.stock,productos.foto,productos.descuento,categorias.categoria
					FROM productos
					INNER JOIN categorias
					ON
					categorias.id_categoria = productos.id_categoria
					WHERE productos.id_producto = '".$id."'";
		//ejecuta la consulta
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_object('Producto')){
				$item = $result;
			}
			return ($item);
			
		} catch (Exception $e) {
			return false;
		}
	
	}
	
	
	/**
	 * devuelve un array con el resultado de la consulta que incluye el método
	 * la consulta devuelve un único producto, según la id proporcionada
	 * @param int -> id
	 * @return array
	 */
	static function getProductoPorIdParaCarrito($id){
		//limpia los resultados
		$item = '';
		//crea la conexión a la bbdd
		$connection = Database::getConnection();
		//crea la consulta
		$query = "SELECT * FROM productos WHERE productos.id_producto =  '". $id ."'";
		//ejecuta la consulta
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_object('Producto')){
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
		if (!trim($this->producto)){
			$error = true;
		}
		$error = false;
		if (!trim($this->id_categoria)){
			$error = true;
		}
		if ($error){
			return false;;
		}else{
			return true;
		}
	
	}
	
	
	
	/**
	 * addProducto()
	 * verifica que están los datos necesarios,
	 * conecta con la base de datos, prepara los datos
	 * e inserta los datos en la tabla
	 */
	
	public function addProducto(){
		//verifica los campos
		if ($this->_verifyInput()){
				
			//conecta con la base de datos
			$connection = Database::getConnection();
				
			//prepara los datos
			$query = "INSERT INTO productos 
					(producto, caracteristicas, precio, stock, foto, descuento, id_categoria) 
					VALUES 
					('". strtolower(Database::prep($this->getProducto()))."','".Database::prep($this->getCaracteristicas())."', ".Database::prep($this->getPrecio()).", ".Database::prep($this->getStock()).", '".Database::prep($this->getFoto())."', ".Database::prep($this->getDescuento()).", ".Database::prep($this->getId_categoria()).")";
				
			//lanza la sql
			//echo $query;
			if ($connection->query($query)){
				subirFoto();
				$return = array('', 'Producto añadido correctamente.' , '');
				//se envia el mensaje indicando que se ha añadido el usuario
				return $return;
			}else{
				//se envia un mensaje indicando que no se ha podido añadir el usuario
				//y redirecciona a mant_usuarios
				$return = array('mant_productos' , 'No se ha podido añadir el producto' , '');
				return $return;
			}
				
		}else{
			//se envía un mensaje indicando que no se ha podido añadir el usuario
			//en este caso la razón es qu falta inforación requerida
			//luego redirecciona a mant_usuarios
			$return = array('mant_productos', 'No se ha podido añadir el productos. Falta información requerida para el proceso' ,'');
			return $return;
		}
	}
	
	
	/**
	 * editProducto()
	 * toma los datos y realiza los cambios sobre un registro ya existente
	 */
	public function editProducto(){
		//verifica los campos
		if ($this->_verifyInput()){
	
			//conecta con la base de datos
			$connection = Database::getConnection();
	
			//prepara el 'preparad statement'
			$query = "UPDATE productos
						SET producto=?,
						caracteristicas=?,
						precio=?,
						stock=?,
						foto=?,
						descuento=?,
						id_categoria=?
						WHERE id_producto=?";
			$statement = $connection->prepare($query);
			//enlaza los parámetros
			$statement->bind_param('ssiisiii', strtolower($this->producto),strtolower($this->caracteristicas),$this->precio,$this->stock,$this->foto,$this->descuento,$this->id_categoria, $this->id_producto );
	
			if ($statement){
				$statement->execute();
				$statement->close();
				subirFoto();
				//añade mensaje indicando que todo ha ido bien
				$return = array('', 'Producto editado correctamente.', '');
				return $return;
			}else{
				$return = array('mant_productos', 'No se ha podido editar el producto', (int)$this->id_producto);
				
				return $return;
			}
	
		}
	}
	
	static function borrarProducto($tabla, $id){
		$connection = Database::getConnection();
		$query = "DELETE FROM $tabla WHERE id_producto = $id";
		if ($connection->query($query)){
			$_SESSION['message'] = 'Registro borrado';
			header("location: index.php?content=productos");
		}
	}
	
	
	/**
	 * getProductosParaPaginacion()
	 * devuelve un array con el resultado de la consulta que incluye el método
	 * la consulta devuelve una serie de filas que incluyen todos los productos
	 * y su categoría
	 * El atributo $offset indica el número de registros por página que quiero que se muestren
	 * 
	 * Como ejemplo, si el offset fuera 6 (porque quiero ver 6 registros por pagina)
	 * en la página 1, el offset será 0
	 * en la siguiente el offset será 6
	 * en la siguiente el offset será 12
	 * y así...
	 * 
	 * @return array
	 * @param int $pag
	 * @param int $offset
	 * 
	 */
	static function getProductosParaPaginacion($pag, $offset, $limit){
		 
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
		$query = "SELECT productos.id_producto, productos.producto, productos.precio, categorias.categoria, productos.stock, productos.foto, productos.descuento, productos.id_categoria
					FROM productos
					INNER JOIN categorias
					ON productos.id_categoria = categorias.id_categoria
					
					ORDER BY id_producto DESC
					LIMIT ". $limit."
					OFFSET ". $offset ."
					";
		//ejecuta la consulta
		//echho $query;
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_object('Producto')){
				$items[] = $result;
			}
			return ($items);
		} catch (Exception $e) {
			return false;
		}
	
	}
	
	
	
	/**
	 * getProductos_por_categoria_ParaPaginacion($pag
	 * devuelve un array con el resultado de la consulta que incluye el método
	 * la consulta devuelve una serie de filas que incluyen todos los productos
	 * y su categoría
	 * @return array
	 * @param int $pag
	 * la 1 es offset 0
	 * la 2 es offset 6
	 * la 3 es offset 12
	 */
	static function getProductos_por_categoriaParaPaginacion($categoria, $pag){
		if ($pag == 1){
			$offset = 0;
		}else{
			$offset = ($pag - 1) * 3; 
		}
		//limpia los resultados
		$items = '';
		//crea la conexión a la bbdd
		$connection = Database::getConnection();
		//crea la consulta
		$query = "SELECT productos.id_producto, productos.producto, productos.caracteristicas, productos.precio, productos.stock, productos.foto, productos.descuento, productos.id_categoria, categorias.id_categoria, categorias.categoria 
					FROM productos 
					INNER JOIN categorias 
					ON productos.id_categoria = categorias.id_categoria
					WHERE categorias.categoria = '".$categoria."'
					ORDER BY productos.id_producto DESC
					LIMIT 3
					OFFSET ". $offset ."
					";
		//ejecuta la consulta
		//echo $query . '<br />';
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_object('Producto')){
				$items[] = $result;
			}
			return ($items);
		} catch (Exception $e) {
			return false;
		}
	
	}
	
	
	static function restaStock($id_producto, $unidades){
		$connection = Database::getConnection();
		$query = "SELECT * FROM productos WHERE productos.id_producto = $id_producto";
		//echo $query . '<br />';
		$result_obj = $connection->query($query);
		$result = $result_obj->fetch_array(MYSQLI_ASSOC);
		$stockProducto = $result['stock'];
		
		$query = "UPDATE productos SET productos.stock = $stockProducto - $unidades WHERE productos.id_producto = $id_producto";
		//echo $query . '<br />';
		if ($connection->query($query)){
			//echo 'modificado el stock';
		}else{
			//echo ' no se ha modificado el stock';
		}
			
		
		
	}
	
	static function hayStock($id_producto){
		$hayStock = false;
		$connection = Database::getConnection();
		$query = "SELECT * FROM productos WHERE productos.id_producto = $id_producto";
		
		$result_obj = $connection->query($query);
		if ($producto = $result_obj->fetch_array(MYSQLI_ASSOC)){
			if ($producto['stock'] > 0 ){
				$hayStock = true;
				return $hayStock;
			}else{
				$hayStock = false;
				return $hayStock;
			}
		}
				
		
	}
	
	
	/**
	 * getProductosParaPaginacion()
	 * devuelve un array con el resultado de la consulta que incluye el método
	 * la consulta devuelve una serie de filas que incluyen todos los productos
	 * y su categoría
	 * El atributo $offset indica el número de registros por página que quiero que se muestren
	 *
	 * Como ejemplo, si el offset fuera 6 (porque quiero ver 6 registros por pagina)
	 * en la página 1, el offset será 0
	 * en la siguiente el offset será 6
	 * en la siguiente el offset será 12
	 * y así...
	 *
	 * @return array
	 * @param int $pag
	 * @param int $offset
	 *
	 */
	static function getProductosParaPaginacionHome($pag, $offset, $limit){
			
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
		$query = "SELECT productos.id_producto, productos.producto, productos.precio, categorias.categoria, productos.stock, productos.foto, productos.descuento, productos.id_categoria
					FROM productos
					INNER JOIN categorias
					ON productos.id_categoria = categorias.id_categoria
					WHERE productos.stock > 0
					ORDER BY id_producto DESC
					LIMIT ". $limit."
					OFFSET ". $offset ."
					";
		//ejecuta la consulta
		//echho $query;
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_object('Producto')){
				$items[] = $result;
			}
			return ($items);
		} catch (Exception $e) {
			return false;
		}
	
	}
		
	
}