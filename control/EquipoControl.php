<?php
namespace control;

use control\generico\GenericoControl;
use modelo\dao\SmartphoneDAO;
use modelo\vo\Smartphone;
use DateTime;
use DateTimeZone;

/**
* Clase control de la tabla Smartphone extiende de GenericoControl
*/
class EquipoControl extends GenericoControl {

 private $smartphoneDAO;

  /**
  * Constructor de la clase
  */
  public function __construct(&$cnn) {
   parent::__construct($cnn);
   $this->smartphoneDAO = new SmartphoneDAO($cnn);
  }

  /**
  * Traer fecha actual
  * Usa DateTime para traer la fecha actual
  * @return array $arrayDate
  */
  function traerFechaActual(){
   $arrayDate = new DateTime('America/Bogota');
   return $arrayDate;
  }

  /**
  * Validar Actualización de Data Equipos
  * Obtiene la ultima fecha de registro de 
  * los equipos cargados a la BD.
  * @return $ultimaFecha;
  */
  function consultarUltimoRegistro($cnn){
   $consultarUltimaCarga = SmartphoneDAO::consultarUltimaCarga($cnn);
   if (empty($consultarUltimaCarga)) {
    $ultimaFecha = "No se han cargado registros.";
    return $ultimaFecha;
   }else{
    $ultimaFecha = $consultarUltimaCarga->fecha_registro;
    $mesActual = EquipoControl::traerFechaActual();
    $mesActual = $mesActual->format('m');
    $traerMes = str_split($ultimaFecha);
    $ultimoMes = $traerMes['5'] . $traerMes['6'];
    if ($ultimoMes < $mesActual || $ultimoMes > $mesActual) {
     return $ultimaFecha;
    }
   }
  }

  /**
  * Mostrar vista actualizarDataEquipos.php
  */
  function indexActualizarData(){
   include 'vista/actualizarDataEquipos.php';
  }

  /**
  * Validar archivo CSV
  * Abre el archivo y lee linea por linea la informacion 
  * para comprobar que sean datos validos.
  */
  function validarCSV($name){
   $file = fopen($name, 'r');
   while (!feof($file)) {
    $line = fgets($file);
    if (empty($line)) {
     continue;
    }
    $array = explode(';', $line);
    if (isset($array[3])) {
     $res = 1;
     $arrayValor = explode('.', $array[3]);
     $arrayValor2 = explode(',', $array[3]);
     if (isset($arrayValor[1]) || isset($arrayValor2[1])) {
      $resCosto = 0;
      break;
     }
    }else{
     $res = 0;
     break;
    }
   }
   fclose($file);
   $validacion = ($res && !isset($resCosto)) ? 1 : 0;
   return $validacion;
  }

  /**
  * Insertar o Actualizar Equipo
  * Recorre el archivo de datos, consulta si el PLU ingresado existe 
  * y de acuerdo a esto inserta o edita en la base de datos.
  */
  function insertarActualizarEquipo($name, $validacion, $rutaFallo){
   $arrayDate = EquipoControl::traerFechaActual();
   $file = fopen($name, 'r');
   fgets($file); //Se omite la primera línea porque son los titulos de las columnas
    if ($validacion) {
     while (!feof($file)) {
      $line = fgets($file);
      if (empty($line)) {
       continue;
      }
      $array = explode(';', $line);
      if ($array[0] == null || empty($array[0])) {
       continue;
      }else{
       $consultarPLU = $this->smartphoneDAO->consultarEquipoPlu($array[0]);
       print_r($consultarPLU);
       if (!empty($consultarPLU)) {
        if ($this->smartphoneDAO->actualizarEquipo($array[3], $arrayDate->format('Y-m-d H:i:s'), $array[0])) {
         header('Location:' . CONSULTAR_EQUIPOS['url'] . "?r=9");
        }
       }else{
        if ($this->smartphoneDAO->insertarEquipo($array[0], $array[1], $array[2], $array[3], $arrayDate->format('Y-m-d H:i:s'))) {
         header('Location:' . CONSULTAR_EQUIPOS['url'] . "?r=1");
        }else {
         header('Location:' . $rutaFallo . "?r=2");
        }
       }
      }
     }
    }else{
     header('Location:' . $rutaFallo . "?r=4");
    }
   fclose($file);
  }

  /**
  * Actualizar data de tabla Smartphone
  * Obtiene el archivo y lo traslada a la carpeta archivos
  * Usa validarCSV y insertarActualizarEquipo para validar, 
  * insertar y/o actualizar en la base de datos.
  */
  function actualizarData(){
   $infofile = $_FILES['sma_archivo'];
   $location = $infofile['tmp_name'];
   $name = RUTA_PRINCIPAL . '/archivos/' . $infofile['name'];
   move_uploaded_file($location, $name);
   $rutaFallo = INDEX_ACTUALIZAR_DATA['url'];
   $validacion = $this->validarCSV($name);
   $this->insertarActualizarEquipo($name, $validacion, $rutaFallo);
  }

