<?php

/**
 * compra.php
 *
 * Archivo para la clase compra
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */

class Compra{
	
	/*
	 * id de la compra
	 */
	protected $id_compra;
	/*
	 * id del usuario que realiza la compra
	 */
	protected $id_usuario;
	/*
	 * id del producto comprado
	 */
	protected $id_producto;
	/*
	 * unidades del producto compradas
	 */
	protected $unidades;
	/*
	 * fecha en la que se realizó la compra
	 */
	protected $fecha;
	/*
	 * coste total de la compra
	 */
	protected $coste_total;
	
	
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
	 * devuelve la id de la compra
	 * @return int
	 */
	public function getId_compra(){
		return $this->id_compra;
	}
	
	/**
	 * devuelve la id del usuario que realiza la compra
	 * @return int
	 */
	public function getId_usuario(){
		return $this->id_usuario;
	}
	
	/**
	 * devuelve la id del producto comprado
	 * @return int
	 */
	public function getId_producto(){
		return $this->id_producto;
	}
	
	/**
	 * devuelve el número de unidades del producto compradas
	 * @return int
	 */
	public function getUnidades(){
		return $this->unidades;
	}
	
	/**
	 * devuelve la fecha en la que se realizó al compra
	 * @return timestamp
	 */
	public function getFecha(){
		return $this->fecha;
	}
	
	/**
	 * devuelve el coste total de la compra
	 * @return int
	 */
	public function getCoste_total(){
		return $this->coste_total;
	}
	
	
	/**
	 * devuelve un array que incluye los resultados de la consulta que contiene el método
	 * intento conseguir todas las compras realizadas
	 * @return array
	 */
	static function getCompras(){
		//limpia los resultados
		$items = '';
		//crea la conexión a la bbdd
		$connection = Database::getConnection();
		//crea la consulta
		$query = "SELECT usuarios.id_usuario,compras.id_compra, usuarios.nombre, compras.fecha, compras.unidades, compras.coste_total, productos.producto FROM usuarios INNER JOIN compras on compras.id_usuario = usuarios.id_usuario INNER JOIN productos ON productos.id_producto = compras.id_producto ORDER BY compras.fecha ";
		//ejecuta la consulta
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_array(MYSQLI_ASSOC)){
				$items[] = $result;
			}
			return ($items);
		} catch (Exception $e) {
			return false;
		}
	
	}
	
	/**
	 * devuelve el resultado de la consulta que contiene el método
	 * la consulta devuelve las compras realizadas por un único usuario
	 * @param int  $id_usuario
	 * @return array
	 */
	static function getCompraPorUsuario($id_usuario){
		//limpia los resultados
		$items = '';
		//crea la conexión a la bbdd
		$connection = Database::getConnection();
		//crea la consulta
		$query = "SELECT usuarios.id_usuario, compras.unidades, compras.id_compra, compras.id_usuario, compras.id_producto, compras.fecha, compras.coste_total, productos.id_producto, productos.producto FROM usuarios INNER JOIN compras ON usuarios.id_usuario = compras.id_usuario INNER JOIN productos ON compras.id_producto = productos.id_producto WHERE usuarios.id_usuario = '". $id_usuario ."'";
		//ejecuta la consulta
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_array(MYSQLI_ASSOC)){
				$items[] = $result;
			}
			return ($items);
		} catch (Exception $e) {
			return false;
		}
	
	}
	
	
	static function addCompra($id_usuario, $id_producto, $unidades, $coste_total){
		$connection = Database::getConnection();
		$query = "INSERT INTO compras
			(id_usuario, id_producto, unidades, coste_total)
			VALUES
			(". $id_usuario.", ". $id_producto.", $unidades, $coste_total)";
		
		if ($connection->query($query)){
			//echo 'compra done';
			Producto::restaStock($id_producto, $unidades);
			$mailCompra = new Correo();
			$mailCompra->enviarMailCompraRealizada($id_producto, $unidades, $coste_total);
		}else{
			//echo 'algo falló por el camino';
		}
	}
	
	
	static function getVentasParaPaginacion ( $pag, $limit, $offset){
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
		$query = "SELECT usuarios.id_usuario,
				compras.id_compra, usuarios.nombre, compras.fecha, compras.unidades, compras.coste_total, 
				productos.producto 
				FROM usuarios 
				INNER JOIN compras 
				ON compras.id_usuario = usuarios.id_usuario 
				INNER JOIN productos 
				ON productos.id_producto = compras.id_producto 
				ORDER BY compras.fecha desc
				LIMIT ".$limit."
				OFFSET ".$offset."		
				
				";
		//ejecuta la consulta
		//echho $query;
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_array(MYSQLI_ASSOC)){
				$items[] = $result;
			}
			return ($items);
		} catch (Exception $e) {
			return false;
		}
		
	}
	
	
	/**
	 * realiza una consulta a la tabla de compras
	 * para sumar toda la columna de coste_total y hallar el
	 * total de dinero ganado con las ventas
	 */
	static function getTotalCompras(){
		$connection = Database::getConnection();
		$query = "SELECT SUM(coste_total) FROM compras";
		$result_obj = $connection->query($query);
		$result = $result_obj->fetch_array(MYSQLI_NUM);
		return $result[0];
	}
	
	
	
}