<?php
namespace control;

use control\generico\GenericoControl;
use modelo\vo\Ventas;
use modelo\dao\VentasDAO;
use modelo\dao\SmartphoneDAO;
use modelo\dao\CampanaDAO;
use modelo\dao\ApoyoMensualDAO;
use NumberFormatter;
use DateTime;
use DateTimeZone;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use PHPExcel_Style_Alignment;
use PHPExcel_Worksheet;
use PHPExcel_Style_NumberFormat;

/**
* Clase control de la tabla Ventas extiende de la tabla Generico Control
*/
class VentasControl extends GenericoControl {

	private $ventasDAO;
	private $smartphoneDAO;
 private $campanaDAO;
 private $apoyoMensualDAO;

	/**
 * Constructor de la clase
 */
	public function __construct(&$cnn) {
		parent::__construct($cnn);
		$this->ventasDAO = new VentasDAO($cnn);
		$this->smartphoneDAO = new SmartphoneDAO($cnn);
  $this->campanaDAO = new CampanaDAO($cnn);
  $this->apoyoMensualDAO = new ApoyoMensualDAO($cnn);
 }

 /**
 * Visualizar vista Cargar Ventas
 * Retorma la vista cargarVentas.php
 */
 function indexCargarVentas(){
  include 'vista/cargarVentas.php';
 }

 /**
 * Traer Fecha Actual
 * Usa DateTime para obtener la fecha actual
 * @return array $arrayDate
 */
 function traerFechaActual(){
  $arrayDate = new DateTime('America/Bogota');
  return $arrayDate;
 }

 /**
 * Validar actualización data Ventas
 * Obtiene y compara la ultima fecha de registro con la 
 * actual para establecer que interfaz mostrara
 */
 function indexReporte(){
  $consUltimoRegistro = $this->ventasDAO->consultarUltimoRegistro();
  if (!empty($consUltimoRegistro)) {
   $ultimoRegistro = $consUltimoRegistro->fecha_registro;
   $fechaActual = VentasControl::traerFechaActual();
   $mesActual = $fechaActual->format('m');
   $traerMes = str_split($ultimoRegistro);
   $ultimoMes = $traerMes['5'] . $traerMes['6'];
   if ($ultimoMes < $mesActual || $ultimoMes > $mesActual) {
    include 'vista/cargarVentas.php';
    return;
   }
   include 'vista/reportes.php';
  }else{
   include 'vista/cargarVentas.php';
  }
 }

 /**
 * Asignar referencia y marca al equipo vendido
 * Consulta en la tabla smartphone y obtiene la marca
 * y la referencia de un equipo para luego modificar la
 * tabla ventas y asignarle los mismos.
 */
 function asignarRefMar($plu){
  $valores = $this->smartphoneDAO->consultarPorPlu($plu);
  foreach ($valores as $key) {
   $this->ventasDAO->asignarRefMar($key->referencia, $key->marca, $plu);
  }
 }

 /**
 * Insertar datos en la tabla Ventas
 * Obtiene el archivo .csv, lee linea por linea
 * y va insertandola en la BD.
 */
 function cargarVentas(){
  set_time_limit(0);
  $fechaActual = new DateTime('America/Bogota');
  $infofile = $_FILES['ven_archivo_ventas'];
  $location = $infofile['tmp_name'];
  $name = RUTA_PRINCIPAL . '/archivos/' . $infofile['name'];
  $res = 0;
  move_uploaded_file($location, $name);
  $file = fopen($name, 'r');
 	fgets($file); //Se omite la primera línea porque son los titulos de las columnas
 	while (!feof($file)) {
 		$line = fgets($file);
 		if (empty($line)) {
 			continue;
 		}
 		$array = explode(';', $line);
 		if ($array[0] == null || empty($array[0])) {
 			continue;
 		}
   if ($this->ventasDAO->insertarVentas($array[0], $array[1], $array[2], $fechaActual->format('Y-m-d H:i:s'))) {
    $this->asignarRefMar($array[2]);
    $res = 1;
   }
  }
  if ($res != 1) {
   header('Location:' . CARGAR_VENTAS['url'] . '?r=2');
   return;
  }
  header('Location:' . GENERAR_REPORTE['url'] . '?r=1');
  fclose($file);
 }

 /**
 * Cargar vista reportes.php
 */
 function indexGenerar(){
  include 'vista/reportes.php';
 }

