<?php
namespace modelo\vo;

use modelo\generico\IGenericoVO;

/**
 * Clase VO para la tabla Campana de la BD
 */
class Campana implements IGenericoVO {

 private $id_campana;
 private $id_smartphone;
 private $iva;
 private $trm;
 private $uvt;
 private $canal;
 private $producto;
 private $fecha_inicio;
 private $fecha_fin;
 private $descripcion;
 private $kitpre_regalo;
 private $costo_logistico;
 private $precio;
 private $apoyo;
 private $subsidio;
 private $margen;
 private $und_vendidas;
 private $apoyo_total;
 private $estado;


    /**
     * Get the value of Id Campana
     *
     * @return mixed
     */
    public function getIdCampana()
    {
     return $this->id_campana;
    }

    /**
     * Set the value of Id Campana
     *
     * @param mixed id_campana
     *
     * @return self
     */
    public function setIdCampana($id_campana)
    {
     $this->id_campana = $id_campana;

     return $this;
    }

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
     * Get the value of Iva
     *
     * @return mixed
     */
    public function getIva()
    {
     return $this->iva;
    }

    /**
     * Set the value of Iva
     *
     * @param mixed iva
     *
     * @return self
     */
    public function setIva($iva)
    {
     $this->iva = $iva;

     return $this;
    }

    /**
     * Get the value of Trm
     *
     * @return mixed
     */
    public function getTrm()
    {
     return $this->trm;
    }

    /**
     * Set the value of Trm
     *
     * @param mixed trm
     *
     * @return self
     */
    public function setTrm($trm)
    {
     $this->trm = $trm;

     return $this;
    }

    /**
     * Get the value of Uvt
     *
     * @return mixed
     */
    public function getUvt()
    {
     return $this->uvt;
    }

    /**
     * Set the value of Uvt
     *
     * @param mixed uvt
     *
     * @return self
     */
    public function setUvt($uvt)
    {
     $this->uvt = $uvt;

     return $this;
    }

    /**
     * Get the value of Canal
     *
     * @return mixed
     */
    public function getCanal()
    {
     return $this->canal;
    }

    /**
     * Set the value of Canal
     *
     * @param mixed canal
     *
     * @return self
     */
    public function setCanal($canal)
    {
     $this->canal = $canal;

     return $this;
    }

    /**
     * Get the value of Producto
     *
     * @return mixed
     */
    public function getProducto()
    {
     return $this->producto;
    }

    /**
     * Set the value of Producto
     *
     * @param mixed producto
     *
     * @return self
     */
    public function setProducto($producto)
    {
     $this->producto = $producto;

     return $this;
    }

    /**
     * Get the value of Fecha Inicio
     *
     * @return mixed
     */
    public function getFechaInicio()
    {
     return $this->fecha_inicio;
    }

    /**
     * Set the value of Fecha Inicio
     *
     * @param mixed fecha_inicio
     *
     * @return self
     */
    public function setFechaInicio($fecha_inicio)
    {
     $this->fecha_inicio = $fecha_inicio;

     return $this;
    }

    /**
     * Get the value of Fecha Fin
     *
     * @return mixed
     */
    public function getFechaFin()
    {
     return $this->fecha_fin;
    }

    /**
     * Set the value of Fecha Fin
     *
     * @param mixed fecha_fin
     *
     * @return self
     */
    public function setFechaFin($fecha_fin)
    {
     $this->fecha_fin = $fecha_fin;

     return $this;
    }

    /**
     * Get the value of Descripcion
     *
     * @return mixed
     */
    public function getDescripcion()
    {
     return $this->descripcion;
    }

    /**
     * Set the value of Descripcion
     *
     * @param mixed descripcion
     *
     * @return self
     */
    public function setDescripcion($descripcion)
    {
     $this->descripcion = $descripcion;

     return $this;
    }

    /**
     * Get the value of Kitpre Regalo
     *
     * @return mixed
     */
    public function getKitpreRegalo()
    {
     return $this->kitpre_regalo;
    }

    /**
     * Set the value of Kitpre Regalo
     *
     * @param mixed kitpre_regalo
     *
     * @return self
     */
    public function setKitpreRegalo($kitpre_regalo)
    {
     $this->kitpre_regalo = $kitpre_regalo;

     return $this;
    }

    /**
     * Get the value of Costo Logistico
     *
     * @return mixed
     */
    public function getCostoLogistico()
    {
     return $this->costo_logistico;
    }

    /**
     * Set the value of Costo Logistico
     *
     * @param mixed costo_logistico
     *
     * @return self
     */
    public function setCostoLogistico($costo_logistico)
    {
     $this->costo_logistico = $costo_logistico;

     return $this;
    }

    /**
     * Get the value of Precio
     *
     * @return mixed
     */
    public function getPrecio()
    {
     return $this->precio;
    }

    /**
     * Set the value of Precio
     *
     * @param mixed precio
     *
     * @return self
     */
    public function setPrecio($precio)
    {
     $this->precio = $precio;

     return $this;
    }

    /**
     * Get the value of Apoyo
     *
     * @return mixed
     */
    public function getApoyo()
    {
     return $this->apoyo;
    }

    /**
     * Set the value of Apoyo
     *
     * @param mixed apoyo
     *
     * @return self
     */
    public function setApoyo($apoyo)
    {
     $this->apoyo = $apoyo;

     return $this;
    }

    /**
     * Get the value of Subsidio
     *
     * @return mixed
     */
    public function getSubsidio()
    {
     return $this->subsidio;
    }

    /**
     * Set the value of Subsidio
     *
     * @param mixed subsidio
     *
     * @return self
     */
    public function setSubsidio($subsidio)
    {
     $this->subsidio = $subsidio;

     return $this;
    }

    /**
     * Get the value of Margen
     *
     * @return mixed
     */
    public function getMargen()
    {
     return $this->margen;
    }

    /**
     * Set the value of Margen
     *
     * @param mixed margen
     *
     * @return self
     */
    public function setMargen($margen)
    {
     $this->margen = $margen;

     return $this;
    }

    public function getUnd_vendidas()
    {
     return $this->und_vendidas;
    }
    
    public function setUnd_vendidas($und_vendidas)
    {
     $this->und_vendidas = $und_vendidas;
     return $this;
    }

    public function getApoyo_total()
    {
     return $this->apoyo_toal;
    }
    
    public function setApoyo_total($apoyo_total)
    {
     $this->apoyo_total = $apoyo_total;
     return $this;
    }

    public function getEstado()
    {
     return $this->estado;
    }
    
    public function setEstado($estado)
    {
     $this->estado = $estado;
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
     $sigla = ($alias) ? 'cam_' : '';
     foreach ($lista as $campo) {
      if (isset($info[$sigla . $campo])) {
       $this->$campo = $info[$sigla . $campo];
      }
     }
    }

   }
