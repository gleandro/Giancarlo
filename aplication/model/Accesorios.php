<?php
class Accesorios{

private $_msgbox, $_idioma, $_usuario;

public function __construct($msg = '' ,$idioma = '' ,$user = '' ){
          $this->_msgbox = $msg;
          $this->_idioma = $idioma;
          $this->_usuario = $user;
}

public function newAccesorios(){
     $query = new Consulta("SELECT id_accesorio ,nombre_accesorio ,imagen_accesorio ,fecha_accesorio FROM  accesorios "); 
    echo  "<div class='success' style='padding:10px;'> &nbsp;&nbsp;&nbsp;&nbsp; Subir imagenes con tamaño aproximado w = 600px x h 350px  pixeles. </div>";  
    $obj_form = new Form();
    $obj_form->getForm($query, 'new', 'accesorios.php','','','img'); 
}

public function editAccesorios(){
     $query = new Consulta("SELECT id_accesorio ,nombre_accesorio ,imagen_accesorio ,fecha_accesorio FROM  accesorios WHERE id_accesorio = '".$_GET['id']."'   "); 
    $obj_form = new Form();
    $obj_form->getForm($query, 'edit', 'accesorios.php','','','img'); 
}

public function addAccesorios(){
     if(isset($_FILES['imagen_accesorio']) && ($_FILES['imagen_accesorio']['name'] != '')){
       $obj  = new Upload();
       $destino = "../aplication/webroot/imgs/catalogo/"; 
       $name2 = strtolower(date("ymdhis").$_FILES['imagen_accesorio']['name']); 
       $temp = $_FILES['imagen_accesorio']['tmp_name']; 
       $type = $_FILES['imagen_accesorio']['type']; 
       $size = $_FILES['imagen_accesorio']['size']; 
       $obj->upload_imagen($name2, $temp, $destino, $type, $size); 
    }

    $query = new Consulta("INSERT INTO  accesorios(id_accesorio ,nombre_accesorio ,fecha_accesorio ,order_accesorio ,imagen_accesorio) VALUES (
 '".$_POST['id_accesorio']."'  ,
 '".$_POST['nombre_accesorio']."'  ,
 '".$_POST['fecha_accesorio']."'  ,
 '".$_POST['order_accesorio']."'  ,
 '".$_POST['imagen_accesorio']."'  )"); 
    $this->_msgbox->setMsgbox('Se agregó correctamente.',2);
    location("accesorios.php");
}


public function updateAccesorios(){
     if(isset($_FILES['imagen_accesorio']) && ($_FILES['imagen_accesorio']['name'] != '')){
       $obj  = new Upload();
       $destino = "../aplication/webroot/imgs/catalogo/"; 
       $name2 = strtolower(date("ymdhis").$_FILES['imagen_accesorio']['name']); 
       $temp = $_FILES['imagen_accesorio']['tmp_name']; 
       $type = $_FILES['imagen_accesorio']['type']; 
       $size = $_FILES['imagen_accesorio']['size']; 
       $obj->upload_imagen($name2, $temp, $destino, $type, $size); 
       $update = " imagen_accesorio = '".$name2."' "; 
       $query = new Consulta("UPDATE  accesorios SET ".$update." WHERE id_accesorio = '".$_GET['id']."'"); 
    }

    $query = new Consulta("UPDATE accesorios SET 
     nombre_accesorio = '".$_POST['nombre_accesorio']."'  ,
     fecha_accesorio = '".$_POST['fecha_accesorio']."'  WHERE  id_accesorio = '".$_GET['id']."'"); 
    $this->_msgbox->setMsgbox('Se actualizo correctamente.',2);
    location("accesorios.php");
}


public function deleteAccesorios(){
    $this->deleteFilesAccesorios( $_GET['id'] );
    $query = new Consulta("DELETE FROM accesorios WHERE id_accesorio = '".$_GET['id']."'");
    $this->_msgbox->setMsgbox('Se elimino correctamente.',2);
    location("accesorios.php");
}

public function deleteFilesAccesorios($id){
    $query = new Consulta( "SELECT * FROM accesorios WHERE id_accesorio = '".$id."'" );
    $row = $query->VerRegistro();
    if($row['imagen_accesorio']!= '' ){
      if(file_exists(_link_file_ . $row['imagen_accesorio'])){
        unlink (_link_file_ . $row['imagen_accesorio']);
      }
    }
}

public function listAccesorios(){
$generico = array();
$generico = $this->getAccesorios();
?><div id="content-area">
<table cellspacing="1" cellpading="1" class="listado">
<thead>
<tr class="head">
<th align="left">Accesorios</th>
<th align="center" width="100" class="titulo">Opciones</th>
</tr>
</thead>
</table>
<ul id="listadoul" data-orden="ordenarAccesorios"><!-- COPIAR  EN aplication/model/Ajax.php 
function ordenarAccesoriosAjax(){
foreach($_GET['list_item'] as $position => $item){
$query = new Consulta("UPDATE accesorios SET order_accesorio = $position WHERE id_accesorio = $item"); 
}
}
-->
<?php
$y = 1;
foreach($generico as $b){
?>
<li class="<?php echo ($y%2 == 0) ? "fila1" : "fila2"; ?>" id="list_item_<?php echo $b['id']; ?>"> 
<div class="data"><img style="vertical-align: middle;" src="<?php echo _admin_ ?>icon_banner.png" class="handle"> <?php echo $b['nombre'] ?></div>
<div class="options">
<a class="tooltip move" title="Ordenar ( Click + Arrastrar )"><img src="<?php echo _admin_ ?>move.png" class="handle"></a>&nbsp;
<a title="Editar" class="tooltip" href="accesorios.php?id=<?php echo $b['id'] ?>&action=edit"><img src="<?php echo _admin_ ?>edit.png"></a>&nbsp;
<a title="Eliminar"  href="#" class="tooltip" onClick="mantenimiento('accesorios.php','<?php echo $b['id'] ?>','delete')"><img src="<?php echo _admin_ ?>delete.png"></a>&nbsp;    
</div>
</li>
<?php
$y++;
}
?>
</ul>
</div>
 <?php 
}

public function getAccesorios(){
$sql   = " SELECT * FROM accesorios ORDER BY order_accesorio ASC";
$query = new Consulta($sql);
$datos = array();

while($row = $query->VerRegistro()){
$datos[] = array(
 'id' => $row['id_accesorio'] ,
 'nombre' => $row['nombre_accesorio'] ,
 'imagen' => $row['imagen_accesorio'] ,
 'fecha' => $row['fecha_accesorio'] ,
 'order' => $row['order_accesorio'] );
}
return $datos;
}

public function orderAccesorios($id=0){
$query = new Consulta("SELECT MAX(order_accesorio) max_orden FROM accesorios WHERE id_accesorio = '".$id."'");
$row   = $query->VerRegistro();
return (int)($row['max_orden']+1);
}
}
?>