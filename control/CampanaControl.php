<?php
namespace control;

use control\generico\GenericoControl;
use modelo\dao\CampanaDAO;
use modelo\dao\SmartphoneDAO;
use modelo\vo\Campana;
use DateTime;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use PHPExcel_Style_Alignment;
use PHPExcel_Worksheet;
use PHPExcel_Style_NumberFormat;
use NumberFormatter;
use PDO;

/**
* Clase control de la tabla Campana extiende de GenericoControl
*/
class CampanaControl extends GenericoControl{

 private $campanaDAO;
 private $campana;
 private $smartphoneDAO;
 private $styleFormat;

  /**
  * Constructor de la clase
  */
  public function __construct(&$cnn) {
   parent::__construct($cnn);
   $this->campanaDAO = new CampanaDAO($cnn);
   $this->campana = new Campana();
   $this->smartphoneDAO = new SmartphoneDAO($cnn);
   $this->styleFormat = new NumberFormatter('en_US', NumberFormatter::PERCENT);
  }

  /**
  * Mostrar vista registrarCampana.php
  * Valida que se hayan seleccionado equipos, si son
  * más de 2, valida que tengan el mismo costo.
  */
  function index(){
   if (!empty($_POST['id_selec'])) {
    $check = $_POST['id_selec'];
    foreach ($check as $id) {
     $costo = $this->campanaDAO->consultarCostoID($id);
     foreach ($costo as $costosValores) {
      $costosArray[] = $costosValores->costo_equipo;
     }
    }
    $costoPosCero = $costosArray[0];
    foreach ($costosArray as $costoUnd) {
     $costoTemp = $costoUnd;
     $res = ($costoTemp != $costoPosCero) ? 0 : 1;
    } 
    ($res == 1) ? include 'vista/registrarCampana.php' : header('Location:' . CONSULTAR_EQUIPOS['url'] . "?r=8");
   } else {
    header('Location:' . CONSULTAR_EQUIPOS['url'] . "?r=7");
   }
  }

  /**
  * Consultar el costo de los equipos
  * @param Array de IDs de los equipos seleccionados
  * @return Array de la consulta
  */
  function consultarCosto($arrayIDS){
   foreach ($arrayIDS as $id) {
    $costo = $this->campanaDAO->consultarCostoID($id);
   } 
   return $costo[0]->costo_equipo;
  }

  /**
  * Convertir valor IVA ingresado
  * @param Variable iva
  * @return Valor convertido
  */
  function conversionIVA($iva){
   return $ivaCover = '1.'.$iva;
  }

  /**
  * Calcular UVT
  * @param Variable uvt
  * @return Rango del IVA
  */
  function calcularUVT($uvt){
   return $rangoIva = $uvt * 22;
  }

  /**
  * Calcular escenario sin margen
  * Recibe valores ingresados en la vista registrarCampana.php
  * @return Margen, ApoyoDolares
  */
  function escenarioSimple2($costofinal, $precio, $trm, $restIvaCosto){
   $margen = $precio - $costofinal;
   $porcentajeMargen = $margen / $precio;
   $porcMargen = $this->styleFormat->format($porcentajeMargen);
   if ($margen < 0) {
    $apoyoDolar = round((abs($margen) / $trm), 0, PHP_ROUND_HALF_UP);
    if ($restIvaCosto > 0) {
     $apoyoPesos = ($apoyoDolar * $trm) + $restIvaCosto;
     $apoyoDolar = round(($apoyoPesos / $trm), 0, PHP_ROUND_HALF_UP)+1;
    }
    return array('porcentajeMargen' => 0, 'porcMargen' => '0%', 'apoyoEstimado' => $apoyoDolar);
   }else{
    return array('porcentajeMargen' => $porcentajeMargen, 'porcMargen' => $porcMargen, 'apoyoEstimado' => 0);
   }
  }

  /**
  * Calcular escenario con 10% margen
  * Recibe valores ingresados en la vista registrarCampana.php
  * @return ApoyoDolares
  */
  function escenarioMargen10($costofinal, $precio, $trm, $restIvaCosto){
   $porcentaje10 = ($precio * 0.1);
   $apoyoPesos = $precio - $costofinal - $porcentaje10;
   $apoyoPesos = ($apoyoPesos < 0) ? $apoyoPesos = abs($apoyoPesos) : $apoyoPesos = 0;
   $apoyoDolar = round(($apoyoPesos / $trm), 0, PHP_ROUND_HALF_DOWN);
   if ($restIvaCosto > 0) {
    $apoyoDolar = round((($apoyoPesos + $restIvaCosto) / $trm), 0, PHP_ROUND_HALF_DOWN);
   }
   return $apoyoDolar;
  }

