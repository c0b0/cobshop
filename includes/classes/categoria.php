<?php

/**
 * categoria.php
 *
 * Archivo para la clase categoria
 *
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 */

class Categoria{
	
	//propiedades
	/*
	 * id_categoria
	 * */
	protected $id_categoria;
	/*
	 * nombre de la categoria
	 * */
	protected $categoria;
	
	
	/*
	 * Inicializa el objeto con un array que incluye id y nombre de la categoria
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
	 * devuelve la id
	 * @return int
	 */
	public function getId_categoria(){
		return $this->id_categoria;
	}
	
	/*
	 * devuelve el nombre de la categoria
	 * @return string;
	 * */
	public function getCategoria(){
		return $this->categoria;
	}
	
	
	/*
	 * obtiene un array de objetos 'Categoria' tras hacer una consulta a la
	 * base de datos.
	 * de aquí se obtendrán las categorías que se mostrarán en el menú de navegación
	 * */
	static function getCategorias(){
		//limpia los resultados
		$items = '';
		//crea la conexión a la bbdd
		$connection = Database::getConnection();
		//crea la consulta
		$query = "SELECT * FROM `categorias`; ";
		//ejecuta la consulta
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_object('Categoria')){
				$items[] = $result;
			}
			return ($items);
		} catch (Exception $e) {
			return false;
		}
	
	}
	
	
	/**
	 * obtiene un array que contiene las filas que resultan de la
	 * consulta realizada en el método, para obtener las columnas
	 * de una categoría específica, por medio de su id
	 * @param int $id
	 */
	static function getCategoriaPorId($id){
		//limpia los resultados
		$item = '';
		//crea la conexión a la bbdd
		$connection = Database::getConnection();
		//crea la consulta
		$query = "SELECT * FROM `categorias` WHERE id_categoria = '". $id ."'";
		//ejecuta la consulta
		$result_obj = '';
		$result_obj = $connection->query($query);
		//hace un loop en los resultados
		//creando un objeto en cada pasada
		try {
			while ($result = $result_obj->fetch_object('categoria')){
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
		if (!trim($this->categoria)){
			$error = true;
		}
		if ($error){
			return false;;
		}else{
			return true;
		}
	
	}
	
	
	
	
	/**
	 * addCategoria()
	 * verifica que están los datos necesarios,
	 * conecta con la base de datos, prepara los datos
	 * e inserta los datos en la tabla
	 */
	public function addCategoria(){
		//verifica los campos
		if ($this->_verifyInput()){
	
			//conecta con la base de datos
			$connection = Database::getConnection();
	
			//prepara los datos
			$query = "INSERT INTO categorias
                       (categoria)
                       VALUES
                       ('".strtolower(Database::prep($this->getCategoria()))."')";
	
			//lanza la sql
			if ($connection->query($query)){
				$return = array('', 'Categoría añadido correctamente.' , '');
				//se envia el mensaje indicando que se ha añadido el usuario
				return $return;
			}else{
				//se envia un mensaje indicando que no se ha podido añadir el usuario
				//y redirecciona a mant_usuarios
				$return = array('mant_categorias' , 'No se ha podido añadir la categoría' , '');
				return $return;
			}
	
		}else{
			//se envía un mensaje indicando que no se ha podido añadir el usuario
			//en este caso la razón es qu falta inforación requerida
			//luego redirecciona a mant_usuarios
			$return = array('mant_categorias', 'No se ha podido añadir la categoria Falta información requerida para el proceso', '');
			return $return;
		}
	}
	
	
	
	/**
	 * editCategoria()
	 * toma los datos y realiza los cambios sobre un registro ya existente
	 */
	public function editCategoria(){
		//verifica los campos
		if ($this->_verifyInput()){
				
			//conecta con la base de datos
			$connection = Database::getConnection();
				
			//prepara el 'preparad statement'
			$query = "UPDATE categorias
						SET categoria=?
						WHERE id_categoria =?";
			$statement = $connection->prepare($query);
			//enlaza los parámetros
			$statement->bind_param('si', $this->categoria, $this->id_categoria);
				
			if ($statement){
				$statement->execute();
				$statement->close();
				//añade mensaje indicando que todo ha ido bien
				$return = array('', 'Categoria editada correctamente.', '');
				return $return;
			}else{
				$return = array('mant_categorias', 'No se ha podido editar la categoria', (int)$this->id_categoria);
				
				return $return;
			}
				
		}
	}
	
	/***
	 * borra una categoria
	 * @param string $tabla
	 * @param int $id
	 */
	static function borrarCategoria($tabla, $id){
		$connection = Database::getConnection();
		$query = "DELETE FROM $tabla WHERE id_categoria = $id";
		if ($connection->query($query)){
			$_SESSION['message'] = 'Registro borrado';
			header("location: index.php?content=categorias");
		}
	}
	
	
	
	
}