<?php
class Ordenes{

private $_msgbox, $_idioma, $_usuario;

public function __construct($msg = '' ,$idioma = '' ,$user = '' ){
$this->_msgbox = $msg;
$this->_idioma = $idioma;
$this->_usuario = $user;
}

public function newOrdenes(){
 $query = new Consulta("SELECT id_orden ,nombre_orden ,fecha_orden ,order_orden FROM  ordenes "); 
echo  "<div class='success' style='padding:10px;'> &nbsp;&nbsp;&nbsp;&nbsp; Subir imagenes con tamaño aproximado w = 600px x h 350px  pixeles. </div>";  
$obj_form = new Form();
$obj_form->getForm($query, 'new', 'ordenes.php','','','img'); 
}

public function editOrdenes(){
 $query = new Consulta("SELECT id_orden ,nombre_orden ,fecha_orden ,order_orden FROM  ordenes WHERE id_orden = '".$_GET['id']."'   "); 
echo  "<div class='success' style='padding:10px;'> &nbsp;&nbsp;&nbsp;&nbsp; Subir imagenes con tamaño aproximado w = 600px x h 350px  pixeles. </div>";  
$obj_form = new Form();
$obj_form->getForm($query, 'edit', 'ordenes.php','','','img'); 
}

public function addOrdenes(){
$id = mysql_insert_id();
$query = new Consulta("INSERT INTO  ordenes(id_orden ,nombre_orden ,fecha_orden ,order_orden) VALUES (
 '".$_POST['id_orden']."'  ,
 '".$_POST['nombre_orden']."'  ,
 '".$_POST['fecha_orden']."'  ,
 '".$_POST['order_orden']."'  )"); 
$this->_msgbox->setMsgbox('Se agregó correctamente.',2);
location("ordenes.php");
}


public function updateOrdenes() {
$id = mysql_insert_id();
$query = new Consulta("UPDATE ordenes SET 
 WHERE  id_orden = '".$_GET['id']."'"); 
$this->_msgbox->setMsgbox('Se actualizo correctamente.',2);
location("ordenes.php");
}

public function deleteOrdenes(){
$this->deleteFilesOrdenes( $_GET['id'] );
$query = new Consulta("DELETE FROM ordenes WHERE id_orden = '".$_GET['id']."'");
$this->_msgbox->setMsgbox('Se elimino correctamente.',2);
location("ordenes.php");
}

public function deleteFilesOrdenes($id){
$query = new Consulta( "SELECT * FROM ordenes WHERE id_orden = '".$id."'" );
$row = $query->VerRegistro();
}

public function listOrdenes(){
$generico = array();
$generico = $this->getOrdenes();
?><div id="content-area">
<table cellspacing="1" cellpading="1" class="listado">
<thead>
<tr class="head">
<th align="left">Ordenes</th>
<th align="center" width="100" class="titulo">Opciones</th>
</tr>
</thead>
</table>
<ul id="listadoul" data-orden="ordenarOrdenes"><!-- COPIAR  EN aplication/model/Ajax.php 
function ordenarOrdenesAjax(){
foreach($_GET['list_item'] as $position => $item){
$query = new Consulta("UPDATE ordenes SET order_orden = $position WHERE id_orden = $item"); 
}
}
-->
<?php
$y = 1;
foreach($generico as $b){
?>
<li class="<?php echo ($y%2 == 0) ? "fila1" : "fila2"; ?>" id="list_item_<?php echo $b['id']; ?>"> 
<div class="data"><img style="vertical-align: middle;" src="<?php echo _admin_ ?>icon_banner.png" class="handle"> <?php echo $b[''] ?></div>
<div class="options">
<a class="tooltip move" title="Ordenar ( Click + Arrastrar )"><img src="<?php echo _admin_ ?>move.png" class="handle"></a>&nbsp;
<a title="Editar" class="tooltip" href="ordenes.php?id=<?php echo $b['id'] ?>&action=edit"><img src="<?php echo _admin_ ?>edit.png"></a>&nbsp;
<a title="Eliminar"  href="#" class="tooltip" onClick="mantenimiento('ordenes.php','<?php echo $b['id'] ?>','delete')"><img src="<?php echo _admin_ ?>delete.png"></a>&nbsp;    
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

public function getOrdenes(){
$sql   = " SELECT * FROM ordenes ORDER BY order_orden ASC";
$query = new Consulta($sql);
$datos = array();

while($row = $query->VerRegistro()){
$datos[] = array(
 'id' => $row['id_orden'] ,
 'nombre' => $row['nombre_orden'] ,
 'fecha' => $row['fecha_orden'] ,
 'order' => $row['order_orden'] );
}
return $datos;
}

public function orderOrdenes($id=0){
$query = new Consulta("SELECT MAX(order_orden) max_orden FROM ordenes WHERE id_orden = '".$id."'");
$row   = $query->VerRegistro();
return (int)($row['max_orden']+1);
}
}
?>