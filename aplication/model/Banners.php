<?php
class Banners{

private $_msgbox, $_idioma, $_usuario;

public function __construct($msg = '' ,$idioma = '' ,$user = '' ){
          $this->_msgbox = $msg;
          $this->_idioma = $idioma;
          $this->_usuario = $user;
}

public function newBanners(){
     $query = new Consulta("SELECT id_banner ,titulo_banner ,titulo_principal_banner ,titulo_secundario_banner ,final_titulo_banner ,imagen_banner FROM  banners "); 
    echo  "<div class='success' style='padding:10px;'> &nbsp;&nbsp;&nbsp;&nbsp; Subir imagenes con tamaño aproximado w = 600px x h 350px  pixeles. </div>";  
    $obj_form = new Form();
    $obj_form->getForm($query, 'new', 'banners.php','','','img'); 
}

public function editBanners(){
     $query = new Consulta("SELECT id_banner ,titulo_banner ,titulo_principal_banner ,titulo_secundario_banner ,final_titulo_banner ,imagen_banner FROM  banners WHERE id_banner = '".$_GET['id']."'   "); 
    $obj_form = new Form();
    $obj_form->getForm($query, 'edit', 'banners.php','','','img'); 
}

public function addBanners(){
     if(isset($_FILES['imagen_banner']) && ($_FILES['imagen_banner']['name'] != '')){
       $obj  = new Upload();
       $destino = "../aplication/webroot/imgs/catalogo/"; 
       $name5 = strtolower(date("ymdhis").$_FILES['imagen_banner']['name']); 
       $temp = $_FILES['imagen_banner']['tmp_name']; 
       $type = $_FILES['imagen_banner']['type']; 
       $size = $_FILES['imagen_banner']['size']; 
       $obj->upload_imagen($name5, $temp, $destino, $type, $size); 
    }

    $query = new Consulta("INSERT INTO  banners(id_banner ,titulo_banner ,titulo_principal_banner ,titulo_secundario_banner ,final_titulo_banner ,thumb_banner ,order_banner ,imagen_banner) VALUES (
 '".$_POST['id_banner']."'  ,
 '".$_POST['titulo_banner']."'  ,
 '".$_POST['titulo_principal_banner']."'  ,
 '".$_POST['titulo_secundario_banner']."'  ,
 '".$_POST['final_titulo_banner']."'  ,
 '".$_POST['thumb_banner']."'  ,
 '".$_POST['order_banner']."'  ,
 '".$_POST['imagen_banner']."'  )"); 
    $this->_msgbox->setMsgbox('Se agregó correctamente.',2);
    location("banners.php");
}


public function updateBanners(){
     if(isset($_FILES['imagen_banner']) && ($_FILES['imagen_banner']['name'] != '')){
       $obj  = new Upload();
       $destino = "../aplication/webroot/imgs/catalogo/"; 
       $name5 = strtolower(date("ymdhis").$_FILES['imagen_banner']['name']); 
       $temp = $_FILES['imagen_banner']['tmp_name']; 
       $type = $_FILES['imagen_banner']['type']; 
       $size = $_FILES['imagen_banner']['size']; 
       $obj->upload_imagen($name5, $temp, $destino, $type, $size); 
       $update = " imagen_banner = '".$name5."' "; 
       $query = new Consulta("UPDATE  banners SET ".$update." WHERE id_banner = '".$_GET['id']."'"); 
    }

    $query = new Consulta("UPDATE banners SET 
     titulo_banner = '".$_POST['titulo_banner']."'  ,
     titulo_principal_banner = '".$_POST['titulo_principal_banner']."'  ,
     titulo_secundario_banner = '".$_POST['titulo_secundario_banner']."'  ,
     final_titulo_banner = '".$_POST['final_titulo_banner']."'  WHERE  id_banner = '".$_GET['id']."'"); 
    $this->_msgbox->setMsgbox('Se actualizo correctamente.',2);
    location("banners.php");
}


public function deleteBanners(){
    $this->deleteFilesBanners( $_GET['id'] );
    $query = new Consulta("DELETE FROM banners WHERE id_banner = '".$_GET['id']."'");
    $this->_msgbox->setMsgbox('Se elimino correctamente.',2);
    location("banners.php");
}

public function deleteFilesBanners($id){
    $query = new Consulta( "SELECT * FROM banners WHERE id_banner = '".$id."'" );
    $row = $query->VerRegistro();
    if($row['imagen_banner']!= '' ){
      if(file_exists(_link_file_ . $row['imagen_banner'])){
        unlink (_link_file_ . $row['imagen_banner']);
      }
    }
}

public function listBanners(){
$generico = array();
$generico = $this->getBanners();
?><div id="content-area">
<table cellspacing="1" cellpading="1" class="listado">
<thead>
<tr class="head">
<th align="left">Banners</th>
<th align="center" width="100" class="titulo">Opciones</th>
</tr>
</thead>
</table>
<ul id="listadoul" data-orden="ordenarBanners"><!-- COPIAR  EN aplication/model/Ajax.php 
function ordenarBannersAjax(){
foreach($_GET['list_item'] as $position => $item){
$query = new Consulta("UPDATE banners SET order_banner = $position WHERE id_banner = $item"); 
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
<a title="Editar" class="tooltip" href="banners.php?id=<?php echo $b['id'] ?>&action=edit"><img src="<?php echo _admin_ ?>edit.png"></a>&nbsp;
<a title="Eliminar"  href="#" class="tooltip" onClick="mantenimiento('banners.php','<?php echo $b['id'] ?>','delete')"><img src="<?php echo _admin_ ?>delete.png"></a>&nbsp;    
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

public function getBanners(){
$sql   = " SELECT * FROM banners ORDER BY order_banner ASC";
$query = new Consulta($sql);
$datos = array();

while($row = $query->VerRegistro()){
$datos[] = array(
 'id' => $row['id_banner'] ,
 'titulo' => $row['titulo_banner'] ,
 'titulo_principal' => $row['titulo_principal_banner'] ,
 'titulo_secundario' => $row['titulo_secundario_banner'] ,
 'final_titulo' => $row['final_titulo_banner'] ,
 'imagen' => $row['imagen_banner'] ,
 'thumb' => $row['thumb_banner'] ,
 'order' => $row['order_banner'] );
}
return $datos;
}

public function orderBanners($id=0){
$query = new Consulta("SELECT MAX(order_banner) max_orden FROM banners WHERE id_banner = '".$id."'");
$row   = $query->VerRegistro();
return (int)($row['max_orden']+1);
}
}
?>