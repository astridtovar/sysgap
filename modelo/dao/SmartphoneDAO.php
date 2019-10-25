<?php
namespace modelo\dao;

use modelo\generico\GenericoDAO;
use PDO;

/**
* Clase SmartphoneDAO extiende de la clase GenericoDAO
*/
class SmartphoneDAO extends GenericoDAO {

    /**
    * Constructor de la clase
    */
    public function __construct(&$cnn) {
        parent::__construct($cnn, 'smartphone');
    }

    /**
    * Query para insertar datos en la tabla Equipo de la BD
    * @return Boolean
    */
    function insertarEquipo($plu, $referencia, $marca, $costo_equipo, $fecha_registro){
        $sentencia = $this->cnn->prepare("INSERT INTO smartphone (plu, referencia, marca, costo_equipo, fecha_registro) VALUES (:plu, :referencia, :marca, :costo_equipo, :fecha_registro)");
        return $sentencia->execute(array('plu' => $plu, 'referencia' => $referencia, 'marca' => $marca, 'costo_equipo' => $costo_equipo, 'fecha_registro' => $fecha_registro));
    }

    /**
    * Query para modificar el costo y la fecha de registro del equipo
    * @return Boolean
    */
    function actualizarEquipo($costo_equipo, $fecha_registro, $plu){
        $sentencia = $this->cnn->prepare("UPDATE smartphone SET costo_equipo = :costo_equipo, fecha_registro = :fecha_registro WHERE plu = :plu");
        return $sentencia->execute(array('costo_equipo' => $costo_equipo, 'fecha_registro' => $fecha_registro, 'plu' => $plu));
    }

    /**
    * Query para consultar datos en la tabla Equipo de la BD
    * @return Array del resultado de la sentencia
    */
    function consultarEquipo(){
    	$sentencia = $this->cnn->prepare("SELECT * FROM smartphone WHERE estado = 1");
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

    /**
    * Query para consultar datos  asociados a un ID en la tabla Equipo de la BD
    * @return Array del resultado de la sentencia
    */
    function consultarEquipoID($id_smartphone){
        $sentencia = $this->cnn->prepare("SELECT * FROM smartphone WHERE id_smartphone = :id_smartphone");
        $sentencia->execute(array('id_smartphone' => $id_smartphone));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

    /**
    * Query para editar datos en la tabla Equipo de la BD
    * @return Boolean
    */
    function editarEquipo($plu, $referencia, $marca, $costo_equipo, $id_s){
        $sentencia = $this->cnn->prepare("UPDATE smartphone SET plu = :plu, referencia = :referencia, marca = :marca, costo_equipo = :costo_equipo WHERE id_smartphone = :id_s");
        return $sentencia->execute(array('plu' => $plu, 'referencia' => $referencia, 'marca' => $marca, 'costo_equipo' => $costo_equipo, 'id_s' => $id_s));
    }

    /**
    * Query para cambiar el estado de una fila en la tabla Equipo de la BD
    * @return Boolean
    */
    function eliminarEquipo($id_smartphone){
        $sentencia = $this->cnn->prepare("UPDATE smartphone SET estado = 2 WHERE id_smartphone = :id_smartphone");
        return $sentencia->execute(array('id_smartphone' => $id_smartphone));
    }

    /**
    * Query para consultar la ultima fecha de registro de la tabla Smartphone
    * @return si no esta vacio, el array de la consulta
    */
    function consultarUltimaCarga($cnn){
        $sentencia = $cnn->prepare("SELECT fecha_registro FROM `smartphone` ORDER BY fecha_registro DESC LIMIT 1");
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ); 
        if (!empty($consulta)) {
            return $consulta[0];
        }
    }

    /**
    * Query para cambiar el estado de los registros
    * @return Boolean 
    */
    function cambiarEstado($fechaUltimoRegistro){
        $sentencia = $this->cnn->prepare("UPDATE smartphone SET estado = 2 WHERE fecha_registro <= :fecha_registro");
        return $sentencia->execute(array('fecha_registro' => $fechaUltimoRegistro));
    }

    /**
    * Query para consultar Smartphone por PLU
    * @return array del resultado de la sentencia
    */
    function consultarEquipoPlu($plu){
        $sentencia = $this->cnn->prepare("SELECT * FROM smartphone WHERE plu = :plu");
        $sentencia->execute(array('plu' => $plu));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

    /**
    * Query para consultar Smartphone por PLU con estado Activo
    * @return array del resultado de la sentencia
    */
    function consultarPorPlu($plu){
        $sentencia = $this->cnn->prepare("SELECT referencia, marca FROM smartphone WHERE plu = :plu and estado = 1");
        $sentencia->execute(array('plu' => $plu));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }

    /**
    * Query para consultar la referencia de un equipo por ID
    * @return array del resultado de la consulta
    */
    function consultarReferenciaEquipoID($id_smartphone){
        $sentencia = $this->cnn->prepare("SELECT referencia FROM smartphone WHERE id_smartphone = :id_smartphone");
        $sentencia->execute(array('id_smartphone' => $id_smartphone));
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta[0];
    }

    /**
    * Query para consultar las marcas de los equipos registrados
    * @return Array del resultado de la consulta
    */
    function consultarMarcasRegistradas(){
        $sentencia = $this->cnn->prepare("SELECT DISTINCT marca FROM smartphone WHERE marca != 'OTROS' ORDER BY marca ASC");
        $sentencia->execute();
        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $consulta;
    }
}
