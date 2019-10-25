<?php
namespace modelo\dao;

use modelo\generico\GenericoDAO;
use PDO;

/**
* Clase ventasDAO extiende la la clase GenericoDAO
*/
class VentasDAO extends GenericoDAO {

	/**
    * Constructor de la clase
    */
    public function __construct(&$cnn) {
        parent::__construct($cnn, 'ventas');
    }

    /**
    * Query para consultar fecha del ultimo registro de venta
    * @return Array del resultado de la sentencia
    */
    function consultarUltimoRegistro(){
        $sentencia = $this->cnn->prepare("SELECT fecha_registro FROM ventas ORDER BY id_venta DESC LIMIT 1");
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ); 
        if (!empty($consulta)) {
            return $consulta[0];
        }
    }

    /**
    * Query para insertar en la tabla ventas
    * @return Boolean
    */
    function insertarVentas($fecha, $canal, $plu, $fecha_registro){
    	$sentencia = $this->cnn->prepare("INSERT INTO ventas (fecha_venta, nombre_canal, plu, fecha_registro) VALUES (:fecha_venta, :nombre_canal, :plu, :fecha_registro)");
    	return $sentencia->execute(array('fecha_venta' => $fecha, 'nombre_canal' => $canal, 'plu' => $plu, 'fecha_registro' => $fecha_registro));
    }

    /**
    * Query para modificar marca y referencia de un registro
    * @return Boolean
    */
    function asignarRefMar($referencia, $marca, $plu){
    	$sentencia = $this->cnn->prepare("UPDATE ventas SET referencia = :referencia, marca = :marca WHERE plu = :plu");
        return $sentencia->execute(array('referencia' => $referencia, 'marca' => $marca, 'plu' => $plu));
    }

    /**
    * Query para consultar margen de la campaña por Marca
    * @return Array del resultado de la sentencia
    */
    function consultarMargen($marca){
        $sentencia = $this->cnn->prepare("SELECT margen FROM campana C INNER JOIN smartphone S ON C.id_smartphone = S.id_smartphone WHERE S.marca = :marca");
        $sentencia->execute(array('marca' => $marca));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

    /**
    * Query para consultar el numero de campañas registradas para una marca
    * @return int 
    */
    function contarRegistrosMarca($marca){
        $sentencia = $this->cnn->prepare("SELECT COUNT(margen) as cant FROM campana C INNER JOIN smartphone S ON C.id_smartphone = S.id_smartphone WHERE S.marca = :marca");
        $sentencia->execute(array('marca' => $marca));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta[0]->cant;
    }

    /**
    * Query para consultar las unidades vendidas en una campaña
    * @return int
    */
    function consultarApoyoTotalCam($fechaI, $fechaF, $plu, $canal){
        $sentencia = $this->cnn->prepare("SELECT COUNT(id_venta) FROM ventas WHERE fecha_venta >= :fechaI and fecha_venta <= :fechaF and plu = :plu and nombre_canal = :canal");
        $sentencia->execute(array('fechaI' => $fechaI, 'fechaF' => $fechaF, 'plu' => $plu, 'canal' => $canal));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta[0];
    }

    /**
    * Query para consultar la campañas de una marca
    * @return Array del resultado de la sentencia
    */
    function consultarCampana($marca){
        $sentencia = $this->cnn->prepare("SELECT * FROM campana C INNER JOIN smartphone S ON C.id_smartphone = S.id_smartphone WHERE S.marca = :marca");
        $sentencia->execute(array('marca' => $marca));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

    /**
    * Query para consultar las gamas registradas en las campañas
    * @return Array del resultado de la consulta
    */
    function consultarGamasRegistradas(){
        $sentencia = $this->cnn->prepare("SELECT DISTINCT gama FROM campana C");
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

}