 /**
 * Obtener total margen por marca
 * Consulta las campañas por marca y consulta las ventas
 * del plu de cada una de las campañas para posteriormente
 * obtener el margen total por todas las campañas de una marca
 * de acuerdo a las ventas.
 */
 function obtenerTotalMargenCampanaMarca($marca){
  $listaCampanas = $this->ventasDAO->consultarCampana($marca);
  $totalMargenes = 0;
  $totalCantidades = 0;
  foreach ($listaCampanas as $campana) {
   $undsVendidasCam = $this->ventasDAO->consultarApoyoTotalCam($campana->fecha_inicio, $campana->fecha_fin, $campana->plu, $campana->canal);
   foreach ($undsVendidasCam as $cam) {
    $undsXmargen = $cam * $campana->margen;
    $totalMargenes = $totalMargenes + $undsXmargen;
    $totalCantidades = $totalCantidades + $cam;
   }
  }
  $array = array('tMargen' => $totalMargenes, 'tCant' => $totalCantidades);
  return $array;
 }

 /**
 * Obtener margen promedio por marca
 * Usa la función obtenerTotalMargenCampanaMarca para obtener
 * el margen promedio por marca y retornarlo a la vista.
 */
 function margenPromedioMarca(){
  $listaMarcas = $this->smartphoneDAO->consultarMarcasRegistradas();
  $i = 0;
  foreach ($listaMarcas as $marca) {
   $promMarca = $this->obtenerTotalMargenCampanaMarca($marca->marca);
   $promMarca = ($promMarca['tCant'] == 0) ? 0 : $promMarca['tMargen'] / $promMarca['tCant'];
   $promMarca = $promMarca * 100;
   $color = $this->definirColor($marca->marca);
   $array[$i] = array('x' => $i, 'y' => $promMarca, 'label' => $marca->marca, 'color' => $color);
   $i++;
  }
  header('Content-Type:application/json');
  echo json_encode($array);
 }

 /**
 * Asignar gama por PLU
 * Consulta la campaña perteneciente a un plu para obtener su precio
 * y porteriormente asignar una gama de acuerdo a el mismo. Luego
 * modifica la gama en la tabla ventas para el equipo.
 */
 function asignarGama(){
  $campanas = $this->campanaDAO->consultarCampana();
  foreach ($campanas as $campana) {
   $precio = $campana->precio;
   switch ($precio) {
    case $precio <= 200000:
    $gama = "ENTRY";
    break;
    case $precio > 200000 && $precio <= 400000:
    $gama = "MID-LOW";
    break;
    case $precio > 400000 && $precio <= 753940:
    $gama = "MID";
    break;
    case $precio > 753940 && $precio <= 1000000:
    $gama = "MID-HIGH";
    break;
    case $precio > 1000000 && $precio <= 2000000:
    $gama = "HIGH";
    break;
    case $precio > 2000000:
    $gama = "ULTRA-HIGH";
    break;
   }
   $this->campanaDAO->asignarGama($gama, $campana->id_campana);
  }
 }

 /**
 * Obtener margen por gama
 * Consulta la campaña perteneciente a una gama para 
 * obtener su margen total de acuerdo a las ventas de
 * cada campaña.
 */
 function obtenerTotalMargenCampanaGama($gama){
  $listaCampanas = $this->campanaDAO->consultarCampanasPorGama($gama);
  if (!empty($listaCampanas) || $listaCampanas != null) {
   $totalMargenes = 0;
   $totalCantidades = 0;
   foreach ($listaCampanas as $campana) {
    $undsVendidasCam = $this->ventasDAO->consultarApoyoTotalCam($campana->fecha_inicio, $campana->fecha_fin, $campana->plu, $campana->canal);
    foreach ($undsVendidasCam as $cam) {
     $undsXmargen = $cam * $campana->margen;
     $totalMargenes = $totalMargenes + $undsXmargen;
     $totalCantidades = $totalCantidades + $cam;
    }
   }
   $array = array('tMargen' => $totalMargenes, 'tCant' => $totalCantidades);
   return $array;
  }
 }

 /**
 * Obtener margen promedio por Gama
 * Usa la función obtenerTotalMargenCampanaGama para
 * obtener el margen promedio por cada una de las gamas
 * y retornarlo en un array a la vista
 */
 function margenPromedioGama(){
  $this->asignarGama();
  $listaGamas = $this->ventasDAO->consultarGamasRegistradas();
  $i = 0;
  foreach ($listaGamas as $gama) {
   $promGama = $this->obtenerTotalMargenCampanaGama($gama->gama);
   $promGama = (isset($promGama) && $promGama['tCant'] > 0) ? $promGama['tMargen'] / $promGama['tCant'] : 0;
   $promGama = $promGama * 100;
   $array[$i] = array('x' => $i, 'y' => $promGama, 'label' => $gama->gama);
   $i++;
  }
  header('Content-Type:application/json');
  echo json_encode($array);
 }

