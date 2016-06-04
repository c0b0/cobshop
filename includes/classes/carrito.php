<?php
/**
 * categoria.php
 *
 * Archivo para la clase categoria
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */

class Carrito{
	
	//propiedades
	/*
	 * id del carrito
	 */
	protected $id_carrito;
	/*
	 * id del usuario propietario del carritio
	 */
	protected $id_usuario;
	/*
	 * id del producto 
	 */
	protected $id_producto;
	
	
	/*
	 * Constructor de objetos de la clase Carrito
	 * @param array
	 * */
	public function __construct($input = false){
		if (is_array($input)){
			foreach ($input as $key => $val) {
				$this->$key = $val;
			}
		}
	}
	
	
	/**
	 * devuelve la id del carrito
	 * @return int
	 */
	public function getId_Carrito(){
		return $this->id_carrito;
	}
	
	/**
	 * devuelve la id del usuario propietario
	 * del carrito
	 * @return int
	 */
	public function getId_usuarioPropietari(){
		return $this->id_usuario;
	}
	
	/**
	 * devuelve la id del producto
	 * que se va a incluir en el carrito
	 * @return int
	 */
	public function getId_Producto(){
		return $this->id_producto;
	}
	
	
	/**
	 * añade un articulo al carrito
	 */
	public function  addArticuloACarrito(){
		
		$connection = Database::getConnection();
		$query = "INSERT INTO carritos
					(id_carrito, id_usuario, id_producto)
					VALUES
					( 0, '". Database::prep($this->id_usuario) ."', '". Database::prep($this->id_producto) ."')";
		
		if ($connection->query($query)){
			$return = array('' , 'El artículo ha sido añadido a tu carrito');
			return $return;
		}else{
			$return = array('' , 'No se ha podido añadir el artículo a tu carrito');
		}
	}
	
	
	/**
	 * devuelve el número de productos que tiene el usuario 
	 * en el carrito para mostrarlo en la barra superior
	 * a la derecha del nombre del usuario
	 */
	
	static function articulosEnCarrito(){
		if (!estaLogueado()){
			return 0;
		}else{
			$connection = Database::getConnection();
			$query = "SELECT COUNT(*)
					FROM carritos
					WHERE
					carritos.id_usuario = ". $_SESSION['id_usuario'] ." ";
			if ($result_obj = $connection->query($query)){
				$result = $result_obj->fetch_array(MYSQLI_BOTH); 
				return $result[0];
			}
		}
	}
	
	
	
	/**
	 * comprueba si el artículo ya se encuentra en el carrito del usuario
	 * @param int $id_producto
	 */
	static function estaEnCarrito($id_producto){
		$connection = Database::getConnection();
		$query = "SELECT * FROM carritos WHERE carritos.id_usuario = '". $_SESSION['id_usuario']."'";
		$result_obj = $connection->query($query);
		$encontrado = false;
		$i = 0;
		while ( $i <= $result_obj->num_rows && !$encontrado){
			$row = $result_obj->fetch_array(MYSQLI_BOTH);
			if ($row['id_producto'] == $id_producto){
				$encontrado = true;
				return $encontrado;
			}
			$i ++;
		}
		return $encontrado;
	}
	
	/**
	 * devuelve un array con las filas obtenidas
	 * de la consulta
	 * 
	 * @param int $id_usuario
	 */
	static function getCarritoDelUsuario($id_usuario){
		$items = '';
		$connection = Database::getConnection();
		$query = "SELECT carritos.id_carrito, carritos.id_producto, 
					productos.foto, productos.descuento, productos.producto, productos.precio 
					FROM carritos 
					INNER JOIN productos 
					ON carritos.id_producto = productos.id_producto 
					WHERE carritos.id_usuario = $id_usuario ";
		
		if ($result_obj = $connection->query($query)){
			while ($result = $result_obj->fetch_array(MYSQLI_ASSOC)){
				$items[] = $result;
			}
			return $items;
			
		}
							
	}
	
	
	/**
	 * borra un carrito
	 * @param string $tabla
	 * @param int $id_producto
	 */
	static function borraCarrito($tabla ,$id_producto){
		$connection = Database::getConnection();
		$query = "DELETE FROM $tabla WHERE id_producto = $id_producto";
		//echo $query;
		
		if ($connection->query($query)){
			//echo 'borrado';
		}else{
		//echo 'no se pudo borrar';
		}
			
	}
	
	
	
	
}
