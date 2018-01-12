<?php
// Proyecto: Sistema Develoweb
// Version: 1.0
// Programador: GIancarlo leandro
// Framework: Develoweb Version: 2.0
// Clase: Sede
// Fecha 9/01/2018

/** relaciones */

  class Sede
  {

    private $_id;
    private $_id_pais;
    private $_nombre;
    private $_utilidad;

    public function __construct($id = 0){
  		$this->_id = $id;
  		if($this->_id > 0){
  			$sql = " SELECT * FROM sedes WHERE  id_sede ='".$this->_id."'  ";
  			$query = new Consulta($sql);
  			if($query->NumeroRegistros() > 0){
  				$row = $query->VerRegistro();
  				$this->_nombre 		  	= $row['nombre_sede'];
          $this->_id_pais       = $row['id_pais'];
  				$this->_utilidad     = $row['utilidad_sede'];
  			}
  		}
  	}

    public function __get($attribute){
        return	$this->$attribute;
    }

  }

 ?>
