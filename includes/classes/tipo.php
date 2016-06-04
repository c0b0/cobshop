<?php
/**
 * categoria.php
 *
 * Archivo para la clase usuario
 *
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 */


class Tipo{
	
	//propiedades
	
	/**
	 * id_tipo
	 */
	protected $id_tipo;
	/**
	 * nombre del tipo de usuario
	 */
	protected $tipo;
	
	
	/*
	 * Constructor de objetos de la clase Tipo
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
	 * devuelve la id del tipo de usuario
	 * 1.- Admin
	 * 2.- Usuario normal
	 * @return int
	 */
	public function getId_tipoUsuario(){
		return $this->id_tipo;
	}
	
	public function getTipoUsuario(){
		return $this->tipo;
	}
	
	/**
	 * devuelve un array de objetos de la clase usuario
	 * @return string|unknown|boolean
	 */
	static function getTipos(){
		//limpia los resultados
		$items = '';
		//crea la conexión a la bbdd
		$connection = Database::getConnection();
		//crea la consulta
		$query = "SELECT * FROM tipos";
		//ejecuta la consulta
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_object('Tipo')){
				$items[] = $result;
			}
			return ($items);
		} catch (Exception $e) {
			return false;
		}
	
	}
	
	
	
}