<?php

  class Sedes
  {

    public function getSedes(){

      $sql = "SELECT * FROM sedes";
      $query = new Consulta($sql);

      while ($row = $query->VerRegistro()) {
        $result[] = array(
          'id' => $row['id_sede'],
          'nombre' => $row['nombre_sede']
        );
      }
      return $result;
    }

    public function getSedesID($id){

      $sql = "SELECT u.id_sede,s.nombre_sede,u.utilidad FROM utilidades u
              INNER JOIN sedes s USING(id_sede)
              WHERE u.id_paquete = $id";
      $query = new Consulta($sql);

      while ($row = $query->VerRegistro()) {
        $result[] = array(
          'id' => $row['id_sede'],
          'nombre' => $row['nombre_sede'],
          'utilidad' => $row['utilidad']
        );
      }
      return $result;
    }

  }

 ?>