  /**
  * Consultar costo regalo 2X1
  * Obtiene el costo del PLU ingresado
  * @param $pluHijo
  */
  function consultarCostoHijo2x1($pluHijo){
   $costoHijo = $this->campanaDAO->consultarCostoPLU($pluHijo);
   return $costoHijo;
  }

  /**
  * Calcular escenarios
  * Trae los valores ingresados en la vista
  * Usa las dos funciones para calcular escenarios, enviandole
  * los parametros a cada una y muestra la vista escenariosCampana.php
  */
  function calcularCampana(){
   if (isset($_POST['cam_plu_hijo']) && !empty(($_POST['cam_plu_hijo']))) {
    $pluHijo = $_POST['cam_plu_hijo'];
    $costoHijo = $this->consultarCostoHijo2x1($pluHijo);
    if ($costoHijo != null) {
      $kit_reg = $costoHijo->costo_equipo;
    }else{
      header('Location:' . CONSULTAR_EQUIPOS['url'] . '?r=10');
    }
    }else{
    $pluHijo = 0;
    $kit_reg = (!empty($_POST['cam_kit_pre'])) ? $kit_reg = $_POST['cam_kit_pre'] : $kit_reg = 0;
   }
   $arrayIDS = $_POST['array_id_cam'];
   $trm = $_POST['cam_trm'];
   $canal = $_POST['cam_canal'];
   $producto = $_POST['cam_producto'];
   $fechaI = $_POST['cam_fecha_inicio'];
   $fechaF = $_POST['cam_fecha_fin'];
   $descripcion = $_POST['cam_descripcion'];
   $precio = $_POST['cam_precio'];
   $costo_log = $_POST['cam_costo_logistico'];
   $iva = $_POST['cam_iva'];
   $trm = $_POST['cam_trm'];
   $uvt = $_POST['cam_uvt'];
   $costo = $this->consultarCosto($_POST['array_id_cam']);
   $rangoIva = $this->calcularUVT($_POST['cam_uvt']);
   $ivaCover = $this->conversionIVA($_POST['cam_iva']);
   $costofinal = $costo + $costo_log + $kit_reg;
   $restIvaCosto = ($costo > $rangoIva && $precio < $rangoIva) ? $costo - $rangoIva : 0;
   $costofinal = ($canal == "RETAIL") ? $costofinal + ($precio * 0.12) : $costofinal;

   if ($precio >= $rangoIva) {
    $costoConIVA = ($costofinal * $ivaCover);
    $precio = ($precio / $ivaCover);
   }

   $c = 0;
   foreach ($arrayIDS as $id) {
    $listaEquipos[$c] = $this->smartphoneDAO->consultarReferenciaEquipoID($id);
    $c = $c + 1;
   }
    // ESCENARIO SIN PERDIDA
   $datosSimple = $this->escenarioSimple2($costofinal, $precio, $trm, $restIvaCosto);
    // ESCENARIO CON MARGEN DE 10%
   $datosMargen10 = $this->escenarioMargen10($costofinal, $precio, $trm, $restIvaCosto);
   include 'vista/escenariosCampana.php';
  }

  /**
  * Inserta campaña en la BD
  * De acuerdo con el escenario seleccionado
  * trae los valores y usa el metodo insertarCampana()
  * de la clase CampanaDAO
  */
  function insertarCampana(){
   $escenario = $_POST['btn'];
   $arrayIDS = $_POST['array_ids'];
   $descripcion = $_POST['descripcion'];
   $fechaI = $_POST['fecha_inicio'];
   $fechaF = $_POST['fecha_fin'];
   $precio = $_POST['precio'];
   $canal = $_POST['canal'];
   $producto = $_POST['producto'];
   $costo_log = $_POST['costo_log'];
   $iva = $_POST['iva'];
   $trm = $_POST['trm'];
   $uvt = $_POST['uvt'];
   $kit_reg = $_POST['kit_reg'];
   $pluHijo = $_POST['pluHijo'];

   switch ($escenario) {
    case 'esc1':
    $apoyo = $_POST['apoyo1'];
    $subsidio = $_POST['sub1'];
    $margen = $_POST['mar1'];
    break;
    case 'esc2':
    $apoyo = $_POST['apoyo2'];
    $subsidio = $_POST['sub2'];
    $margen = 0.1;
    break;
    case 'esc3':
    $apoyo = $_POST['apoyo3'];
    $subsidio = $_POST['sub3'];
    $margen = $_POST['mar3'];
    break;
   }

   foreach ($arrayIDS as $id) {
    $campanaID['id'] = $id;
    $campanaID['iva'] = $iva;
    $campanaID['trm'] = $trm;
    $campanaID['uvt'] = $uvt;
    $campanaID['canal'] = $canal;
    $campanaID['producto'] = $producto;
    $campanaID['fechaI'] = $fechaI;
    $campanaID['fechaF'] = $fechaF;
    $campanaID['descripcion'] = $descripcion;
    $campanaID['kit_reg'] = ($kit_reg == 0) ? $campanaID['kit_reg'] = "No aplica" : $campanaID['kit_reg'] = $kit_reg;
    $campanaID['costo_log'] = $costo_log;
    $campanaID['precio'] = $precio;
    $campanaID['apoyo'] = $apoyo;
    $campanaID['subsidio'] = $subsidio;
    $campanaID['margen'] = $margen;
    $porcMargen = round($campanaID['margen'], 2);
    $insertarCam = $this->campanaDAO->insertarCampana($campanaID['id'], $campanaID['iva'], $campanaID['trm'], $campanaID['uvt'], $campanaID['canal'],
     $campanaID['producto'], $campanaID['fechaI'], $campanaID['fechaF'], $campanaID['descripcion'], $campanaID['kit_reg'], $campanaID['costo_log'],
     $campanaID['precio'], $campanaID['apoyo'], $campanaID['subsidio'], $porcMargen);
    if ($insertarCam) {
     $this->consultarResumenCampana($insertarCam, $pluHijo, $trm, 1, $kit_reg);
    }else{
     header('Location:' . RESUMEN_CAMPANA['url'] . "?r=2");
    }
   }
  }

