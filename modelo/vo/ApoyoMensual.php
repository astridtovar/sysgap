<?php
namespace modelo\vo;

use modelo\generico\IGenericoVO;

/**
 * Clase VO para la tabla Apoyo_Mensual de la BD
 */
Class ApoyoMensual implements IGenericoVO {

	private $id_apoyo;
	private $mes;
	private $text_mes;
	private $marca;
	private $apoyo_total;

	public function getId_apoyo()
	{
		return $this->id_apoyo;
	}
	
	public function setId_apoyo($id_apoyo)
	{
		$this->id_apoyo = $id_apoyo;
		return $this;
	}

	public function getMes()
	{
		return $this->mes;
	}
	
	public function setMes($mes)
	{
		$this->mes = $mes;
		return $this;
	}

	public function getText_mes()
	{
		return $this->text_mes;
	}
	
	public function setText_mes($text_mes)
	{
		$this->text_mes = $text_mes;
		return $this;
	}

	public function getMarca()
	{
		return $this->marca;
	}
	
	public function setMarca($marca)
	{
		$this->marca = $marca;
		return $this;
	}

	public function getApoyo_total()
	{
		return $this->apoyo_total;
	}
	
	public function setApoyo_total($apoyo_total)
	{
		$this->apoyo_total = $apoyo_total;
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
 	$sigla = ($alias) ? 'apo_' : '';
 	foreach ($lista as $campo) {
 		if (isset($info[$sigla . $campo])) {
 			$this->$campo = $info[$sigla . $campo];
 		}
 	}
 }

}