 /**
 * Cargar vista consultarApoyosCampanas.php
 */
 function totalApoyosCampanas(){
  $fechaActual = new DateTime('America/Bogota');
  $fechaMesAnho = $fechaActual->format('m-y');
  $mesActual = $fechaActual->format('m');
  $mesSinCero = $fechaActual->format('n');
  $listaMarcas = $this->campanaDAO->consultarMarcasCampana();
  $listaCampanas = $this->campanaDAO->consultarCampana();
  $this->obtenerTotalApoyoCampana($listaCampanas);
  include 'vista/consultarApoyosCampanas.php';
 }

 /**
 * Obtener el apoyo total de la campaña
 * Consulta todas las campañas y para cada una de ellas
 * la cantidad de equipos vendidos para obtener apoyo total.
 */
 function obtenerTotalApoyoCampana($listaCampanas){
  foreach ($listaCampanas as $campana) { 
   $id_campana = $campana->id_campana;
   $fechaI = $campana->fecha_inicio;
   $fechaF = $campana->fecha_fin;
   $plu = $campana->plu;
   $canal = $campana->canal;
   $apoyo = $campana->apoyo;
   $listaCantidades = $this->ventasDAO->consultarApoyoTotalCam($fechaI, $fechaF, $plu, $canal);
   foreach ($listaCantidades as $cantidad) { 
    $totalApoyoCampana = $apoyo * $cantidad;
    $this->campanaDAO->agregarUndsVendidasCam($cantidad, $totalApoyoCampana, $id_campana);
   };
  }
 }

 /**
 * Obtener el mes en formato de texto
 * De acuerdo a el parametro que se le pase
 * evalua y retorna el mes en formato de texto.
 */
 function obtenerMesTexto($i){
  switch ($i) {
   case '1':
   $mes = 'Ene';
   break;
   case '2':
   $mes = 'Feb';
   break;
   case '3':
   $mes = 'Mar';
   break;
   case '4':
   $mes = 'Abr';
   break;
   case '5':
   $mes = 'May';
   break;
   case '6':
   $mes = 'Jun';
   break;
   case '7':
   $mes = 'Jul';
   break;
   case '8':
   $mes = 'Ago';
   break;
   case '9':
   $mes = 'Sep';
   break;
   case '10':
   $mes = 'Oct';
   break;
   case '11':
   $mes = 'Nov';
   break;
   case '12':
   $mes = 'Dic';
   break;
  }
  return $mes;
 }

 /**
 * Obtener el apoyo total del mes por marca
 * Consulta las campañas por mes y las cantidades vendidas
 * para retornar un array por marca con el apoyo para el mes.
 * Usa insertarModificarApoyosMensual para insertar o modificar
 * el apoyo del mes por cada marca.
 */
 function obtenerTotalApoyoMes(){
  for ($i=0; $i < 12; $i++) { 
   $listaMarcas = $this->smartphoneDAO->consultarMarcasRegistradas();
   foreach ($listaMarcas as $marca) {
    $apoyoTotal = 0;
    $apoyocampana = $this->campanaDAO->consultarApoyoTotalMarca($marca->marca, $i);
    foreach ($apoyocampana as $apoyo) {
     $apoyoTotal = $apoyoTotal + $apoyo->apoyo_total;
     $mesTxt = $this->obtenerMesTexto($i);
     $array = array('mes' => $i, 'marca' => $marca->marca, 'txtM' => $mesTxt, 'apoyo' => $apoyoTotal);
     $this->insertarModificarApoyosMensual($array);
    }
   }
  }
  $this->consultarApoyosMensuales();
 }

 /**
 * Insertar o Modificar Apoyos Mensuales
 * Inserta y/o modifica apoyos mensuales de la
 * base de datos.
 */
 function insertarModificarApoyosMensual($array){
  $consultaUnique = $this->apoyoMensualDAO->consultarUniqueMesMarca($array['mes'], $array['marca']);
  if (!empty($consultaUnique)){
   $this->apoyoMensualDAO->modificarApoyoMensual($array['mes'], $array['txtM'], $array['marca'], $array['apoyo']);
  }else {
   $this->apoyoMensualDAO->insertarApoyoMensual($array['mes'], $array['txtM'], $array['marca'], $array['apoyo']);
  }
 }

 /**
 * Definir Colores por Marca
 * Define el color que aparecerá en el grafico
 * de acuerdo a la marca.
 * @return $color
 */
 function definirColor($marca){
  switch ($marca) {
   case 'HUAWEI':
   $color = '#A60A17';
   break;
   case 'SAMSUNG':
   $color = '#0F50A6';
   break;
   case 'MOTOROLA':
   $color = '#95BF3B';
   break;
   case 'APPLE':
   $color = '#8C8C8C';
   break;
   case 'POLAROID':
   $color = '#F25C05';
   break;
   default:
   $color = '#00377b';
   break;
  }

  return $color;
 }

