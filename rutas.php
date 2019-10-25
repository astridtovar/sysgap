<?php

define('RUTA_PRINCIPAL', __DIR__);
define('PROYECTO', '/apoyos_devices/');
define('PROYECTO_RECURSOS_CSS',  PROYECTO. 'vista/css/');
define('PROYECTO_RECURSOS_JS', PROYECTO. 'vista/js/');
define('PROYECTO_RECURSOS_IMGS', PROYECTO. 'vista/imgs/');
define('PROYECTO_RECURSOS_IMGS_USERS', PROYECTO. 'vista/imgs/imgs-users/');
define('PROYECTO_RECURSOS_PLUGINS', PROYECTO. 'vista/plugins/');
define('URL_PRINCIPAL', PROYECTO . 'index.php');
define('FORMATO_CARGA_MASIVA', PROYECTO . 'archivos/formato-carga-masiva.xlsx');
define('FORMATO_CARGA_VENTAS', PROYECTO . 'archivos/formato-cargar-ventas.xlsx');
define('MANUAL_DE_USUARIO_GAP', PROYECTO . 'archivos/Manual_de_Usuario_SysGAP.pdf');
define('CARPETA_APROBACIONES', PROYECTO . 'archivos/aprobaciones/');

define('INDEX', array(
    'clase' => 'EquipoControl',
    'metodo' => 'index',
    'url' => URL_PRINCIPAL .'/'));

define('INDEX_ACTUALIZAR_DATA', array(
    'clase' => 'EquipoControl',
    'metodo' => 'indexActualizarData',
    'url' => URL_PRINCIPAL));

define('ACTUALIZAR_DATA', array(
    'clase' => 'EquipoControl',
    'metodo' => 'actualizarData',
    'url' => URL_PRINCIPAL .'/actualizar/guardar'));

define('REGISTRAR_EQUIPO', array(
    'clase' => 'EquipoControl',
    'metodo' => 'registrarEquipo',
    'url' => URL_PRINCIPAL . '/equipo/registrar'));

define('GUARDAR_EQUIPO', array(
    'clase' => 'EquipoControl',
    'metodo' => 'guardarEquipo',
    'url' => URL_PRINCIPAL . '/equipo/guardar'));

define('CARGAR_ARCHIVO', array(
    'clase' => 'EquipoControl',
    'metodo' => 'cargarArchivo',
    'url' => URL_PRINCIPAL . '/equipo/archivo/cargar'));

define('GUARDAR_ARCHIVO', array(
    'clase' => 'EquipoControl',
    'metodo' => 'guardarArchivo',
    'url' => URL_PRINCIPAL . '/equipo/archivo/guardar'));

define('CONSULTAR_EQUIPOS', array(
    'clase' => 'EquipoControl',
    'metodo' => 'consultarEquipos',
    'url' => URL_PRINCIPAL . '/equipo/consultar'));

define('INDEX_EDITAR_EQUIPO', array(
    'clase' => 'EquipoControl',
    'metodo' => 'indexEditarEquipo',
    'url' => URL_PRINCIPAL . '/equipo/editar'));

define('EDITAR_EQUIPO', array(
    'clase' => 'EquipoControl',
    'metodo' => 'editarEquipo',
    'url' => URL_PRINCIPAL . '/equipo/editar/guardar'));

define('ELIMINAR_EQUIPO', array(
    'clase' => 'EquipoControl',
    'metodo' => 'eliminarEquipo',
    'url' => URL_PRINCIPAL . '/equipo/eliminar'));

define('INDEX_REGISTRAR_CAMPANA', array(
    'clase' => 'CampanaControl',
    'metodo' => 'index',
    'url' => URL_PRINCIPAL . '/campana'));

define('CALCULAR_CAMPANA', array(
    'clase' => 'CampanaControl',
    'metodo' => 'calcularCampana',
    'url' => URL_PRINCIPAL . '/campana/escenarios'));

define('INSERTAR_CAMPANA', array(
    'clase' => 'CampanaControl',
    'metodo' => 'insertarCampana',
    'url' => URL_PRINCIPAL . '/campana/escenarios/guardar'));