  /**
  * Consultar resumen campaña
  * Obtiene el id del ultimo registro y consulta el detalle de 
  * la campaña para visualizarlo en la vista resumenCampana.php
  */
  function consultarResumenCampana($idCampana, $pluHijo, $trm, $r, $kit_reg){
   $listaCampanas = $this->campanaDAO->consultarCampanaporID($idCampana);
   if ($pluHijo != 0) {
    $datosHijo = $this->smartphoneDAO->consultarEquipoPlu($pluHijo);
    foreach ($datosHijo as $dato) {
     $referenciaHijo = $dato->referencia;
    }
    $col = "PLU Regalo";
    $valCol = $pluHijo;
   }else{
    $col = "Kit/Plan";
    $valCol = ($kit_reg != 0) ? '$ '.$kit_reg : 'No aplica';
   }
   include 'vista/resumenCampana.php';
  }

  /**
  * Consultar Campañas
  * Usa el metodo consultarCampana() de la clase
  * CampanaDAO y retorna la vista tablaResumen.php 
  */
  function resumenCampana(){
   $listaCampanas = $this->campanaDAO->consultarCampana();
   include 'vista/tablaResumen.php';
  }

  /**
  * Consultar campañas sin aprobar
  * Usa el metodo consultarCampanaSinAprobar() de la clase
  * CampanaDAO y retorna la vista aprobarCampana.php 
  */
  function consultarCampanasSinAprobar(){
   $listaCampanasAprobar = $this->campanaDAO->consultarCampanaSinAprobar();
   include 'vista/aprobarCampana.php';
  }

  /**
  * Enviar datos Campaña
  * Envia a la vista aprobarCampana.php para calcular
  * el apoyo y el margen de acuerdo a la modificación
  * que se haga.
  */
  function enviarDatosCampana(){
   $idCampana = $_POST['id_campana'];
   $datosCampana = $this->campanaDAO->consultarCampanaporID($idCampana);
   header('Content-Type:application/json');
   echo json_encode($datosCampana);
   return $datosCampana;
  }

  /**
  * Editar y Aprobar Campaña
  * Obtiene los datos del formulario y usa el metodo
  * editarAprobarCampanaPorID de la clase CampanaDAO para
  * editar los datos y el estado de la campaña.
  */
  function editarAprobarCampana(){
   $fechaI = $_POST['cam_fechaI'];
   $fechaF = $_POST['cam_fechaF'];
   $precio = $_POST['cam_precio'];
   $apoyo = $_POST['cam_apoyo'];
   $subsidio = $_POST['cam_subsidio'];
   $margen = round($_POST['cam_margen'], 2); 
   $idCampana = $_POST['id_campana'];
   if ($this->campanaDAO->editarAprobarCampanaPorID($fechaI, $fechaF, $precio, $apoyo, $subsidio, $margen, $idCampana)) {
    header('Location:' . RESUMEN_CAMPANA['url'] . '?r=4');
   }else{
    header('Location:' . INDEX_APROBAR_CAMPANA['url'] . '?r=2');
   }
  }

  /**
  * Aprobar campaña
  * Obtiene el ID de la campaña y usa el metodo aprobarCampanaPorID
  * de la clase CampanaDAO para editar el estado de la campaña.
  */
  function aprobarCampana(){
   $idCampana = $_GET['id_campana'];
   if ($this->campanaDAO->aprobarCampanaPorID($idCampana)) {
    header('Location:' . RESUMEN_CAMPANA['url'] . '?r=4');
   }else{
    header('Location:' . RESUMEN_CAMPANA['url'] . '?r=5');
   }
  }

