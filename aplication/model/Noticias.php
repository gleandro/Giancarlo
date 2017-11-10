<?php
class Noticias{

private $_msgbox, $_idioma, $_usuario;

public function __construct($msg = '' ,$idioma = '' ,$user = '' ){
          $this->_msgbox = $msg;
          $this->_idioma = $idioma;
          $this->_usuario = $user;
}

public function newNoticias(){
     $query = new Consulta("SELECT id_noticia ,titulo_noticia ,descripcion_noticia ,fecha_noticia ,image_noticia FROM  noticias "); 
    echo  "<div class='success' style='padding:10px;'> &nbsp;&nbsp;&nbsp;&nbsp; Subir imagenes con tamaño aproximado w = 600px x h 350px  pixeles. </div>";  
    $obj_form = new Form();
    $obj_form->getForm($query, 'new', 'noticias.php','','','img'); 
}

public function editNoticias(){
     $query = new Consulta("SELECT id_noticia ,titulo_noticia ,descripcion_noticia ,fecha_noticia ,image_noticia FROM  noticias WHERE id_noticia = '".$_GET['id']."'   "); 
    $obj_form = new Form();
    $obj_form->getForm($query, 'edit', 'noticias.php','','','img'); 
}

public function addNoticias(){
     if(isset($_FILES['image_noticia']) && ($_FILES['image_noticia']['name'] != '')){
       $obj  = new Upload();
       $destino = "../aplication/webroot/imgs/catalogo/"; 
       $name4 = strtolower(date("ymdhis").$_FILES['image_noticia']['name']); 
       $temp = $_FILES['image_noticia']['tmp_name']; 
       $type = $_FILES['image_noticia']['type']; 
       $size = $_FILES['image_noticia']['size']; 
       $obj->upload_imagen($name4, $temp, $destino, $type, $size); 
    }

    $query = new Consulta("INSERT INTO  noticias(id_noticia, titulo_noticia, descripcion_noticia, fecha_noticia, order_noticia) VALUES (
 '".$_POST['id_noticia']."' , 
 '".$_POST['titulo_noticia']."' , 
 '".$_POST['descripcion_noticia']."' , 
 '".$_POST['fecha_noticia']."' , 
 '".$_POST['order_noticia']."' , 
 '".$_POST['image_noticia']."'  )"); 
    $this->_msgbox->setMsgbox('Se agregó correctamente.',2);
    location("noticias.php");
}


public function updateNoticias(){
     if(isset($_FILES['image_noticia']) && ($_FILES['image_noticia']['name'] != '')){
       $obj  = new Upload();
       $destino = "../aplication/webroot/imgs/catalogo/"; 
       $name4 = strtolower(date("ymdhis").$_FILES['image_noticia']['name']); 
       $temp = $_FILES['image_noticia']['tmp_name']; 
       $type = $_FILES['image_noticia']['type']; 
       $size = $_FILES['image_noticia']['size']; 
       $obj->upload_imagen($name4, $temp, $destino, $type, $size); 
       $update = " image_noticia = '".$name4."' "; 
       $query = new Consulta("UPDATE  noticias SET ".$update." WHERE id_noticia = '".$_GET['id']."'"); 
    }

    $query = new Consulta("UPDATE noticias SET 
     titulo_noticia = '".$_POST['titulo_noticia']."'  ,
     descripcion_noticia = '".$_POST['descripcion_noticia']."'  ,
     fecha_noticia = '".$_POST['fecha_noticia']."'  ,
     image_noticia = '".$_POST['image_noticia']."'  WHERE  id_noticia = '".$_GET['id']."'"); 
    $this->_msgbox->setMsgbox('Se actualizo correctamente.',2);
    location("noticias.php");
}


public function deleteNoticias(){
    $this->deleteFilesNoticias( $_GET['id'] );
    $query = new Consulta("DELETE FROM noticias WHERE id_noticia = '".$_GET['id']."'");
    $this->_msgbox->setMsgbox('Se elimino correctamente.',2);
    location("noticias.php");
}

public function deleteFilesNoticias($id){
    $query = new Consulta( "SELECT * FROM noticias WHERE id_noticia = '".$id."'" );
    $row = $query->VerRegistro();
}

public function listNoticias(){
$generico = array();
$generico = $this->getNoticias();
?><div id="content-area">
<table cellspacing="1" cellpading="1" class="listado">
<thead>
<tr class="head">
<th align="left">Noticias</th>
<th align="center" width="100" class="titulo">Opciones</th>
</tr>
</thead>
</table>
<ul id="listadoul" data-orden="ordenarNoticias"><!-- COPIAR  EN aplication/model/Ajax.php 
function ordenarNoticiasAjax(){
foreach($_GET['list_item'] as $position => $item){
$query = new Consulta("UPDATE noticias SET order_noticia = $position WHERE id_noticia = $item"); 
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
<a title="Editar" class="tooltip" href="noticias.php?id=<?php echo $b['id'] ?>&action=edit"><img src="<?php echo _admin_ ?>edit.png"></a>&nbsp;
<a title="Eliminar"  href="#" class="tooltip" onClick="mantenimiento('noticias.php','<?php echo $b['id'] ?>','delete')"><img src="<?php echo _admin_ ?>delete.png"></a>&nbsp;    
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

public function getNoticias(){
$sql   = " SELECT * FROM noticias ORDER BY order_noticia ASC";
$query = new Consulta($sql);
$datos = array();

while($row = $query->VerRegistro()){
$datos[] = array(
 'id' => $row['id_noticia'] ,
 'titulo' => $row['titulo_noticia'] ,
 'descripcion' => $row['descripcion_noticia'] ,
 'fecha' => $row['fecha_noticia'] ,
 'image' => $row['image_noticia'] ,
 'order' => $row['order_noticia'] );
}
return $datos;
}

public function orderNoticias($id=0){
$query = new Consulta("SELECT MAX(order_noticia) max_orden FROM noticias WHERE id_noticia = '".$id."'");
$row   = $query->VerRegistro();
return (int)($row['max_orden']+1);
}
}
?>