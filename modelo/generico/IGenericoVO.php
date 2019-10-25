<?php
namespace modelo\generico;

/**
* Clase generica para los VO
*
*/
interface IGenericoVO{

	function getCampos();

	function convertir(array $info, $alias = true);

}