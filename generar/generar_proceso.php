<?php 
include_once("../inc.core.php");
function my_autoloader($class) {
	if(file_exists( _model_.$class.'.php'  )){
		include _model_.$class.'.php';
	}
}
spl_autoload_register('my_autoloader');

//$saltar = "<br>";
$saltar = "\n";
//$espacio = "&nbsp;";
$espacio = " ";

$ruta_fichero = '../aplication/model/';
$ruta_fichero_admin = '../dw-admin/';
$imprimirpantalla = 0;


$link = new Conexion($_config['bd']['server'],$_config['bd']['user'],$_config['bd']['password'],$_config['bd']['name']);

$array_tablas = $_POST['tablelist'];

foreach($array_tablas as $clave=>$valor){
    echo "<div class='tablas_items'> <div class='nombre_tabla'>Tabla : ".$array_tablas[$clave]."</div>";
    

    //-------------OBTENER NOMBRE DE CAMPOS DE LA TABLA ------------
    //$sql_tabla = "SHOW FIELDS FROM ".$array_tablas[$clave];
    //echo $sql_tabla;
    
    //$query_tabla = new Consulta($sql_tabla);
    
    //while ($row_tabla = $query_tabla->VerRegistro()) {
      //echo $row_tabla[0]."<br>";
      //$nombre_extend = strstr($row_tabla[0],'_')."<br>";
    //}
    //$nombre_clase =  str_replace("_","",$nombre_extend);
    //
    //-------------END NOMBRE TABLE ----------------------
    
    
    $sql = "select * from ".$array_tablas[$clave];
    $query = new Consulta($sql);
    
    //echo $nombre_clase =  strstr($query->nombrecampo(0),"_",true)."<br>";
    
    $NombreClaseRefinir = ucwords(str_replace("_"," ",str_replace("id_"," ",$query->nombrecampo(0))));
    $NombreClase =  str_replace(" ","",$NombreClaseRefinir);

    if($imprimirpantalla == 0){
        $ClaseSingular = "<?php".$saltar;   
      
        $ClaseSingular .= "class ".$NombreClase."{ ".$saltar.$saltar;
        $ClaseSingular .= "private ";
        $numerocampos = $query->NumeroCampos();

        $nombreSingular = "_".str_replace('id_','',$query->nombrecampo(0));
        //echo "<br>".$nombreSingular."<br>";

            for ($i = 0; $i < $numerocampos; $i++){

                $replace = str_replace($nombreSingular, "", $query->nombrecampo($i));
                $ClaseSingular .= " \$_".$replace;
                //$ClaseSingular .= " \$_".str_before($query->nombrecampo($i) , '_' );

                if(strstr($replace,"image")){        
                    $validarImg = 1;
                }

                if($numerocampos-1 != $i){
                   $ClaseSingular .= ","; 
                }
            }
        $ClaseSingular .= ";".$saltar;

        $ClaseSingular .= "public function __construct(\$id = 0, Idioma \$idioma = Null){".$saltar;
        $ClaseSingular .= espacio('4',$espacio)."\$this->_id = \$id;".$saltar;
        $ClaseSingular .= espacio('4',$espacio)."\$this->_idioma = \$idioma;".$saltar.$saltar;
        $ClaseSingular .= espacio('4',$espacio)."if(\$this->_id > 0){".$saltar.$saltar;
        $ClaseSingular .= espacio('8',$espacio)."\$sql = \" SELECT * FROM ".$array_tablas[$clave]." WHERE ".$query->nombrecampo(0)." = '\".\$this->_id.\"' \"; ".$saltar.$saltar;
        $ClaseSingular .= espacio('8',$espacio)."\$query = new Consulta(\$sql);".$saltar.$saltar;
        $ClaseSingular .= espacio('8',$espacio)."if(\$row = \$query->VerRegistro()){ ".$saltar;

        for ($j = 0; $j < $numerocampos; $j++){

             $replace = str_replace($nombreSingular, "", $query->nombrecampo($j));

            $ClaseSingular .= espacio('12',$espacio)." \$this->_".$replace." =  \$row['".$query->nombrecampo($j)."']; ".$saltar;   
            //$ClaseSingular .= " \$this->_".str_before($query->nombrecampo($j) , '_' )." =  \$row['".$query->nombrecampo($j)."']; ".$saltar;   
        }

        $ClaseSingular .= espacio('8',$espacio)."}".$saltar;
        $ClaseSingular .= espacio('4',$espacio)."}".$saltar;
        $ClaseSingular .= "}".$saltar;


        $ClaseSingular .= "public function __get(\$attribute){".$saltar;
        $ClaseSingular .= espacio('4',$espacio)."return	\$this->\$attribute;".$saltar;
        $ClaseSingular .= "}".$saltar;

        $ClaseSingular .= "}".$saltar;
    }
    
    if($imprimirpantalla == 0){
        $ClaseSingular .= "?>";
    }
    
    if($imprimirpantalla == 0){
    
        $ruta_Simple = $ruta_fichero.$NombreClase.".php";

        if (file_exists($ruta_Simple)) {
            //echo "El fichero $ruta_Simple existe";
            echo "Ya existe ".$NombreClase.".php  <br>";
        } else {

            //echo "El fichero $ruta_Simple no existe";
            $fp=fopen("../aplication/model/".$NombreClase.".php","x");
            fwrite($fp,$ClaseSingular);
            fclose($fp);

            echo "Creado clase $NombreClase.php <br>";

        }
    
    }  else {
        echo $ClaseSingular;
    }
    
    
    echo $saltar;


// -------------------------------------- CLASE EN PLURAL ----------------------------
// ----------------------------------------------------------------------------------_
    
    $NombreClaseRefinirPlural = ucwords(str_replace("_"," ",$array_tablas[$clave]));
    $NombreClaseNormal = str_replace(" ","_",(str_replace("_"," ",$array_tablas[$clave])));
    $NombreClasePlural =  str_replace(" ","",$NombreClaseRefinirPlural);
    
    
    if($imprimirpantalla == 0){
    $ClasePlural = "<?php".$saltar;
    }
    
    $ClasePlural .= "class ".$NombreClasePlural."{".$saltar;
    $ClasePlural .= $saltar;
    $ClasePlural .= "private \$_msgbox, \$_idioma, \$_usuario;".$saltar; 
    $ClasePlural .= $saltar;
    //$ClasePlural .= "public function __construct(Msgbox \$msg,Idioma \$idioma ,Usuario \$user)".$saltar; //parametros obligatorios
    $ClasePlural .= "public function __construct(\$msg = '' ,\$idioma = '' ,\$user = '' ){".$saltar; //parametros vacios
    $ClasePlural .= espacio('10',$espacio)."\$this->_msgbox = \$msg;".$saltar;
    $ClasePlural .= espacio('10',$espacio)."\$this->_idioma = \$idioma;".$saltar;
    $ClasePlural .= espacio('10',$espacio)."\$this->_usuario = \$user;".$saltar;
    $ClasePlural .= "}".$saltar;
    $ClasePlural .= $saltar;
    
    $arrayCamposNormal = array();
    $arrayCamposFiltro = array();
    $arrayCamposFiltroSI = array();
    $arrayCamposFiltroCI = array();
    //ARRAY CAMPOS NORMAL
    for ($p = 0; $p < $numerocampos; $p++){        
         array_push($arrayCamposNormal,$query->nombrecampo($p)); 
    }
    
    $totalCampoNormal = count($arrayCamposNormal);
    //echo "<pre>";
    //print_r($arrayCamposNormal);
    //echo "</pre>";
    
    //END ARRAY CAMPOS NORMAL
    
    
    
    
    //ARRAY CAMPOS FILTRO
    for ($pe = 0; $pe < $numerocampos; $pe++){
        
         if(!strstr($query->nombrecampo($pe),"thumb")){
          
             if(!strstr($query->nombrecampo($pe),"order")){
                array_push($arrayCamposFiltro,$query->nombrecampo($pe)); 
             }
         }    
    }
    
    
    $totalCampoFiltro = count($arrayCamposFiltro);
    
     //echo "<pre>";
    //print_r($arrayCamposFiltro);
    //echo "</pre>";
    
    //END ARRAY CAMPOS IMAGEN
    
    
    
    //ARRAY CAMPOS FILTRO SIN IMAGEN
    for ($pe = 0; $pe < $numerocampos; $pe++){
        
        if(!strstr($query->nombrecampo($pe),"id")){
        
         if(!strstr($query->nombrecampo($pe),"imagen")){
          
             if(!strstr($query->nombrecampo($pe),"thumb")){
                
                if(!strstr($query->nombrecampo($pe),"order")){
                    array_push($arrayCamposFiltroSI,$query->nombrecampo($pe)); 
                }
                
             }
         }
        }
    }
    
    
    $totalCampoFiltroSI = count($arrayCamposFiltroSI);
    
     //echo "<pre>";
    //print_r($arrayCamposFiltro);
    //echo "</pre>";
    
    //END ARRAY CAMPOS SIN IMAGEN
    
    
    
    //ARRAY CAMPOS FILTRO SOLO IMAGEN
    for ($pe = 0; $pe < $numerocampos; $pe++){      
        if(strstr($query->nombrecampo($pe),"imagen")){
             array_push($arrayCamposFiltroCI,$query->nombrecampo($pe));                
        }    
    }
    
    $totalCampoFiltroCI = count($arrayCamposFiltroCI);
    
     //echo "<pre>";
    //print_r($arrayCamposFiltro);
    //echo "</pre>";
    
    //END ARRAY CAMPOS SOLO IMAGEN
    
    
    
    
    
    //VALIDAR SI TIENE IMAGEN
    //ARRAY CAMPOS FILTRO
    for ($pr = 0; $pr < $numerocampos; $pr++){
        
         if(!strstr($query->nombrecampo($pr),"image")){
             $validarImg = 1;
         }
    }
    
    //END VALIDAR CAMPO IMAGEN
    
    
    
    
    //------------METODO NUEVO-----------------
    //-----------------------------------------
    
    $ClasePlural .= "public function new".$NombreClasePlural."(){".$saltar;
    
    
    $ClasePlural .= espacio('4',$espacio)." \$query = new Consulta(\"SELECT ";
    
    for ($ne = 0; $ne < $totalCampoFiltro; $ne++){
        
        $ClasePlural .= $arrayCamposFiltro[$ne];

        if($totalCampoFiltro-1 != $ne){
           $ClasePlural .= " ,";
        }

    }
    
    $ClasePlural .= " FROM  ".$array_tablas[$clave]." \"); ".$saltar;
    
    if($validarImg == 1){
        $ClasePlural .= espacio('4',$espacio)."echo  \"<div class='success' style='padding:10px;'> &nbsp;&nbsp;&nbsp;&nbsp; Subir imagenes con tamaño aproximado w = 600px x h 350px  pixeles. </div>\";  ".$saltar;
    }
      
    $ClasePlural .= espacio('4',$espacio)."\$obj_form = new Form();".$saltar;   
    $ClasePlural .= espacio('4',$espacio)."\$obj_form->getForm(\$query, 'new', '".$NombreClaseNormal.".php','','','img'); ".$saltar;
    $ClasePlural .= "}".$saltar;
    
    //------------END METODO NUEVO-----------------
    //---------------------------------------------
    
    $ClasePlural .= $saltar;
    
    
    //--------------- METODO EDITAR -----------------
    //-----------------------------------------------
    
    $ClasePlural .= "public function edit".$NombreClasePlural."(){".$saltar;
    $ClasePlural .= espacio('4',$espacio)." \$query = new Consulta(\"SELECT ";
    
    for ($ne = 0; $ne < $totalCampoFiltro; $ne++){
        
        $ClasePlural .= $arrayCamposFiltro[$ne];

        if($totalCampoFiltro-1 != $ne){
           $ClasePlural .= " ,";
        }

    }
    
    $ClasePlural .= " FROM  ".$array_tablas[$clave]." WHERE ".$query->nombrecampo(0)." = '\".\$_GET['id'].\"'   \"); ".$saltar;
    
    if($campoimg == 1){
        $ClasePlural .= "echo  \"<div class='success' style='padding:10px;'> &nbsp;&nbsp;&nbsp;&nbsp; Subir imagenes con tamaño aproximado w = 600px x h 350px  pixeles. </div>\";  ".$saltar;
    }
    
    $ClasePlural .= espacio('4',$espacio)."\$obj_form = new Form();".$saltar; 
    $ClasePlural .= espacio('4',$espacio)."\$obj_form->getForm(\$query, 'edit', '".$NombreClaseNormal.".php','','','img'); ".$saltar;
    $ClasePlural .= "}".$saltar;
  
    
    //------------END METODO EDITAR-----------------
    //----------------------------------------------
    
    $ClasePlural .= $saltar;
    
    
    
    //-------------- METODO AGREGAR-----------------
    //---------------------------------------------  
    $ClasePlural .= "public function add".$NombreClasePlural."(){".$saltar;

    $ArrayNombreImagen = "";
    $arrayImg = array();
    $arrayClases = array();
    
    
    
      for ($k = 0; $k < $totalCampoNormal; $k++){
            
          $remplazar = str_replace($nombreSingular, "", $arrayCamposNormal[$k]);
          
         if(strstr($remplazar,"image")){
             
                $ClasePlural .= espacio('4',$espacio)." if(isset(\$_FILES['".$arrayCamposNormal[$k]."']) && (\$_FILES['".$arrayCamposNormal[$k]."']['name'] != '')){".$saltar;
                 //$ClasePlural .= " \$destino = '../aplication/webroot/imgs/catalogo/'; ".$saltar;
                $ClasePlural .= espacio('6',$espacio)." \$obj  = new Upload();".$saltar;
                $ClasePlural .= espacio('6',$espacio)." \$destino = \"../aplication/webroot/imgs/catalogo/\"; ".$saltar;
                $ClasePlural .= espacio('6',$espacio)." \$name".$k." = strtolower(date(\"ymdhis\").\$_FILES['".$arrayCamposNormal[$k]."']['name']); ".$saltar;
                $ClasePlural .= espacio('6',$espacio)." \$temp = \$_FILES['".$arrayCamposNormal[$k]."']['tmp_name']; ".$saltar;
                $ClasePlural .= espacio('6',$espacio)." \$type = \$_FILES['".$arrayCamposNormal[$k]."']['type']; ".$saltar;
                $ClasePlural .= espacio('6',$espacio)." \$size = \$_FILES['".$arrayCamposNormal[$k]."']['size']; ".$saltar;
                $ClasePlural .= espacio('6',$espacio)." \$obj->upload_imagen(\$name".$k.", \$temp, \$destino, \$type, \$size); ".$saltar;
                $ClasePlural .= espacio('4',$espacio)."}".$saltar.$saltar;	
                $namarray = "\$name".$k;
                array_push($arrayImg,$namarray); 
                
            }
      
        }
    
     $arraynombcampo = array();
     //$ClasePlural .= espacio('4',$espacio)."\$id = mysql_insert_id();".$saltar;
     $ClasePlural .= espacio('4',$espacio)."\$query = new Consulta(\"INSERT INTO  ".$array_tablas[$clave]."(";
    
      for ($tp = 0; $tp < count($arrayCamposNormal); $tp++) {
           
            $remplazar2 = str_replace($nombreSingular, "", $arrayCamposNormal[$tp]);
          
            if(strstr($remplazar2,"image")){
             
                 array_push($arraynombcampo,$arrayCamposNormal[$tp]);
                 //echo $arrayCamposNormal[$tp]."<br>";
            }else{
                
                $ClasePlural .= $arrayCamposNormal[$tp];
                
                if($validarImg != "1"){
                
                    if((count($arrayCamposNormal)-1) != $tp){
                        $ClasePlural .= ", "; 
                    }
                
                }else{
                    if((count($arrayCamposNormal)-1) != $tp){
                        $ClasePlural .= ", "; 
                    }
                }
             
             }
        }
        $total_arraynombcampo = count($arraynombcampo);
         if(strlen($arraynombcampo)>0){
            for ($w = 0; $w < $total_arraynombcampo; $w++) {
                $ClasePlural .= $arraynombcampo[$w];
                if(($total_arraynombcampo-1) != $w ){
                    $ClasePlural .= ", "; 
                }
            }
        }
        
         $ClasePlural .= ") VALUES (".$saltar;
        
         for ($n = 0; $n < count($arrayCamposNormal); $n++) {
            $remplazar3 = str_replace($nombreSingular, "", $arrayCamposNormal[$n]);
           
            if(!strstr($remplazar3,"image")){            
                $ClasePlural .= " '\".\$_POST['".$arrayCamposNormal[$n]."'].\"' ";

                if($validarImg != "1"){
                    if((count($arrayCamposNormal)-1) != $n){
                        $ClasePlural .= " ,".$saltar; 
                    }
                }else{       
                  $ClasePlural .= ", ".$saltar;   
                }
            }       
        }
       
        for ($q = 0; $q < count($arraynombcampo); $q++) {
             $ClasePlural .= " '\".\$_POST['".$arraynombcampo[$q]."'].\"' ";
         
                if((count($arraynombcampo)-1) != $q){
                    $ClasePlural .= " ,".$saltar; 
                }
            
        }
           
        $ClasePlural .= " )\"); ".$saltar;   
        $ClasePlural .= espacio('4',$espacio)."\$this->_msgbox->setMsgbox('Se agregó correctamente.',2);".$saltar;
        $ClasePlural .= espacio('4',$espacio)."location(\"".$NombreClaseNormal.".php\");".$saltar;   
        $ClasePlural .= "}".$saltar;
             
    //----------------- END METODO AGREGAR-----------------
    //------------------------------------------------------
    
    $ClasePlural .= $saltar.$saltar;    
    
    
    
    
    
    
    
    
    //-------------- METODO ACTUALIZAR-----------------
    //---------------------------------------------  
    $ClasePlural .= "public function update".$NombreClasePlural."(){".$saltar;

    $ArrayNombreImagen = "";
    $arrayImg = array();
    $arrayClases = array();
    
    
    
      for ($k = 0; $k < $totalCampoNormal; $k++){
            
          $remplazar = str_replace($nombreSingular, "", $arrayCamposNormal[$k]);
          
         if(strstr($remplazar,"image")){
             
                $ClasePlural .= espacio('4',$espacio)." if(isset(\$_FILES['".$arrayCamposNormal[$k]."']) && (\$_FILES['".$arrayCamposNormal[$k]."']['name'] != '')){".$saltar;
                 //$ClasePlural .= " \$destino = '../aplication/webroot/imgs/catalogo/'; ".$saltar;
                $ClasePlural .= espacio('6',$espacio)." \$obj  = new Upload();".$saltar;
                $ClasePlural .= espacio('6',$espacio)." \$destino = \"../aplication/webroot/imgs/catalogo/\"; ".$saltar;
                $ClasePlural .= espacio('6',$espacio)." \$name".$k." = strtolower(date(\"ymdhis\").\$_FILES['".$arrayCamposNormal[$k]."']['name']); ".$saltar;
                $ClasePlural .= espacio('6',$espacio)." \$temp = \$_FILES['".$arrayCamposNormal[$k]."']['tmp_name']; ".$saltar;
                $ClasePlural .= espacio('6',$espacio)." \$type = \$_FILES['".$arrayCamposNormal[$k]."']['type']; ".$saltar;
                $ClasePlural .= espacio('6',$espacio)." \$size = \$_FILES['".$arrayCamposNormal[$k]."']['size']; ".$saltar;
                $ClasePlural .= espacio('6',$espacio)." \$obj->upload_imagen(\$name".$k.", \$temp, \$destino, \$type, \$size); ".$saltar;
               	
                $namarray = "\$name".$k;
                array_push($arrayImg,$namarray); 
                
                $ClasePlural .= espacio('6',$espacio)." \$update = \" ".$arrayCamposNormal[$k]." = '\".".$namarray.".\"' \"; ".$saltar;   
                $ClasePlural .= espacio('6',$espacio)." \$query = new Consulta(\"UPDATE  ".$array_tablas[$clave]." SET \".\$update.\" WHERE ".$query->nombrecampo(0)." = '\".\$_GET['id'].\"'\"); ".$saltar;                
                 $ClasePlural .= espacio('4',$espacio)."}".$saltar.$saltar;
                
            }
      
        }
    
     $arraynombcampo = array();
     //$ClasePlural .= espacio('4',$espacio)."\$id = mysql_insert_id();".$saltar;
    
     //$ClasePlural .= espacio('4',$espacio)."\$id = mysql_insert_id();".$saltar;     
     $ClasePlural .= espacio('4',$espacio)."\$query = new Consulta(\"UPDATE ".$array_tablas[$clave]." SET ".$saltar;
     
    
     for ($n = 0; $n < $totalCampoFiltroSI; $n++) {
         
            $ClasePlural .= espacio('4',$espacio)." ".$arrayCamposFiltroSI[$n]." = '\".\$_POST['".$arrayCamposFiltroSI[$n]."'].\"' "; 

            if($totalCampoFiltroSI-1 != $n){
                $ClasePlural .= " ,".$saltar; 
            }        
    }  
      
    $ClasePlural .= " WHERE  ".$query->nombrecampo(0)." = '\".\$_GET['id'].\"'\"); ".$saltar;   
     
    $ClasePlural .= espacio('4',$espacio)."\$this->_msgbox->setMsgbox('Se actualizo correctamente.',2);".$saltar;
    $ClasePlural .= espacio('4',$espacio)."location(\"".$NombreClaseNormal.".php\");".$saltar;

    $ClasePlural .= "}".$saltar;
             
    //----------------- END METODO ACTUAL-----------------
    //------------------------------------------------------
    
    $ClasePlural .= $saltar.$saltar;    
    
    //----------------- METODO ELIMINAR ---------------------
    //------------------------------------------------------------
    
    $ClasePlural .= "public function delete".$NombreClasePlural."(){".$saltar;
    $ClasePlural .= espacio('4',$espacio)."\$this->deleteFiles".$NombreClasePlural."( \$_GET['id'] );".$saltar;
    $ClasePlural .= espacio('4',$espacio)."\$query = new Consulta(\"DELETE FROM ".$array_tablas[$clave]." WHERE ".$query->nombrecampo(0)." = '\".\$_GET['id'].\"'\");".$saltar;
    $ClasePlural .= espacio('4',$espacio)."\$this->_msgbox->setMsgbox('Se elimino correctamente.',2);".$saltar;
    $ClasePlural .= espacio('4',$espacio)."location(\"".$NombreClaseNormal.".php\");".$saltar;
    $ClasePlural .= "}";
    
    //----------------- END METODO ELIMINAR ---------------------
    //------------------------------------------------------------
    
    $ClasePlural .= $saltar.$saltar;
    
    
    //----------------- METODO ELIMINAR IMAGEN ---------------------
    //------------------------------------------------------------
    
    $ClasePlural .= "public function deleteFiles".$NombreClasePlural."(\$id){".$saltar;
    $ClasePlural .= espacio('4',$espacio)."\$query = new Consulta( \"SELECT * FROM ".$array_tablas[$clave]." WHERE ".$query->nombrecampo(0)." = '\".\$id.\"'\" );".$saltar;
    $ClasePlural .= espacio('4',$espacio)."\$row = \$query->VerRegistro();".$saltar;

    
        for ($en = 0; $en < $totalCampoFiltroCI; $en++) {
            
            $ClasePlural .= espacio('4',$espacio)."if(\$row['".$arrayCamposFiltroCI[$en]."']!= '' ){".$saltar;
            $ClasePlural .= espacio('6',$espacio)."if(file_exists(_link_file_ . \$row['".$arrayCamposFiltroCI[$en]."'])){".$saltar;
            $ClasePlural .= espacio('8',$espacio)."unlink (_link_file_ . \$row['".$arrayCamposFiltroCI[$en]."']);".$saltar;
            //$ClasePlural .= "unlink (_link_file_ . \$row['".$arrayClasesThumb[$en]."']);".$saltar;
            $ClasePlural .= espacio('6',$espacio)."}".$saltar;
            $ClasePlural .= espacio('4',$espacio)."}".$saltar;
            
        }
 
    
    $ClasePlural .= "}";     
        
    //----------------- END METODO ELIMINAR IMAGEN ---------------
    //------------------------------------------------------------     
    $ClasePlural .= $saltar.$saltar;
    
    
    
    
    
    
       //-------------------------- METODO LISTAR ---------------------
   //--------------------------------------------------------------
   
   $ClasePlural .= "public function list".$NombreClasePlural."(){".$saltar;
   $ClasePlural .= "\$generico = array();".$saltar;
   $ClasePlural .= "\$generico = \$this->get".$NombreClasePlural."();".$saltar;
   $ClasePlural .= "?>";
   
   $ClasePlural .= "<div id=\"content-area\">".$saltar;
   $ClasePlural .= "<table cellspacing=\"1\" cellpading=\"1\" class=\"listado\">".$saltar;
   $ClasePlural .= "<thead>".$saltar;
   $ClasePlural .= "<tr class=\"head\">".$saltar;
   $ClasePlural .= "<th align=\"left\">".$NombreClaseRefinirPlural."</th>".$saltar;
   $ClasePlural .= "<th align=\"center\" width=\"100\" class=\"titulo\">Opciones</th>".$saltar;
   $ClasePlural .= "</tr>".$saltar;
   $ClasePlural .= "</thead>".$saltar;
   $ClasePlural .= "</table>".$saltar;
   $ClasePlural .= "<ul id=\"listadoul\" data-orden=\"ordenar".$NombreClasePlural."\"><!-- COPIAR  EN aplication/model/Ajax.php ".$saltar;
   $ClasePlural .= "function ordenar".$NombreClasePlural."Ajax(){".$saltar;
   $ClasePlural .= "foreach(\$_GET['list_item'] as \$position => \$item){".$saltar;
   $ClasePlural .= "\$query = new Consulta(\"UPDATE ".$array_tablas[$clave]." SET order".$nombreSingular." = \$position WHERE ".$query->nombrecampo(0)." = \$item\"); ".$saltar;
   $ClasePlural .= "}".$saltar;
   $ClasePlural .= "}".$saltar;
   $ClasePlural .= "-->".$saltar;
   
   $ClasePlural .= "<?php".$saltar;
   $ClasePlural .= "\$y = 1;".$saltar;
   $ClasePlural .= "foreach(\$generico as \$b){".$saltar;
   $ClasePlural .= "?>".$saltar;
   $ClasePlural .= "<li class=\"<?php echo (\$y%2 == 0) ? \"fila1\" : \"fila2\"; ?>\" id=\"list_item_<?php echo \$b['id']; ?>\"> ".$saltar;
   
   /*foreach ($arrayCamposFiltro as $value) {
   $replace = str_replace($nombreSingular, "", $value);
       if(strstr($replace, 'nombre')){
            $nombreTxt = 'nombre';
        }else if(strstr($replace, 'descripcion')){
            $nombreTxt = 'descripcion';
        }else if(strstr($replace, 'titulo')){
            $nombreTxt = 'titulo';
        }else{
            $nombreTxt = 'titulo_principal';
        }
   }*/
   
   $nombreTxt = "nombre";
   
   
   $ClasePlural .= "<div class=\"data\"><img style=\"vertical-align: middle;\" src=\"<?php echo _admin_ ?>icon_banner.png\" class=\"handle\"> <?php echo \$b['".$nombreTxt."'] ?></div>".$saltar;
   
   $ClasePlural .= "<div class=\"options\">".$saltar;
   $ClasePlural .= "<a class=\"tooltip move\" title=\"Ordenar ( Click + Arrastrar )\"><img src=\"<?php echo _admin_ ?>move.png\" class=\"handle\"></a>&nbsp;".$saltar;
   $ClasePlural .= "<a title=\"Editar\" class=\"tooltip\" href=\"".$NombreClaseNormal.".php?id=<?php echo \$b['id'] ?>&action=edit\"><img src=\"<?php echo _admin_ ?>edit.png\"></a>&nbsp;".$saltar;
   $ClasePlural .= "<a title=\"Eliminar\"  href=\"#\" class=\"tooltip\" onClick=\"mantenimiento('".$NombreClaseNormal.".php','<?php echo \$b['id'] ?>','delete')\"><img src=\"<?php echo _admin_ ?>delete.png\"></a>&nbsp;    ".$saltar;
   $ClasePlural .= "</div>".$saltar;
   $ClasePlural .= "</li>".$saltar;
   $ClasePlural .= "<?php".$saltar;
   $ClasePlural .= "\$y++;".$saltar;
   $ClasePlural .= "}".$saltar;
   $ClasePlural .= "?>".$saltar;
   $ClasePlural .= "</ul>".$saltar;
   $ClasePlural .= "</div>".$saltar;
   $ClasePlural .= " <?php ".$saltar;
   $ClasePlural .= "}".$saltar;
 
   //--------------------------END METODO LISTAR ---------------------
   //--------------------------------------------------------------  
   
   $ClasePlural .= $saltar; 
   
   //-------------------------- METODO GET ---------------------
   //--------------------------------------------------------------
   
   $ClasePlural .= "public function get".$NombreClasePlural."(){".$saltar;
   $ClasePlural .= "\$sql   = \" SELECT * FROM ".$array_tablas[$clave]." ORDER BY order".$nombreSingular." ASC\";".$saltar;
   $ClasePlural .= "\$query = new Consulta(\$sql);".$saltar;  
   $ClasePlural .= "\$datos = array();".$saltar.$saltar;  
   $ClasePlural .= "while(\$row = \$query->VerRegistro()){".$saltar;  
   $ClasePlural .= "\$datos[] = array(".$saltar; 
   
    for ($r = 0; $r < $numerocampos; $r++){
        
        $replace = str_replace($nombreSingular, "", $query->nombrecampo($r));
        
        
        //if($replace != "order"){
            
            $ClasePlural .= " '".$replace."' => \$row['".$query->nombrecampo($r)."'] ";
            
            if($numerocampos-1 != $r){
                $ClasePlural .= ",".$saltar; 
            }
            
        //}
        
        
    }  
    
    $ClasePlural .= ");".$saltar;
    $ClasePlural .= "}".$saltar;//WHILE
    $ClasePlural .= "return \$datos;".$saltar;
    
    $ClasePlural .= "}".$saltar;
    //----------------------- END METODO GET ---------------------
   //--------------------------------------------------------------
    $ClasePlural .= $saltar;
    
    
    $ClasePlural .= "public function order".$NombreClasePlural."(\$id=0){".$saltar;
    $ClasePlural .= "\$query = new Consulta(\"SELECT MAX(order".$nombreSingular.") max_orden FROM ".$array_tablas[$clave]." WHERE ".$query->nombrecampo(0)." = '\".\$id.\"'\");".$saltar;
    $ClasePlural .= "\$row   = \$query->VerRegistro();".$saltar;
    $ClasePlural .= "return (int)(\$row['max_orden']+1);".$saltar;
    $ClasePlural .= "}".$saltar;
    
    $ClasePlural .= "}".$saltar;//FINAL DE CLASE PLURAL 
    
    if($imprimirpantalla == 0){
        $ClasePlural .= "?>"; 
    }
    
 
    
    if($imprimirpantalla == 0){
        
        $ruta_Plural = $ruta_fichero.$NombreClasePlural.".php";
   
        if (file_exists($ruta_Plural)) {
            //echo "El fichero $ruta_Plural existe";
            echo "Ya existe ".$NombreClasePlural.".php <br>";
        } else {
                $fpl=fopen("../aplication/model/".$NombreClasePlural.".php","x");
                fwrite($fpl,$ClasePlural);
                fclose($fpl);

            echo "Creado clase $NombreClasePlural.php <br>";
        }
        
    }  else {
        echo $ClasePlural;
    }
    
    echo $saltar;
    
    
    
    //------------------ADMINISTRADOR DE CLASE--------------
    
    $adminClase = "<?php include(\"inc.aplication_top.php\");".$saltar;
    $adminClase .= "include(_includes_.\"admin/inc.header.php\");".$saltar;
    $adminClase .= "?>".$saltar;
    $adminClase .= "<body>".$saltar;
    $adminClase .= "<div id=\"dw-window\"> ".$saltar;
    $adminClase .= "<div id=\"dw-admin\">".$saltar;
    $adminClase .= "<div id=\"dw-menu\">".$saltar;
    $adminClase .= "<!-- Menu -->".$saltar;
    $adminClase .= "<?php include(_includes_.\"admin/inc.top.php\"); ?>".$saltar;
    $adminClase .= "</div>".$saltar;
    $adminClase .= "<div id=\"dw-page\">".$saltar;
    $adminClase .= "<div id=\"dw-cuerpo\">".$saltar;
    $adminClase .= "<h1>Administrar ".$NombreClaseRefinirPlural.$saltar;
    $adminClase .= "<span class=\"operations\">".$saltar;
    $adminClase .= "<a href=\"<?php echo \$_SERVER['PHP_SELF']?>\">".$saltar;
    $adminClase .= "<em>Listar</em>".$saltar;
    $adminClase .= "<span></span>".$saltar;
    $adminClase .= "</a>".$saltar;
    $adminClase .= "<a href=\"<?php echo \$_SERVER['PHP_SELF']?>?action=new\">".$saltar;
    $adminClase .= "<em>Nuevo</em>".$saltar;
    $adminClase .= "<span></span>".$saltar;
    $adminClase .= "</a>".$saltar;
    $adminClase .= "</span>".$saltar;
    $adminClase .= "</h1>".$saltar;
    $adminClase .= "<?php echo \$msgbox->getMsgbox();".$saltar;
    $adminClase .= "\$obj =  new ".$NombreClasePlural."(\$msgbox);".$saltar;
    $adminClase .= "if(\$_GET['action']){".$saltar;
    $adminClase .= "\$accion = \$_GET['action'].\"".$NombreClasePlural."\";   ".$saltar;
    $adminClase .= " \$obj->\$accion();".$saltar;
    $adminClase .= "}else{".$saltar;
    $adminClase .= " \$obj->list".$NombreClasePlural."(); ".$saltar;
    $adminClase .= "}".$saltar;
    $adminClase .= "?>".$saltar;
    $adminClase .= "</div>".$saltar;
    $adminClase .= "</div>".$saltar;
    $adminClase .= "</div>".$saltar;
    $adminClase .= "</div>".$saltar;
    $adminClase .= "</body>".$saltar;
    $adminClase .= "</html>".$saltar;
    $adminClase .= "<?php include(\"inc.aplication_bottom.php\"); ?>".$saltar;
    $adminClase .= "".$saltar;
    
    
    if($imprimirpantalla == 0){
    
        $ruta_Admin = $ruta_fichero_admin.$NombreClaseNormal.".php";

        if (file_exists($ruta_Admin)) {
            //echo "El fichero $ruta_Plural existe";
            echo "Ya existe Administrador  ".$NombreClaseNormal.".php <br>";
        } else {
             $fpla=fopen("../dw-admin/".$NombreClaseNormal.".php","x");
             fwrite($fpla,$adminClase);
             fclose($fpla);

            echo "Creado Administrador $NombreClaseNormal.php <br>";
            echo "Ruta : <a target='_black' class='url_admin' href='../dw-admin/".$NombreClaseNormal.".php'>RUTA DE ADMINISTRADOR</a>";

            //DAR PERMISOS

            $query = new Consulta("INSERT INTO secciones VALUES('','2','".$NombreClaseRefinirPlural."','".$NombreClaseNormal.".php')");
            $id_final = $query->nuevoId();

            $query2 = new Consulta("INSERT INTO usuarios_secciones VALUES('1','".$id_final."')");

        }
   
    }else{
        echo $adminClase;
    }
    
    
    
    
  echo "</div>";  
     
    
    
    
}


function str_before($subject, $needle)
{
    $p = strpos($subject, $needle);
    return substr($subject, 0, $p);
}

function espacio($n,$esp){
    for ($i = 0; $i < $n; $i++) {
        $valor = $valor . $esp;
    }
    return $valor;        
}