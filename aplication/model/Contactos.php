<?php 
class Contactos{
    private $_msgbox;
    public function __construct($msg='')
    {
		$this->_msgbox = $msg;
    }
    
    public function editContactos(){
		echo "<div class='success' style='padding:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;Subir imagenes con tamaño aproximado w = 1000px x h 500px  pixeles.</div>";
		$query = new Consulta("SELECT id_contacto,direccion_contacto,telefono_contacto,correo_contacto,almacen_direccion_contacto,imagen_contacto FROM contactos WHERE id_contacto = 1");
		Form::getForm($query, "edit", "contactos.php",'','','img');
    }     
    
    public function updateContactos() {
        $destino = '../aplication/webroot/imgs/catalogo/';
        if (isset($_FILES['imagen_contacto']['name']) && $_FILES['imagen_contacto']['name'] != "") {
           define("NAMETHUMB", "/tmp/thumbtemp");
			$ext = explode('.',$_FILES['imagen_contacto']['name']);
			$nombre_file = time().sef_string($ext[0]);
			$type_file = typeImage($_FILES['imagen_contacto']['type']);				
			$nombre = $nombre_file . $type_file;	
			
			$thumbnail = new ThumbnailBlob($_FILES['imagen_contacto'],NAMETHUMB,'../aplication/webroot/imgs/catalogo/contacto_');
			$thumbnail->setQuality(100);
			$thumbnail->CreateThumbnail(1000, 499,$nombre);	
			
			
			$thumbnail2 = new ThumbnailBlob($_FILES['imagen_contacto'],NAMETHUMB, '../aplication/webroot/imgs/catalogo/thumb_');
			$thumbnail2->setQuality(31);
			$thumbnail2->CreateThumbnail(135, 90,$nombre);	

			$update = "imagen_contacto='contacto_".$nombre."', thumb_contacto='thumb_".$nombre."', ";
        }		
        $query = new Consulta("UPDATE contactos SET  ". $update ." direccion_contacto='".$_POST['direccion_contacto']."' , telefono_contacto='".$_POST['telefono_contacto']."' , correo_contacto='".$_POST['correo_contacto']."' , almacen_direccion_contacto='".$_POST['almacen_direccion_contacto']."'  WHERE id_contacto = 1");
        //echo $query;
        $this->_msgbox->setMsgbox('Contacto actualizado correctamente.',2);
        location("contactos.php");
    }
	
    public function getContactos(){
        $sql   = " SELECT * FROM contactos";
		$query = new Consulta($sql);
		$datos = array();
		
		while($row = $query->VerRegistro()){
			$datos[] = array(
				'id'    	 => $row['id_contacto'],
                'direccion'      => $row['direccion_contacto'],
                'telefono'      => $row['telefono_contacto'],
                'correo'      => $row['correo_contacto'],
                'almacen_direccion'      => $row['almacen_direccion_contacto'],
                'imagen'      => $row['imagen_contacto'],
                'thumb'       => $row['thumb_contacto']
			);
		}
		return $datos;	
    } 

    public function addContacto(){

    }
   
}
?>