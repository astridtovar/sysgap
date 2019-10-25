<?php
namespace modelo\generico;

use PDO;

/**
* Clase generica para los DAO
*
*/
abstract class GenericoDAO {

 protected $cnn;
 protected $table;

 /**
 * Constructor de la clase
 */
 public function __construct(&$cnn, $table){
  $this->cnn = $cnn;
  $this->table = $table;
 }

  /**
  * Insertar generico
  * Trae todos los valores del formulario e inserta en
  * la base de datos
  * @return el ultimo id insertado
  */
  public function insertar(IGenericoVO $obj) {
   $listaAtributos = $obj->getCampos();
   $listaCampos = '';
   $listaValores = '';
   $info = array();
   foreach ($listaAtributos as $nombreCampo => $valor) {
    if (is_null($valor)) {
     continue;
    }
    $listaCampos .= ',' . $nombreCampo;
    $listaValores .= ',:' . $nombreCampo;
    $info[$nombreCampo] = $valor;
   }
   $sql = 'INSERT INTO ' . $this->tabla . ' (' . trim($listaCampos, ',') . ') VALUES (' . trim($listaValores, ',') . ') ';

   $sentencia = $this->cnn->prepare($sql);
   $sentencia->execute($info);
   return $this->cnn->lastInsertId();
  }
  
}
