<?php
namespace modelo\dao;

use modelo\generico\GenericoDAO;
use PDO;

/**
* Clase CampanaDAO extiende de la clase GenericoDAO
*/
class CampanaDAO extends GenericoDAO {

 /**
 * Constructor de la clase
 */
 public function __construct(&$cnn) {
  parent::__construct($cnn, 'campana');
 }

    /**
    * Query para insertar datos en la tabla Campana de la DB
    * @return Boolean
    */
    function insertarCampana($id, $iva, $trm, $uvt, $canal, $producto, $fecha_inicio, $fecha_fin, $descripcion, $kitpre_regalo, $costo_logistico, $precio, $apoyo, $subsidio, $margen){
     $sentencia = $this->cnn->prepare("INSERT INTO campana (id_smartphone, iva, trm, uvt, canal, producto, fecha_inicio,
      fecha_fin, descripcion, kitpre_regalo, costo_logistico, precio, apoyo, subsidio, margen, estado) VALUES (:id_smartphone,
      :iva, :trm, :uvt, :canal, :producto, :fecha_inicio,
      :fecha_fin, :descripcion, :kitpre_regalo, :costo_logistico, :precio, :apoyo, :subsidio, :margen, 3)");
     $sentencia->execute(array(
      'id_smartphone' => $id, 
      'iva' => $iva,
      'trm' => $trm,
      'uvt' => $uvt,
      'canal' => $canal,
      'producto' => $producto,
      'fecha_inicio' => $fecha_inicio,
      'fecha_fin' => $fecha_fin,
      'descripcion' => $descripcion,
      'kitpre_regalo' => $kitpre_regalo,
      'costo_logistico' => $costo_logistico,
      'precio' => $precio,
      'apoyo' => $apoyo,
      'subsidio' => $subsidio,
      'margen' => $margen));
     $ultimoId = $this->cnn->lastInsertId();
     return $ultimoId;
    }

    /**
    * Query para consultar Costo de acuerdo a un ID
    * @return Array del resultado de la sentencia
    */
    function consultarCostoID($id){
    	$sentencia = $this->cnn->prepare("SELECT costo_equipo FROM smartphone WHERE id_smartphone = :id_smartphone");
    	$sentencia->execute(array('id_smartphone' => $id));
    	$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
    	$costo = $resultado[0];
     return $resultado;
    }

    /**
    * Query para consultar los costos por PLU
    * @return array de la consulta
    */
    function consultarCostoPLU($plu){
     $sentencia = $this->cnn->prepare("SELECT costo_equipo FROM smartphone WHERE plu = :plu");
     $sentencia->execute(array('plu' => $plu));
     $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
     if (!empty($resultado) || $resultado != null) {
         return $resultado[0];
     }else{
        return null;
     }
    }

    /**
    * Query para consultar la tablas Campana de la BD
    * @return Array del resultado de la sentencia
    */
    function consultarCampana(){
     $sentencia = $this->cnn->prepare("SELECT * FROM campana C INNER JOIN smartphone S ON C.id_smartphone = S.id_smartphone WHERE C.estado = 4");
     $sentencia->execute();
     $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
     return $consulta;
    }

    /**
    * Query para consultar las Campañas sin Aprobar
    * @return array del resultado de la consulta
    */
    function consultarCampanaSinAprobar(){
     $sentencia = $this->cnn->prepare("SELECT * FROM campana C INNER JOIN smartphone S ON C.id_smartphone = S.id_smartphone WHERE C.estado = 3");
     $sentencia->execute();
     $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
     return $consulta;
    }

    /**
    * Query para consultar Campaña por ID
    * @return array del resultado de la consulta
    */
    function consultarCampanaporID($idCampana){
     $sentencia = $this->cnn->prepare("SELECT * FROM campana C INNER JOIN smartphone S ON C.id_smartphone = S.id_smartphone WHERE C.id_campana = :id_campana");
     $sentencia->execute(array('id_campana' => $idCampana));
     $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
     return $consulta;
    }

    /**
    * Query para consultar campañas por PLU
    * @return Array del resultado de la sentencia
    */
    function consultarCampanaPorPlu($plu){
     $sentencia = $this->cnn->prepare("SELECT * FROM campana C INNER JOIN smartphone S ON C.id_smartphone = S.id_smartphone WHERE plu = :plu AND C.estado = 4");
     $sentencia->execute(array('plu' => $plu));
     $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
     return $consulta[0];
    }

