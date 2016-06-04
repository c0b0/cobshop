<?php

/**
 * categoria.php
 *
 * Archivo para la clase comentario
 *
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 */

class Comentario{
	
	/*
	 * id del comentario
	 */
	protected $id_comentario;
	/**
	 * comentario
	 */
	protected $comentario;
	/*
	 * fecha en la que se escribió el comentario
	 */

	protected $fecha;
	/*
	 * id del usuario que escribió el comentario
	 */
	protected $id_usuario;
	/*
	 * id del producto que recibe los comentarios
	 */
	protected $id_producto;
	
	
	/**
	 * constructor de objetos de la clase comentario
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
	 * devuelve la id del comentario
	 * @return int
	 */
	public function getId_comentario(){
		return $this->id_comentario;
	}
	/**
	 * devuelve el comentario
	 */
	public function getComentario(){
		return $this->comentario;
	}
	/**
	 * devuelve la fecha en la que se escribió el comentario
	 * @return timestamp
	 */
	public function getFecha(){
		return $this->fecha;
	}
	/**
	 * devuelve la id del usuario que ha escrito el comentario
	 * @return int
	 */	
	public function getId_usuario(){
		return $this->id_usuario;
	}
	/**
	 * devuelve la id del producto que recibe los comentarios
	 */
	public function getId_producto(){
		return $this->id_producto;
	}
	
	
	/**
	 * devuelve un array con las filas que recogen los comentarios de un producto en concreto
	 * @param  $id (id del producto)
	 * @return array
	 */
	static function getComentariosPorId($id){
		//limpia los resultados
		$item = '';
		//crea la conexión a la bbdd
		$connection = Database::getConnection();
		//crea la consulta
		$query = "SELECT usuarios.nombre, comentarios.id_comentario, comentarios.comentario, comentarios.fecha, productos.id_producto FROM comentarios INNER JOIN usuarios ON usuarios.id_usuario = comentarios.id_usuario INNER JOIN productos ON productos.id_producto = comentarios.id_producto WHERE comentarios.id_producto = '". $id ."' ORDER BY comentarios.fecha ";
		//ejecuta la consulta
	
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_array(MYSQLI_ASSOC)){
				$item[] = $result;
			}
			return ($item);
		} catch (Exception $e) {
			return false;
		}
	
	}
	
	/**
	 * addComentario()
	 * añade un comentario
	 */
	public function addComentario(){
		
		$connection = Database::getConnection();
		$query = "INSERT INTO comentarios
			(comentario, id_usuario, id_producto)
			VALUES
			('".Database::prep($this->comentario)."', ".Database::prep($this->id_usuario)." , ".Database::prep($this->id_producto).")";
		
		if ($connection->query($query)){
			
			$return = array('', 'Se ha añadido el comentario' , '');
			return $return;
		}else{
			echo '<br /> estás jodido'; 
			$return = array('' , 'No se ha podido añadir el comentario' , '');
			return $return;
		}
		
	}
	
	/**
	 * borraComentario()
	 * borra un comentario
	 * @param string $tabla
	 * @param int $id_articulo
	 * @param int $id
	 */
	static function borraComentario($tabla, $id_articulo, $id){
		$connection = Database::getConnection();
		$query = "DELETE FROM comentarios WHERE id_comentario = $id";
		
	
		if ($connection->query($query)){
			echo 'borrado';
		}else{
			echo 'no se pudo borrar';
		}
			
	}
	
	
	
	
}