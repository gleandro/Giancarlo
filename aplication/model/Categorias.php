<?php
class Categorias{
	
	private $_msgbox;
	
	public function __construct(Msgbox $msg = NULL){
		$this->_msgbox = $msg ;
	}
	
	public function newCategorias(){
		?>
		<div class='success' style='padding:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;Subir imagenes con tamaño aproximado <strong>w = 1000px</strong> x <strong>h 500px</strong> pixeles, para la imagen principal de la categoria.</div>
		<br>
		<?php if ($_SESSION['categoria'] != 0){ ?>
        	<div class='success' style='padding:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;Subir imagenes con tamaño aproximado <strong>w = 320px</strong> x <strong>h 480px</strong> pixeles, para la imagen del detalle.</div>
   		<?php } ?>
        <fieldset id="form">
        	<legend>Nueva Categoria</legend>
        	<form action="" method="post" name="categorias" enctype="multipart/form-data"> 
            	
            	<div class="button-actions">
                	<input type="submit" name="" value="GUARDAR" onclick="return valida_categorias('add','')"  />
               		<input type="reset" name="" value="CANCELAR" />
                </div>
                <ul>
               		<li><label> Nombre Categoria: </label> <input type="text" class="text ui-widget-content ui-corner-all" size="59" name="nombre_categoria">
               		<?php if ($_SESSION['categoria']==0){ ?>
                    	<li><label> Imagen Categoria: </label> <input type="file" size="50"  class="text ui-widget-content ui-corner-all" name="imagen"></li>
               		<?php }else{ ?>
               			<li><label> Imagen Categoria: </label> <input type="file" size="50"  class="text ui-widget-content ui-corner-all" name="imagen"></li>
                    	<li><label> Imagen Detalle: </label> <input type="file" size="50"  class="text ui-widget-content ui-corner-all" name="imagen_detalle"></li>
                    <?php } ?>
                </ul>
        	</form>
        </fieldset>
		<?php
	}
	
	public function editCategorias(){
		$obj = new Categoria($_GET['id']);
		?>
		<div class='success' style='padding:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;Subir imagenes con tamaño aproximado <strong>w = 1000px</strong> x <strong>h 500px</strong> pixeles, para la imagen principal de la categoria.</div>
		<br>
		<?php if ($_SESSION['categoria'] != 0){ ?>
        	<div class='success' style='padding:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;Subir imagenes con tamaño aproximado <strong>w = 320px</strong> x <strong>h 480px</strong> pixeles, para la imagen del detalle.</div>
   		<?php } ?>
        <fieldset id="form">
        	<legend>Editar Categoria</legend>
        	<form action="" method="post" name="categorias"  enctype="multipart/form-data"> 
            	<div class="button-actions">
                	<input type="submit" name="" value="ACTUALIZAR" onclick="return valida_categorias('update','<?php echo $_GET['id'] ?>&ide=<?php echo $_GET['id'] ?>')"  />
               		<input type="reset" name="" value="CANCELAR" />
                </div>
                <ul>
                	<li><label> Nombre Categoria: </label> <input type="text" class="text ui-widget-content ui-corner-all" size="50" name="nombre_categoria"  value="<?php echo $obj->__get('_nombre') ?>" >
                	<?php if ($_SESSION['categoria']==0){ ?>
	                    <li><label> Imagen Categoria: </label> <input type="file"   class="text ui-widget-content ui-corner-all" size="50" name="imagen"></li>
	                    <li>
	                    	 <div align="center" class="img_categoria">
			                	<img src="<?php echo _catalogo_ . $obj->__get('_thumb') ?>"  width="200px"/>
			                </div>
	                    </li>
	                <?php }else{ ?>
	                	<li><label> Imagen Categoria: </label> <input type="file" class="text ui-widget-content ui-corner-all" size="50" name="imagen"></li>
	                    <li>
	                    	 <div align="center" class="img_categoria">
			                	<img src="<?php echo _catalogo_ . $obj->__get('_thumb') ?>"  width="200px"/>
			                </div>
	                    </li>
	                    <li><label> Imagen Detalle: </label> <input type="file" class="text ui-widget-content ui-corner-all" size="50" name="imagen_detalle"></li>
	                    <li>
	                    	 <div align="center" class="img_categoria">
			                	<img src="<?php echo _catalogo_ . $obj->__get('_imgdetalle') ?>" width="200px" />
			                </div>
	                    </li>
                    <?php } ?>

                </ul>
               
            	</form>
         </fieldset>
		<?php
	}
	
	public function addCategorias($cat=0){
		
		//echo $cat;
		if(isset($_FILES['imagen']) && $_FILES['imagen']['name'] != ""){
		
			$ext = explode('.',$_FILES['imagen']['name']);
			$nombre_file = time().sef_string($ext[0]);
			$type_file = typeImage($_FILES['imagen']['type']);				
			$nombre = $nombre_file . $type_file;
			
			define("NAMETHUMB", "/tmp/thumbtemp");
			$thumbnail = new ThumbnailBlob($_FILES['imagen'],NAMETHUMB,'../aplication/webroot/imgs/catalogo/categoria_');
			$thumbnail->setQuality(9);
			$thumbnail->SetTransparencia(true);
			$thumbnail->CreateThumbnail(1000,499,$nombre);

			$thumbnail2 = new ThumbnailBlob($_FILES['imagen'],NAMETHUMB,'../aplication/webroot/imgs/catalogo/thumb_');
			$thumbnail2->setQuality(9);
			$thumbnail2->SetTransparencia(true);
			$thumbnail2->CreateThumbnail(319,134,$nombre);

		}
				
		if(isset($_FILES['imagen_detalle']) && $_FILES['imagen_detalle']['name'] != ""){
			$thumbnail3 = new ThumbnailBlob($_FILES['imagen_detalle'],NAMETHUMB,'../aplication/webroot/imgs/catalogo/detalle_');
			$thumbnail3->setQuality(9);
			$thumbnail3->SetTransparencia(true);
			$thumbnail3->CreateThumbnail(319,481,$nombre);
		}
		
		$query = new Consulta("INSERT INTO categorias (nombre_categoria,imagen_categoria,thumb_categoria,imgdetalle_categoria,id_parent,orden_categoria) VALUES  ('".$_POST['nombre_categoria']."','categoria_".$nombre."','thumb_".$nombre."','detalle_".$nombre."','".$cat."','".$this->orderCategorias($cat)."')");
	

		$this->_msgbox->setMsgbox('La categoria se grabo correctamente.',2);
		location("productos.php");
	}
	