    /**
    * Query para modificar la campaña por ID
    * @return Boolean
    */
    function editarAprobarCampanaPorID($fechaI, $fechaF, $precio, $apoyo, $subsidio, $margen, $idCampana){
     $sentencia = $this->cnn->prepare("UPDATE campana SET fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, precio = :precio, apoyo = :apoyo, 
      subsidio = :subsidio, margen = :margen, estado = 4 WHERE id_campana = :id_campana");
     return $sentencia->execute(array('fecha_inicio' => $fechaI, 'fecha_fin' => $fechaF, 'precio' => $precio, 'apoyo' => $apoyo, 
      'subsidio' => $subsidio, 'margen' => $margen, 'id_campana' => $idCampana));
    }

    /**
    * Query para modificar el estado de la campaña
    * @return Boolean
    */
    function aprobarCampanaPorID($idCampana){
     $sentencia = $this->cnn->prepare("UPDATE campana SET estado = 4 WHERE id_campana = :id_campana");
     return $sentencia->execute(array('id_campana' => $idCampana));
    }

    /**
    * Query para modificar la gama para cada uno de los registros de la tabla campaña
    * @return Boolean
    */
    function asignarGama($gama, $id_campana){
     $sentencia = $this->cnn->prepare("UPDATE campana SET gama = :gama WHERE id_campana = :id_campana");
     return $sentencia->execute(array('gama' => $gama, 'id_campana' => $id_campana));
    }

    /**
    * Query para consultar las campañas por gama
    * @return arrau del resultado de la sentencia
    */
    function consultarCampanasPorGama($gama){
     $sentencia = $this->cnn->prepare("SELECT * FROM campana C INNER JOIN smartphone S ON C.id_smartphone = S.id_smartphone WHERE c.gama = :gama AND C.estado = 4");
     $sentencia->execute(array('gama' => $gama));
     $consulta= $sentencia->fetchAll(PDO::FETCH_OBJ);
     if ($consulta != null || !empty($consulta)) {
      return $consulta;
     }
    }

    /**
    * Query para consultar campañas por mes
    * @return array del resultado de la sentencia
    */
    function consultarCampanaPorMes($mes){
     $sentencia = $this->cnn->prepare("SELECT * FROM campana C INNER JOIN smartphone S ON C.id_smartphone = S.id_smartphone 
      WHERE MONTH(C.fecha_inicio) = :mes and MONTH(C.fecha_fin) = :mes AND C.estado = 4");
     $sentencia->execute(array('mes' => $mes));
     $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
     return $consulta;
    }

    /**
    * Query para consultar las marcas que registradas en la tabla campana
    * @return arayy del resultado de la sentencia
    */
    function consultarMarcasCampana(){
     $sentencia = $this->cnn->prepare("SELECT DISTINCT marca FROM campana C INNER JOIN smartphone S ON C.id_smartphone = S.id_smartphone WHERE C.estado = 4");
     $sentencia->execute();
     $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
     return $consulta;
    }

    /**
    * Query para consultar campañas por marca
    * @return array del resultado de la sentencia
    */
    function consultarCampanaPorMarca($marca){
     $sentencia = $this->cnn->prepare("SELECT * FROM campana C INNER JOIN smartphone S ON C.id_smartphone = S.id_smartphone WHERE marca = :marca AND C.estado = 4");
     $sentencia->execute(array('marca' => $marca));
     $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
     return $consulta;
    }

    /**
    * Query para consultar campañas por mes y marca
    * @return array del resultado de la sentencia
    */
    function consultarCampanaPorMesYMarca($mes, $marca){
     $sentencia = $this->cnn->prepare("SELECT * FROM campana C INNER JOIN smartphone S ON C.id_smartphone = S.id_smartphone WHERE MONTH(C.fecha_inicio) = :mes AND MONTH(C.fecha_fin) = :mes AND marca = :marca");
     $sentencia->execute(array('mes' => $mes, 'marca' => $marca));
     $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
     return $consulta;
    }

    /**
    * Query para agregar las unidades vendidas a cada campaña
    * @return Boolean
    */
    function agregarUndsVendidasCam($undVendidas, $apoyoTotal, $id_campana){
     $sentencia = $this->cnn->prepare("UPDATE campana SET und_vendidas = :und_vendidas, apoyo_total = :apoyo_total WHERE id_campana = :id_campana AND estado = 4");
     return $sentencia->execute(array('und_vendidas' => $undVendidas, 'apoyo_total' => $apoyoTotal, 'id_campana' => $id_campana));
    }

    /**
    * Query para consultar el apoyo total por marca
    * @return array del resultado de la consulta
    */
    function consultarApoyoTotalMarca($marca, $mes){
     $sentencia = $this->cnn->prepare("SELECT DISTINCT marca, MONTH(fecha_inicio) as mes, apoyo_total FROM campana C INNER JOIN smartphone S 
      ON C.id_smartphone = S.id_smartphone WHERE S.marca = :marca AND C.apoyo_total > 0 AND MONTH(C.fecha_inicio) = :mes AND MONTH(C.fecha_fin) = :mes AND C.estado = 4");
     $sentencia->execute(array('marca' => $marca, 'mes' => $mes));
     $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
     return $consulta;
    }
   }