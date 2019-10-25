<?php
namespace modelo\vo;

use modelo\generico\IGenericoVO;

/**
 * Clase VO para la tabla Aprobacion de la BD
 */
Class Aprobacion implements IGenericoVO{

	private $id_aprobacion;
	private $id_campana;
	private $url_aprobacion;

	public function getId_aprobacion()
	{
		return $this->id_aprobacion;
	}
	
	public function setId_aprobacion($id_aprobacion)
	{
		$this->id_aprobacion = $id_aprobacion;
		return $this;
	}

	public function getId_campana()
	{
		return $this->id_campana;
	}
	
	public function setId_campana($id_campana)
	{
		$this->id_campana = $id_campana;
		return $this;
	}

	public function getUrl_aprobacion()
	{
		return $this->url_aprobacion;
	}
	
	public function setUrl_aprobacion($url_aprobacion)
	{
		$this->url_aprobacion = $url_aprobacion;
		return $this;
	}

	/**
 * Función para traer todos los campos de esta clase.
 */
	public function getCampos() {
		$lista = get_object_vars($this);
		return $lista;
	}

 /**
 * Función para convertir valores. 
 * Convierte el nombre de los valores traidos del formulario
 * y usarlos en las funciones genericas del DAO
 */
 public function convertir(array $info, $alias = true) {
 	$atributos = get_object_vars($this);
 	$lista = array_keys($atributos);
 	$sigla = ($alias) ? 'apr_' : '';
 	foreach ($lista as $campo) {
 		if (isset($info[$sigla . $campo])) {
 			$this->$campo = $info[$sigla . $campo];
 		}
 	}
 }
}