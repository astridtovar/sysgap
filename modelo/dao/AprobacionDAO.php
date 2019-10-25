<?php
namespace modelo\dao;

use modelo\generico\GenericoDAO;
use PDO;

/**
* Clase ventasDAO extiende la la clase GenericoDAO
*/
class AprobacionDAO extends GenericoDAO {

 /**
 * Constructor de la clase
 */
	public function __construct(&$cnn) {
		parent::__construct($cnn, 'aprobacion');
	}

 /**
 * Query para insertar en la tabla aprobacion de la base de datos.
 * @return Boolean
 */
 function insertarAprobacionCampana($idCampana, $urlAprobacion, $fechaAprobacion){
 	$sentencia = $this->cnn->prepare("INSERT INTO aprobacion (id_campana, url_aprobacion, fecha_aprobacion) VALUES (:id_campana, :url_aprobacion, :fecha_aprobacion)");
 	return $sentencia->execute(array('id_campana' => $idCampana, 'url_aprobacion' => $urlAprobacion, 'fecha_aprobacion' => $fechaAprobacion));
 }

 /**
 * Query para consultar las aprobaciones de acuerdo a el ID de una campaña
 * @return Array del resultado de la consulta
 */
 function consultarAprobacionesPorCampana($idCampana){
  $sentencia = $this->cnn->prepare("SELECT * FROM aprobacion WHERE id_campana = :id_campana");
  $sentencia->execute(array('id_campana' => $idCampana));
  $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
  return $consulta;
 }

}