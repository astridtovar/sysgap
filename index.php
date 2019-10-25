<?php
require_once './cargar.php';
require_once './rutas.php';

use modelo\base_datos\Conexion;
use control\EquipoControl;
use modelo\dao\SmartphoneDAO;

// Establece conexion con la BD 
$cnn = Conexion::conectar();

/** Valida si no existe una ruta
* Usa el metodo consultarUltimoRegistro de EquipoControl
* valida si existe el dato que este retorna y de acuerdo con
* el retorna la vista principal o la vista actualizarDataEquipos
*/
if (!isset($_SERVER['PATH_INFO'])) {
    $fechaRegistro = EquipoControl::consultarUltimoRegistro($cnn);
    if (!isset($fechaRegistro)) {
        header('Location:' . INDEX['url']);
        return;
    }else{
        include 'vista/actualizarDataEquipos.php';
        return;
    }
}

// Crea la ruta
$ruta = URL_PRINCIPAL . $_SERVER['PATH_INFO'];

/**
* Obtiene todas las costantes definidas (rutas.php)
* y recorre este Array
*/
foreach (get_defined_constants() as $constantte) {
    if (!is_array($constantte)) {
        continue;
    }

    /**
    * Usa el metodo consultarUltimoRegistro de EquiposControl
    * valida si este retorna $fechaRegistro y visualiza+
    * la vista para actulizar la data
    */
    $fechaRegistro = EquipoControl::consultarUltimoRegistro($cnn);
    if (isset($fechaRegistro)) {
        header('Location:' . INDEX_ACTUALIZAR_DATA['url']);
    }

    if ($ruta == $constantte['url']) {
        $clase = '\\control\\' . $constantte['clase'];
        $metodo = $constantte['metodo'];
        $obj = new $clase($cnn);
        $obj->$metodo();
        break;
    }
}