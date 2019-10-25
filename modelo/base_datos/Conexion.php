<?php
namespace modelo\base_datos;

use PDO;

class Conexion {

	/**
	* Coneción a la base de datos
	* @return conexion
	*/
	public static function conectar(){
		$cnn = new PDO('mysql:host=localhost;dbname=apoyos_devices', 'user_adevices', 'devices2019');
		$cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $cnn;
	}

}
