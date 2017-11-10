<?php 
include_once("../inc.core.php");
function my_autoloader($class) {
	if(file_exists( _model_.$class.'.php'  )){
		include _model_.$class.'.php';
	}
}

spl_autoload_register('my_autoloader');

$saltar = "\n";
//$saltar = "<br>";
$ruta_fichero = '../aplication/model/';
$ruta_fichero_admin = '../dw-admin/';

$link = new Conexion($_config['bd']['server'],$_config['bd']['user'],$_config['bd']['password'],$_config['bd']['name']);

$cantidad_campos = $_POST['val_itemcampo'];
$nombre_tabla = $_POST['nombre_tabla'];
$prefijo = $_POST['prefijo_campo'];


/*echo "Nombre Tabla: ".$nombre_tabla."<br>";
echo "Prefijo Campo: ".$prefijo."<br>";
echo "<br>";
echo "Nombre: id_".$prefijo."<br>";
echo "Tipo: int<br>";
echo "Tamano: 11<br>";
echo "Comentario: codigo unico de cada dato<br>";*/

$sql = "CREATE TABLE ".$nombre_tabla." ( ";
$sql .= "id_".$prefijo." INT(11) PRIMARY KEY AUTO_INCREMENT ,";
for ($i = 0;$i < $cantidad_campos; $i++) {
    
    $cant = $i + 1;
    //echo $cant."<br>";
    //echo "Nombre: ".$_POST['TxtNombreCampo_'.$cant]."<br>";
    //echo "Tipo: ".$_POST['TxtTipoDato_'.$cant]."<br>";
    //echo "Tamano: ".$_POST['TxtTamanoDato_'.$cant]."<br>";
    //echo "Comentario: ".$_POST['TxtComentario_'.$cant]."<br>";
    //echo "<br>";
    
    if(strlen($_POST['TxtTamanoDato_'.$cant] == 0)){
        $tamano = "";
    }else{
        $tamano = "(".$_POST['TxtTamanoDato_'.$cant].")";
    }
    
    $sql .= $_POST['TxtNombreCampo_'.$cant]."_".$prefijo." ".$_POST['TxtTipoDato_'.$cant].$tamano." NOT NULL ,";

    /*if($cantidad_campos-1 != $i){
           $sql .= ", "; 
    }*/
    
   
   
    
} 

$sql .= "order_".$prefijo." INT(11) NOT NULL ";

$sql .= ");";

 
$query = new Consulta($sql);

//echo $sql;
  
echo "Tabla creado con Exito : ".$nombre_tabla."<br>";
echo "<a target='_black' href='../generar/index.php'>Generador de CRUD</a>";

?>