  /**
  * Exportar Campañas a archivo Excel
  * Trabaja con la libreria PHPExcel.php, usa el metodo
  * consultarCampana() de la clase CampanaDAO para agregar
  * los valores a las celdas
  */
  function exportarData(){
   require_once 'PHPExcel.php';
   $fecha = new DateTime();
   $formateo = $fecha->format('d-m-y');
   $filename = "Apoyos y Provision ". $formateo .'.xlsx';
   $objPHPExcel = new PHPExcel();

    // Agregar Informacion
   $listaCampanas = $this->campanaDAO->consultarCampana();
   if (empty($listaCampanas)) {
    header('Location:' . RESUMEN_CAMPANA['url'] . '?r=3');
   }
   $c = 2;
   foreach ($listaCampanas as $valoresCampana) {
    $objPHPExcel->setActiveSheetIndex(0)
      // TITULOS
    ->setCellValue('A1', 'FECHA INICIO')->setCellValue('B1', 'FECHA FIN')->setCellValue('C1', 'CANAL')->setCellValue('D1', 'PRODUCTO')
    ->setCellValue('E1', 'MARCA')->setCellValue('F1', 'PLU')->setCellValue('G1', 'REFERENCIA')->setCellValue('H1', 'PRECIO')
    ->setCellValue('I1', 'CAMPAÑA')->setCellValue('J1', 'COSTO EQUIPO')->setCellValue('K1', 'COSTO LOG')->setCellValue('L1', 'KIT PRE / REGALO')
    ->setCellValue('M1', 'APOYO')->setCellValue('N1', 'APOYO A PRECIO')->setCellValue('O1', 'SUBSIDIO')->setCellValue('P1', 'MARGEN')

      // VALORES
    ->setCellValue('A'.$c, $valoresCampana->fecha_inicio)
    ->setCellValue('B'.$c, $valoresCampana->fecha_fin)
    ->setCellValue('C'.$c, $valoresCampana->canal)
    ->setCellValue('D'.$c, $valoresCampana->producto)
    ->setCellValue('E'.$c, $valoresCampana->marca)
    ->setCellValue('F'.$c, $valoresCampana->plu)
    ->setCellValue('G'.$c, $valoresCampana->referencia)
    ->setCellValue('H'.$c, $valoresCampana->precio)
    ->setCellValue('I'.$c, $valoresCampana->descripcion)
    ->setCellValue('J'.$c, $valoresCampana->costo_equipo)
    ->setCellValue('K'.$c, $valoresCampana->costo_logistico)
    ->setCellValue('L'.$c, $valoresCampana->kitpre_regalo)
    ->setCellValue('M'.$c, $valoresCampana->apoyo)
    ->setCellValue('N'.$c, $valoresCampana->apoyo *  $valoresCampana->trm)
    ->setCellValue('O'.$c, $valoresCampana->subsidio)
    ->setCellValue('P'.$c, $valoresCampana->margen);

      // Agregar formato de celda
    $objPHPExcel->getActiveSheet()->getStyle('A'.$c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMATO_FECHA);
    $objPHPExcel->getActiveSheet()->getStyle('B'.$c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMATO_FECHA);
    $objPHPExcel->getActiveSheet()->getStyle('H2:L'.$c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMATO_PESOS);
    $objPHPExcel->getActiveSheet()->getStyle('M'.$c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
    $objPHPExcel->getActiveSheet()->getStyle('N2:O'.$c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMATO_PESOS);
    $objPHPExcel->getActiveSheet()->getStyle('P'.$c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE);
    $c = $c+1;
   }

    // Dar estilos a las celdas
   $style_header = array(
    'fill' => array(
     'type' => PHPExcel_Style_Fill::FILL_SOLID,
     'color' => array('rgb'=>'00377B'),
     ),
    'font' => array(
     'bold' => true,
     'size' => 10,
     'color' => array('rgb'=>'FFFFFF'),
     ),
    'alignment' => array(
     'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
     )
    );

   $style = array(
    'font' => array(
     'size' => 10,
     ),
    );
   $objPHPExcel->getActiveSheet()->getStyle('A1:P1')->applyFromArray( $style_header );
   $objPHPExcel->getActiveSheet()->getStyle('A1:P'.$c)->applyFromArray( $style );

    // Renombrar Hoja
   $objPHPExcel->getActiveSheet()->setTitle('Sheet');

    // Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
   $objPHPExcel->setActiveSheetIndex(0);

    // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
   header("Content-Disposition: attachment;filename=$filename");
   header('Cache-Control: max-age=0');
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
   $objWriter->save('php://output');
   exit;
  }

 }