 /**
 * Consulta Apoyos Mensuales
 * Consulta la tabla apoyos mensuales y envia los datos a
 * la vista reportes.php
 */
 function consultarApoyosMensuales(){
  $listaMarcas = $this->smartphoneDAO->consultarMarcasRegistradas();
  $i = 0;
  foreach ($listaMarcas as $marca) {
   $listaApoyosMensuales = $this->apoyoMensualDAO->consultarApoyosMensualesMarca($marca->marca);
   $color = $this->definirColor($marca->marca);
   $array[$i] = array('type' => "spline", 'showInLegend' => true, 'name' => $marca->marca, 'color' => $color, 'dataPoints' => $listaApoyosMensuales);
   $arrayData = $array;
   $i++;
  }
  header('Content-Type:application/json');
  echo json_encode($arrayData, JSON_NUMERIC_CHECK);

 }

 /**
 * Filtrar liquidación
 * Obtiene los datos traidos por POST de la vista
 * para consultar de acuerdo a ellos y usa la función
 * exportarLiquidacion para exportar esta consulta.
 */
 function filtrarLiquidacion(){
  $mes = $_POST['exp_mes'];
  $marca = $_POST['exp_marca'];
  if ($mes == "all" && $marca == "all") {
   $listaCampanas = $this->campanaDAO->consultarCampana();
  }
  if ($mes == "all" && $marca != "all") {
   $listaCampanas = $this->campanaDAO->consultarCampanaPorMarca($marca);
  }
  if ($marca == "all" && $mes != "all") {
   $listaCampanas = $this->campanaDAO->consultarCampanaPorMes($mes);
  }
  if ($mes != "all" && $marca != "all") {
   $listaCampanas = $this->campanaDAO->consultarCampanaPorMesYMarca($mes, $marca);
  }
  $this->exportarLiquidacion($listaCampanas, $marca, $mes);
 }

 /**
 * Exportar liquidación
 * Verifica el parametro listaCampanas no esta vacio, de no estarlo,
 * usa la clase PHPExcel y exporta a formato Excel la consulta.
 */
 function exportarLiquidacion($listaCampanas, $marca, $mes){
  if (empty($listaCampanas) || $listaCampanas == null) {
   header('Location:' . TOTAL_APOYOS_CAMPANAS['url'] . "?r=3");
   return;
  }
  require_once 'PHPExcel.php';
  $fecha = new DateTime();
  $anho = $fecha->format('y');
  $filename = "liquidacion_apoyos_". $marca . '_' . $mes . '-' . $anho . '.xlsx';
  $objPHPExcel = new PHPExcel();
  $c = 2;
  foreach ($listaCampanas as $valoresCampana) {
   $objPHPExcel->setActiveSheetIndex(0)
   ->setCellValue('A1', 'FECHA INICIO')
   ->setCellValue('B1', 'FECHA FIN')
   ->setCellValue('C1', 'CANAL')
   ->setCellValue('D1', 'CAMPAÑA')
   ->setCellValue('E1', 'MARCA')
   ->setCellValue('F1', 'PLU')
   ->setCellValue('G1', 'REFERENCIA')
   ->setCellValue('H1', 'UND. VENDIDAS')
   ->setCellValue('I1', 'APOYO UNITARIO')
   ->setCellValue('J1', 'TOTAL APOYO')
   ->setCellValue('A'.$c, $valoresCampana->fecha_inicio)
   ->setCellValue('B'.$c, $valoresCampana->fecha_fin)
   ->setCellValue('C'.$c, $valoresCampana->canal)
   ->setCellValue('D'.$c, $valoresCampana->descripcion)
   ->setCellValue('E'.$c, $valoresCampana->marca)
   ->setCellValue('F'.$c, $valoresCampana->plu)
   ->setCellValue('G'.$c, $valoresCampana->referencia)
   ->setCellValue('H'.$c, $valoresCampana->und_vendidas)
   ->setCellValue('I'.$c, $valoresCampana->apoyo)
   ->setCellValue('J'.$c, $valoresCampana->apoyo_total);

   $objPHPExcel->getActiveSheet()->getStyle('A'.$c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMATO_FECHA);
   $objPHPExcel->getActiveSheet()->getStyle('B'.$c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMATO_FECHA);
   $objPHPExcel->getActiveSheet()->getStyle('I'.$c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
   $objPHPExcel->getActiveSheet()->getStyle('J'.$c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD);
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
   $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray( $style_header );
   $objPHPExcel->getActiveSheet()->getStyle('A1:J'.$c)->applyFromArray( $style );

  $objPHPExcel->getActiveSheet()->setTitle('Sheet');
  $objPHPExcel->setActiveSheetIndex(0);
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header("Content-Disposition: attachment;filename=$filename");
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save('php://output');
  exit;
 }

}