	public function orderCategorias($parent=0){
		$query = new Consulta("SELECT MAX(orden_categoria) max_orden 
									FROM categorias WHERE id_parent = '".$parent."'");
		
		$row   = $query->VerRegistro();
		return (int)($row['max_orden']+1);
	}
	
	public function updateCategorias($cat=0){

		if(isset($_FILES['imagen']) && $_FILES['imagen']['name'] != ""){
		
			$ext = explode('.',$_FILES['imagen']['name']);
			$nombre_file = time().sef_string($ext[0]);
			$type_file = typeImage($_FILES['imagen']['type']);				
			$nombre = $nombre_file . $type_file;
			
			//echo $nombre;
			
			define("NAMETHUMB", "/tmp/thumbtemp");
			$thumbnail = new ThumbnailBlob($_FILES['imagen'],NAMETHUMB,'../aplication/webroot/imgs/catalogo/categoria_');
			$thumbnail->setQuality(9);
			$thumbnail->SetTransparencia(true);
			$thumbnail->CreateThumbnail(1000,499,$nombre);
			$update1 = "imagen_categoria = 'categoria_".$nombre."' ,";

			$thumbnail2 = new ThumbnailBlob($_FILES['imagen'],NAMETHUMB,'../aplication/webroot/imgs/catalogo/thumb_');
			$thumbnail2->setQuality(9);
			$thumbnail2->SetTransparencia(true);
			$thumbnail2->CreateThumbnail(319,134,$nombre);
			$update2 = "thumb_categoria = 'thumb_".$nombre."' ,";
		}				

		if(isset($_FILES['imagen_detalle']) && $_FILES['imagen_detalle']['name'] != ""){
			
			$ext = explode('.',$_FILES['imagen_detalle']['name']);
			$nombre_file = time().sef_string($ext[0]);
			$type_file = typeImage($_FILES['imagen_detalle']['type']);				
			$nombre = $nombre_file . $type_file;

			$thumbnail3 = new ThumbnailBlob($_FILES['imagen_detalle'],NAMETHUMB,'../aplication/webroot/imgs/catalogo/detalle_');
			$thumbnail3->setQuality(9);
			$thumbnail3->SetTransparencia(true);
			$thumbnail3->CreateThumbnail(319,481,$nombre);
			$update3 = "imgdetalle_categoria = 'detalle_".$nombre."' ,";
		}
		
		
		$query = new Consulta("UPDATE categorias SET  ".$update1." ".$update2." ".$update3." nombre_categoria =  '".$_POST['nombre_categoria']."' WHERE id_categoria = '".$_GET['id']."' ");
		
								
		$this->_msgbox->setMsgbox('La categoria se actualizo correctamente.',2);
		location("productos.php");
	}
	
	public function deleteCategorias($cat=0){
		$this->deleteFilesBanners( $_GET['id'] );
		$query = new Consulta("DELETE FROM  categorias WHERE id_categoria = '".$_GET['id']."'");
		$this->_msgbox->setMsgbox('La categoria se elimino con exito.',2);
		location("productos.php");
	}
	public function deleteFilesBanners( $id ){
		
		$query = new Consulta( "SELECT * FROM categorias WHERE id_categoria = '".$id."'" );
		$row = $query->VerRegistro();
		if($row['imagen_categoria']!= '' ){
			if(file_exists(_link_file_ . $row['imagen_categoria'])){
				unlink (_link_file_ . $row['imagen_categoria']);
				unlink (_link_file_ . $row['thumb_categoria']);
				unlink (_link_file_ . $row['imgdetalle_categoria']);
			}							
		}	
		
	}
	
	public function getCategorias($id = "", $id_parent = 999999){

		$where = $id != "" ? " AND id_categoria = '".$id."' " : "";
		$where .= $id_parent != 999999 ? " AND id_parent = '".$id_parent."' " : "";

		$sql = "SELECT * FROM categorias WHERE id_categoria > 0  ".$where. " ORDER BY id_categoria";
		
		$query=new Consulta($sql);
		$retorno = array();
		while($row = $query->VerRegistro()){			
			$retorno[] = array(
				'id'		  =>	$row['id_categoria'],
				'nombre'	  =>	$row['nombre_categoria'],
				'imagen'	  =>	$row['imagen_categoria'],
				'thumb'	      =>	$row['thumb_categoria'],
				'imgdetalle'  =>	$row['imgdetalle_categoria'],
				'parent'	  =>	$row['id_parent']				
			);
		}
		return $retorno;		
	}

}
 ?>