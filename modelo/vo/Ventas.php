<?php
namespace modelo\vo;

use modelo\generico\IGenericoVO;

/**
* Clase VO para la tabla Ventas de la BD
*/
class Ventas implements IGenericoVO{

	private $id_venta;
	private $fecha_venta;
	private $nombre_canal;
	private $plu;
	private $referencia;
	private $marca;

	/**
     * Get the value of Id Campana
     *
     * @return mixed
     */
 public function getIdVenta()
 {
  return $this->id_venta;
 }

    /**
     * Set the value of Id Campana
     *
     * @param mixed id_campana
     *
     * @return self
     */
    public function setIdVenta($id_venta)
    {
     $this->id_venta = $id_venta;

     return $this;
    }

    /**
     * Get the value of Id Campana
     *
     * @return mixed
     */
    public function getFechaVenta()
    {
     return $this->fecha_venta;
    }

    /**
     * Set the value of Id Campana
     *
     * @param mixed id_campana
     *
     * @return self
     */
    public function setFechaVenta($fecha_venta)
    {
     $this->fecha_venta = $fecha_venta;

     return $this;
    }

    /**
     * Get the value of Id Campana
     *
     * @return mixed
     */
    public function getNombreCanal()
    {
     return $this->nombre_canal;
    }

    /**
     * Set the value of Id Campana
     *
     * @param mixed id_campana
     *
     * @return self
     */
    public function setNombreCanal($nombre_canal)
    {
     $this->nombre_canal = $nombre_canal;

     return $this;
    }

    /**
     * Get the value of Id Campana
     *
     * @return mixed
     */
    public function getPlu()
    {
     return $this->plu;
    }

    /**
     * Set the value of Id Campana
     *
     * @param mixed id_campana
     *
     * @return self
     */
    public function setPlu($plu)
    {
     $this->plu = $plu;

     return $this;
    }

    /**
     * Get the value of Id Campana
     *
     * @return mixed
     */
    public function getReferencia()
    {
     return $this->referencia;
    }

    /**
     * Set the value of Id Campana
     *
     * @param mixed id_campana
     *
     * @return self
     */
    public function setReferencia($referencia)
    {
     $this->referencia = $referencia;

     return $this;
    }

    /**
     * Get the value of Id Campana
     *
     * @return mixed
     */
    public function getMarca()
    {
     return $this->marca;
    }

    /**
     * Set the value of Id Campana
     *
     * @param mixed id_campana
     *
     * @return self
     */
    public function setMarca($marca)
    {
     $this->marca = $marca;

     return $this;
    }

    /**
    * Función para traer todos los campos de esta clase.
    */
    public function getCampos() {
     $info = array();
     $info['ven_id_venta'] = $this->id_venta;
     $info['ven_fecha_venta'] = $this->fecha_venta;
     $info['ven_nombre_canal'] = $this->nombre_canal;
     $info['ven_plu'] = $this->plu;
     $info['ven_referencia'] = $this->referencia;
     $info['ven_marca'] = $this->marca;
     return $info;
    }

    /**
    * Función para convertir valores. 
    * Convierte el nombre de los valores traidos del formulario
    * y usarlos en las funciones genericas del DAO
    */
    public function convertir(array $info, $alias = true) {
     $atributos = get_object_vars($this);
     $lista = array_keys($atributos);
     $sigla = ($alias) ? 'ven_' : '';
     foreach ($lista as $campo) {
      if (isset($info[$sigla . $campo])) {
       $this->$campo = $info[$sigla . $campo];
      }
     }
    }

   }