<?php
namespace modelo\vo;

use modelo\generico\IGenericoVO;

/**
 * Clase Vo para la tabla Smartphone de la BD
 */
class Smartphone implements IGenericoVO {

 private $id_smartphone;
 private $plu;
 private $referencia;
 private $marca;
 private $costo_equipo;
 private $estado;
 private $fecha_registro;

    /**
     * Get the value of Id Smartphone
     *
     * @return mixed
     */
    public function getIdSmartphone()
    {
     return $this->id_smartphone;
    }

    /**
     * Set the value of Id Smartphone
     *
     * @param mixed id_smartphone
     *
     * @return self
     */
    public function setIdSmartphone($id_smartphone)
    {
     $this->id_smartphone = $id_smartphone;

     return $this;
    }

    /**
     * Get the value of Plu
     *
     * @return mixed
     */
    public function getPlu()
    {
     return $this->plu;
    }

    /**
     * Set the value of Plu
     *
     * @param mixed plu
     *
     * @return self
     */
    public function setPlu($plu)
    {
     $this->plu = $plu;

     return $this;
    }

    /**
     * Get the value of Referencia
     *
     * @return mixed
     */
    public function getReferencia()
    {
     return $this->referencia;
    }

    /**
     * Set the value of Referencia
     *
     * @param mixed referencia
     *
     * @return self
     */
    public function setReferencia($referencia)
    {
     $this->referencia = $referencia;

     return $this;
    }

    /**
     * Get the value of Marca
     *
     * @return mixed
     */
    public function getMarca()
    {
     return $this->marca;
    }

    /**
     * Set the value of Marca
     *
     * @param mixed marca
     *
     * @return self
     */
    public function setMarca($marca)
    {
     $this->marca = $marca;

     return $this;
    }

    /**
     * Get the value of Costo Equipo
     *
     * @return mixed
     */
    public function getCostoEquipo()
    {
     return $this->costo_equipo;
    }

    /**
     * Set the value of Costo Equipo
     *
     * @param mixed costo_equipo
     *
     * @return self
     */
    public function setCostoEquipo($costo_equipo)
    {
     $this->costo_equipo = $costo_equipo;

     return $this;
    }

    /**
     * Get the value of Estado
     *
     * @return mixed
     */
    public function getEstado()
    {
     return $this->estado;
    }

    /**
     * Set the value of Estado
     *
     * @param mixed estado
     *
     * @return self
     */
    public function setEstado($estado)
    {
     $this->estado = $estado;

     return $this;
    }

    /**
     * Get the value of Fecha Registro
     *
     * @return mixed
     */
    public function getFechaRegistro()
    {
     return $this->fecha_registro;
    }

    /**
     * Set the value of Fecha Registro
     *
     * @param mixed fecha_registro
     *
     * @return self
     */
    public function setFechaRegistro($fecha_registro)
    {
     $this->fecha_registro = $fecha_registro;

     return $this;
    }
    
    /**
    * Función para traer todos los campos de esta clase.
    */
    public function getCampos() {
     $info = array();
     $info['sma_plu'] = $this->plu;
     $info['sma_referencia'] = $this->referencia;
     $info['sma_marca'] = $this->marca;
     $info['sma_costo_equipo'] = $this->costo_equipo;
     
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
     $sigla = ($alias) ? 'sma_' : '';
     foreach ($lista as $campo) {
      if (isset($info[$sigla . $campo])) {
       $this->$campo = $info[$sigla . $campo];
      }
     }
    }

   }