define('RESUMEN_DATA_CAMPANA', array(
    'clase' => 'CampanaControl',
    'metodo' => 'consultarResumenCampana',
    'url' => URL_PRINCIPAL . '/campana/escenarios/resumen'));

define('INDEX_APROBAR_CAMPANA', array(
    'clase' => 'CampanaControl',
    'metodo' => 'consultarCampanasSinAprobar',
    'url' => URL_PRINCIPAL . '/campana/consultar/revision'));

define('INDEX_EDITAR_CAMPANA', array(
    'clase' => 'CampanaControl',
    'metodo' => 'enviarDatosCampana',
    'url' => URL_PRINCIPAL . '/campana/consultar/revision/editar/'));

define('EDITAR_APROBAR_CAMPANA', array(
    'clase' => 'AprobacionControl',
    'metodo' => 'editarYAprobarCampana',
    'url' => URL_PRINCIPAL . '/campana/consultar/revision/editar/aprobar'));

define('APROBAR_CAMPANA', array(
    'clase' => 'CampanaControl',
    'metodo' => 'aprobarCampana',
    'url' => URL_PRINCIPAL . '/campana/consultar/revision/aprobar'));

define('ENVIAR_APROBACION_CAMPANA', array(
    'clase' => 'AprobacionControl',
    'metodo' => 'obtenerArchivos',
    'url' => URL_PRINCIPAL . '/campana/consultar/revision/aprobar/archivos'));

define('RESUMEN_CAMPANA', array(
    'clase' => 'CampanaControl',
    'metodo' => 'resumenCampana',
    'url' => URL_PRINCIPAL . '/campana/consultar_resumen'));

define('INDEX_CONSULTAR_APROBACIONES', array(
    'clase' => 'AprobacionControl',
    'metodo' => 'consultarAprobaciones',
    'url' => URL_PRINCIPAL . '/campana/consultar_resumen/aprobacion'));

define('EXPORTAR_CAMPANA', array(
    'clase' => 'CampanaControl',
    'metodo' => 'exportarData',
    'url' => URL_PRINCIPAL . '/campana/exportar'));

define('GENERAR_REPORTE_INDEX', array(
    'clase' => 'VentasControl',
    'metodo' => 'indexReporte',
    'url' => URL_PRINCIPAL . '/reporte'));

define('CARGAR_VENTAS', array(
    'clase' => 'VentasControl',
    'metodo' => 'cargarVentas',
    'url' => URL_PRINCIPAL . '/reporte/cargar'));

define('INDEX_CARGAR_VENTAS', array(
    'clase' => 'VentasControl',
    'metodo' => 'indexCargarVentas',
    'url' => URL_PRINCIPAL . '/reporte/cargar-ventas'));

define('GENERAR_REPORTE', array(
    'clase' => 'VentasControl',
    'metodo' => 'indexGenerar',
    'url' => URL_PRINCIPAL . '/reporte/generar'));

define('MARGEN_PROMEDIO_MARCA', array(
    'clase' => 'VentasControl',
    'metodo' => 'margenPromedioMarca',
    'url' => URL_PRINCIPAL . '/reporte/generar/margen-promedio-marca'));

define('MARGEN_PROMEDIO_GAMA', array(
    'clase' => 'VentasControl',
    'metodo' => 'margenPromedioGama',
    'url' => URL_PRINCIPAL . '/reporte/generar/margen-promedio-gama'));

define('TOTAL_APOYOS_CAMPANAS', array(
    'clase' => 'VentasControl',
    'metodo' => 'totalApoyosCampanas',
    'url' => URL_PRINCIPAL . '/liquidacion'));

define('TOTAL_APOYOS_MES', array(
    'clase' => 'VentasControl',
    'metodo' => 'obtenerTotalApoyoMes',
    'url' => URL_PRINCIPAL . '/total-apoyos/mes'));

define('EXPORTAR_LIQUIDACION', array(
    'clase' => 'VentasControl',
    'metodo' => 'filtrarLiquidacion',
    'url' => URL_PRINCIPAL . '/liquidacion/exportar')); 