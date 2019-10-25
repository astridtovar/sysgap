<?php
namespace control\generico;

use PDO;

/**
* Clase generica para los controladores
*
*/
abstract class GenericoControl {

 /**
 * @var PDO
 */
 protected $cnn;

 /**
 * Función constructora de la clase
 */
 public function __construct(&$cnn) {
  $this->cnn = $cnn;
 }

}
