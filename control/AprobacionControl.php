<?php
namespace control;

use control\generico\GenericoControl;
use modelo\dao\CampanaDAO;
use modelo\dao\AprobacionDAO;
use Exception;
use DateTime;
use fpdf;

/**
* Clase control de la tabla Campana extiende de GenericoControl
*/
class AprobacionControl extends GenericoControl{

 private $campanaDAO;
 private $aprobacionDAO;

  /**
  * Constructor de la clase
  */
  public function __construct(&$cnn) {
   parent::__construct($cnn);
   $this->campanaDAO = new CampanaDAO($cnn);
   $this->aprobacionDAO = new AprobacionDAO($cnn);
 }

  /**
  * Cargar y aprobar campaña de precios
  * Obtiene los archivos seleccionados, los pasa a la carpeta Archivos,
  * inserta en la tabla aprobaciones y cambia el estado de la campaña
  */
  function obtenerArchivos(){
    try {
      $this->cnn->beginTransaction();
      $arrayDate = new DateTime('America/Bogota');
      $fechaActual = $arrayDate->format('Ymd');
      $listaAprobaciones = $_FILES['apro-files'];
      $idCampana = $_POST['id_campana'];
      // Mover y renombrar archivos
      for ($i = 0; $i < count($listaAprobaciones); $i++) {
        if (!empty($listaAprobaciones['tmp_name'][$i])) {
          $aprobacion[$i] = $idCampana . $fechaActual . rand(0, 20000) . '_' . $listaAprobaciones['name'][$i];
          move_uploaded_file($listaAprobaciones['tmp_name'][$i], RUTA_PRINCIPAL . '/archivos/aprobaciones/' . $aprobacion[$i]);
        }
      }
      // Insertar archivos en la base de datos
      for ($i=0; $i < count($aprobacion); $i++) { 
        $this->aprobacionDAO->insertarAprobacionCampana($idCampana, $aprobacion[$i], $arrayDate->format('Y-m-d'));
      }
      $this->campanaDAO->aprobarCampanaPorID($idCampana);
      if ($this->cnn->commit()) {
        header('Location:' . RESUMEN_CAMPANA['url'] . '?r=4');
      }else{
        header('Location:' . RESUMEN_CAMPANA['url'] . '?r=5');
      }
    } catch (Exception $e) {
      $this->cnn->rollBack();
      echo "Error al insertar datos adjuntos <br>";
      echo $e->getMessage();
    }
  }

  /**
  * Editar y aprobar campaña de precios
  * Obtiene los archivos que se seleccionaron, los pasa a la carpeta Archivos,
  * inserta en la tabla aprobaciones y modifica la campaña de precios
  */
  function editarYAprobarCampana(){
    try {
      $this->cnn->beginTransaction();
      $arrayDate = new DateTime('America/Bogota');
      $fechaActual = $arrayDate->format('Ymd');
      $listaAprobaciones = $_FILES['apro-files'];
      $idCampana = $_POST['id_campana'];
      $fechaI = $_POST['cam_fechaI'];
      $fechaF = $_POST['cam_fechaF'];
      $precio = $_POST['cam_precio'];
      $apoyo = $_POST['cam_apoyo'];
      $subsidio = $_POST['cam_subsidio'];
      $margen = round($_POST['cam_margen'], 2); 
      // Mover y renombrar archivos
      for ($i = 0; $i < count($listaAprobaciones); $i++) {
        if (!empty($listaAprobaciones['tmp_name'][$i])) {
          $aprobacion[$i] = $idCampana . $fechaActual . rand(0, 20000) . '_' . $listaAprobaciones['name'][$i];
          move_uploaded_file($listaAprobaciones['tmp_name'][$i], RUTA_PRINCIPAL . '/archivos/aprobaciones/' . $aprobacion[$i]);
        }
      }
      // Insertar archivos en la base de datos
      for ($i=0; $i < count($aprobacion); $i++) { 
        $this->aprobacionDAO->insertarAprobacionCampana($idCampana, $aprobacion[$i], $arrayDate->format('Y-m-d'));
      }
      // Cambiar estado de campaña
      $this->campanaDAO->editarAprobarCampanaPorID($fechaI, $fechaF, $precio, $apoyo, $subsidio, $margen, $idCampana);
      if ($this->cnn->commit()) {
        header('Location:' . RESUMEN_CAMPANA['url'] . '?r=4');
      }else{
        header('Location:' . RESUMEN_CAMPANA['url'] . '?r=5');
      }
    } catch (Exception $e) {
      $this->cnn->rollBack();
      echo "Error al insertar datos adjuntos <br>";
      echo $e->getMessage();
    }
  }

  /**
  * Consultar aprobaciones
  * De acuerdo a el ID de la campaña trae los registros que
  * correspondan de la tabla aprobaciones
  */
  function consultarAprobaciones(){
    $idCampana = $_POST['id_campana'];
    $listaAprobaciones = $this->aprobacionDAO->consultarAprobacionesPorCampana($idCampana);
    header('Content-Type:application/json');
    echo json_encode($listaAprobaciones);
  }

}