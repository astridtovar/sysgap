<?php
namespace modelo\dao;

use modelo\generico\GenericoDAO;
use PDO;

/**
* Clase ApoyoMensualDAO extiende de la clase GenericoDAO
*/

class ApoyoMensualDAO extends GenericoDAO {

	/**
	* Constructor de la clase
	*/
	public function __construct(&$cnn) {
        parent::__construct($cnn, 'apoyo_mensual');
    }

    /**
    * Query para consultar la llave unica entre mes y marca de la tabla apoyo_mensual
    * @return array del resultado de la sentencia 
    */
    function consultarUniqueMesMarca($mes, $marca){
    	$sentencia = $this->cnn->prepare("SELECT * FROM apoyo_mensual WHERE mes = :mes AND marca = :marca");
    	$sentencia->execute(array('mes' => $mes, 'marca' => $marca));
    	$consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
    	if (!empty($consulta)) {
    		return $consulta;
    	}
    	return;
    }

    /**
    * Query para insertar registros en la tabla apoyo_mensual
    * @return array del resultado de la sentencia
    */
    function insertarApoyoMensual($mes, $txtMes, $marca, $apoyo_total){
    	$sentencia = $this->cnn->prepare("INSERT INTO apoyo_mensual (mes, text_mes, marca, apoyo_total) VALUES (:mes, :txtM, :marca, :apoyo_total)");
    	return $sentencia->execute(array('mes' => $mes, 'txtM' => $txtMes, 'marca' => $marca, 'apoyo_total' => $apoyo_total));
    }

    /**
    * Query para modificar el apoyo total de la tabla apoyo_mensual
    * @return Boolean
    */
    function modificarApoyoMensual($mes, $txtMes, $marca, $apoyo_total){
    	$sentencia = $this->cnn->prepare("UPDATE apoyo_mensual SET apoyo_total = :apoyo_total, text_mes = :txtM WHERE mes = :mes AND marca = :marca");
    	return $sentencia->execute(array('apoyo_total' => $apoyo_total, 'mes' => $mes, 'txtM' => $txtMes, 'marca' => $marca));
    }

    /**
    * Query para consultar el apoyo mensual por marca
    * @return array del resultado de la consulta
    */
    function consultarApoyosMensualesMarca($marca){
    	$sentencia = $this->cnn->prepare("SELECT text_mes as label, mes as x, apoyo_total as y FROM apoyo_mensual WHERE apoyo_total != 0 AND marca = :marca ORDER BY mes ASC");
    	$sentencia->execute(array('marca' => $marca));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
    	return $consulta;
    }

    /**
    * Query para consultar todos los apoyos mensuales
    * @return array del resultado de la consulta
    */
    function consultarApoyosMensuales(){
        $sentencia = $this->cnn->prepare("SELECT marca as name, text_mes as label, mes as x, apoyo_total as y FROM apoyo_mensual WHERE apoyo_total != 0 ORDER BY mes ASC");
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
}