<?php

/**
 * database.php
 *
 * Archivo para la clase database
 *
 * @author	cobo morera
 * @version 1.0 2016-05-02
 * @package CobShop
 * @copyright Copyright (c) 2016 CobShop
 *
 */


class Database{
	//propiedades
	private static $_connection = NULL;
	private static $_hostname = "localhost";
	private static $_mysqlUser = 'cobshop';
	private static $_mysqlPass = 'winter';
	private static $_mysqlDatabase = "cobshop";
	
	
	
	/**
	 * constructor
	 * vacio para que no se pueda crear una instancia
	 */
	private function __construct(){
		
	}
	
	
	/**
	 * crea una nueva conexi�n a la base de datos
	 * comprueba primero si ya hay una conexi�n abierta
	 */
	public static function getConnection(){
		if(!self::$_connection){
			self::$_connection = new mysqli(self::$_hostname, self::$_mysqlUser, self::$_mysqlPass, self::$_mysqlDatabase );
			if (self::$_connection->connect_error){
				die('Connect error: ' . self::$_connection->connect_error);
			}
		}
		return self::$_connection;
	}
	
	
	/**
	 * m�todo que escapa las comillas, en caso de que estuviera activa la opci�n MAQIC_QUOTES_ACTIVE
	 * lo usar� en el momento de preparar los datos para introducirlos en la base de datos
	 * @param unknown $value
	 * @return string
	 */
	public static function prep($value){
		if(MAGIC_QUOTES_ACTIVE){
			$value = stripcslashes($value);
		}
		$value= self::$_connection->real_escape_string($value);
		return $value;
	}
	
	
	
	
	
	
}