  /**
  * Mostrar vista Presentacion.php
  */
  function index(){
   include 'vista/presentacion2.php';
  }

  /**
  * Mostrar vista cargaMasiva.php
  */
  function cargarArchivo(){
   include 'vista/cargaMasiva.php';
  }
  
  /**
  * Cargar masivamente equipos
  * Obtiene el archivo y lo traslada a la carpeta archivos
  * Usa validarCSV y insertarActualizarEquipo para validar, 
  * insertar y/o actualizar en la base de datos.
  */
  function guardarArchivo(){
   $infofile = $_FILES['sma_archivo'];
   $location = $infofile['tmp_name'];
   $name = RUTA_PRINCIPAL . '/archivos/' . $infofile['name'];
   move_uploaded_file($location, $name);
   $rutaFallo = CARGAR_ARCHIVO['url'];
   $validacion = $this->validarCSV($name);
   $this->insertarActualizarEquipo($name, $validacion, $rutaFallo);
  }

  /**
  * Mostrar vista registrarEquipo.php
  * Consulta todas las marcas existentes en los registros 
  * de los equipos y retorna la vista.
  */
  function registrarEquipo(){
   $listaMarcas = $this->smartphoneDAO->consultarMarcasRegistradas();
   include 'vista/registrarEquipo.php';
  }

  /**
  * Insertar equipos en la BD
  * Obtiene los valores del formulario, consulta si existe
  * el PLU ingresado y registra o actualiza la base de datos.
  */
  function guardarEquipo(){
   $arrayDate = EquipoControl::traerFechaActual();
   $plu = $_POST['sma_plu'];
   $referencia = $_POST['sma_referencia'];
   $marca = $_POST['sma_marca'];
   $costo = $_POST['sma_costo'];
   $consultaPLU = $this->smartphoneDAO->consultarEquipoPlu($plu);
   if (!empty($consultaPLU)) {
    if ($this->smartphoneDAO->actualizarEquipo($costo, $arrayDate->format('Y-m-d H:i:s'), $plu)) {
     header('Location:' . CONSULTAR_EQUIPOS['url'] . "?r=3");
    }else{
     header('Location:' . REGISTRAR_EQUIPO['url'] . "?r=2");
    }
   }else{
    if ($this->smartphoneDAO->insertarEquipo($plu, $referencia, $marca, $costo, $arrayDate->format('Y-m-d H:i:s'))) {
     header('Location:' . CONSULTAR_EQUIPOS['url'] . "?r=1");
    }else{
     header('Location:' . REGISTRAR_EQUIPO['url'] . "?r=2");
    }
   }
  }

  /**
  * Consultar equipos
  * Usa el metodo consultarEquipo de la clase SmartphoneDAO
  * para que se visualicen en la vista consultarEquipos.php
  */
  function consultarEquipos(){
   $listaEquipos = $this->smartphoneDAO->consultarEquipo();
   if (isset($_POST['id_smartphone'])) {
    $detalleEquipo = $this->smartphoneDAO->consultarEquipoID($_POST['id_smartphone']);
    foreach ($detalleEquipo as $consulta) {
     $datos = array('plu' => $consulta->plu, 'ref' => $consulta->referencia, 'marca' => $consulta->marca, 'costo' => $consulta->costo_equipo, 'id' => $_POST['id_smartphone']);
     header('Content-Type:application/json');
     echo json_encode($datos);
     return $datos;
    }
   }
   include 'vista/consultarEquipos.php';
  }

  /**
  * Editar equipo por ID
  * Usa el metodo editarEquipo de la clase SmartphoneDAO
  * Asigna los nuevos datos obtenidos del formulario y los
  * reemplaza por los registrados en la tabla.
  */
  function editarEquipo(){
   $id_smartphone = $_POST['id_s'];
   $plu = $_POST['sma_plu'];
   $referencia = $_POST['sma_referencia'];
   $marca = $_POST['sma_marca'];
   $costo = $_POST['sma_costo'];
   if ($this->smartphoneDAO->editarEquipo($plu, $referencia, $marca, $costo, $id_smartphone)) {
    header('Location:' . CONSULTAR_EQUIPOS['url'] . "?r=3");
   }else {
    header('Location:' . CONSULTAR_EQUIPOS['url'] . "?r=4");
   }
  }

  /**
  * Eliminar equipo por ID
  * Usa el metodo eliminarEquipo de la clase SmartphoneDAO
  * Cambia el campo estado de la tabla smartphone para que no se tenga en cuenta
  * Esto se realiza debido a que no es una buena practica eliminar verdaderamente
  * datos de una BD.
  */
  function eliminarEquipo(){
   $id_smartphone = $_GET['id_s'];
   if ($this->smartphoneDAO->eliminarEquipo($id_smartphone)) {
    header('Location:' . CONSULTAR_EQUIPOS['url'] . "?r=5");
   }else{
    header('Location:' . CONSULTAR_EQUIPOS['url'] . "?r=6");
   }
  }

 }