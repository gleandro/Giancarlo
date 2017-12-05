<?php
class Clientes{
    private $_msgbox;
    public function __construct($msg='')
    {
		$this->_msgbox = $msg;
    }

    public function newClientes(){
		echo "<div class='success' style='padding:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;Subir imagenes con tamaño aproximado w = 1590px x h 410px  pixeles.</div>";
		$query = new Consulta("SELECT id_cliente, nombre_cliente, imagen_cliente FROM clientes");
		$obj_form = new Form();
                $obj_form->getForm($query, "new", "clientes.php",'','','img');
    }

    public function editClientes(){
		echo "<div class='success' style='padding:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;Subir imagenes con tamaño aproximado w = 1590px x h 410px  pixeles.</div>";
		$query = new Consulta("SELECT id_cliente, nombre_cliente, imagen_cliente FROM clientes WHERE id_cliente = '".$_GET['id']."'");
		$obj_form = new Form();
                $obj_form->getForm($query, "edit", "clientes.php",'','','img');
    }

    public function addClientes() {
        $destino = '../aplication/webroot/imgs/catalogo/';
        $update = ", '" . $nombre . "' ";

        if (isset($_FILES['imagen_cliente']['name']) && $_FILES['imagen_cliente']['name'] != "") {
			define("NAMETHUMB", "/tmp/thumbtemp");
			$ext = explode('.',$_FILES['imagen_cliente']['name']);
			$nombre_file = time().sef_string($ext[0]);
			$type_file = typeImage($_FILES['imagen_cliente']['type']);
			$nombre = $nombre_file . $type_file;

			$thumbnail = new ThumbnailBlob($_FILES['imagen_cliente'],NAMETHUMB,'../aplication/webroot/imgs/catalogo/cliente_');
			$thumbnail->setQuality(100);
			$thumbnail->CreateThumbnail(110, 100,$nombre);


			$thumbnail2 = new ThumbnailBlob($_FILES['imagen_cliente'],NAMETHUMB, '../aplication/webroot/imgs/catalogo/thumb_');
			$thumbnail2->setQuality(31);
			$thumbnail2->CreateThumbnail(125, 90,$nombre);

        }

        $query = new Consulta("INSERT INTO clientes(nombre_cliente, imagen_cliente, thumb_cliente, order_cliente) VALUES('".$_POST['nombre_cliente']."', 'cliente_".$nombre."' , 'thumb_".$nombre."' , 0 )");

        $this->_msgbox->setMsgbox('Cliente actualizado correctamente.',2);
        location("clientes.php");
    }


    public function updateClientes() {
        $destino = '../aplication/webroot/imgs/catalogo/';
        if (isset($_FILES['imagen_cliente']['name']) && $_FILES['imagen_cliente']['name'] != "") {
           define("NAMETHUMB", "/tmp/thumbtemp");
			$ext = explode('.',$_FILES['imagen_cliente']['name']);
			$nombre_file = time().sef_string($ext[0]);
			$type_file = typeImage($_FILES['imagen_cliente']['type']);
			$nombre = $nombre_file . $type_file;

			$thumbnail = new ThumbnailBlob($_FILES['imagen_cliente'],NAMETHUMB,'../aplication/webroot/imgs/catalogo/cliente_');
			$thumbnail->setQuality(100);
			$thumbnail->CreateThumbnail(110, 100,$nombre);


			$thumbnail2 = new ThumbnailBlob($_FILES['imagen_cliente'],NAMETHUMB, '../aplication/webroot/imgs/catalogo/thumb_');
			$thumbnail2->setQuality(31);
			$thumbnail2->CreateThumbnail(125, 90,$nombre);

			$update = "imagen_cliente='cliente_".$nombre."', thumb_cliente='thumb_".$nombre."', ";
        }
        $query = new Consulta("UPDATE clientes SET  ". $update ." nombre_cliente='".$_POST['nombre_cliente']."'  WHERE id_cliente = '" . $_GET['id'] . "'");
        $this->_msgbox->setMsgbox('Cliente actualizado correctamente.',2);
        location("clientes.php");
    }


	public function deleteClientes(){
		$this->deleteFilesBanners( $_GET['id'] );
		$query = new Consulta("DELETE  FROM clientes WHERE id_cliente = '".$_GET['id']."'");
		$this->_msgbox->setMsgbox('Se elimino correctamente.',2);
		location("clientes.php");
	}

	public function deleteFilesClientes( $id ){
		$query = new Consulta( "SELECT * FROM clientes WHERE id_cliente = '".$id."'" );
		$row = $query->VerRegistro();
		if($row['imagen_cliente']!= '' ){
			if(file_exists(_link_file_ . $row['imagen_cliente'])){
				unlink (_link_file_ . $row['imagen_cliente']);
				unlink (_link_file_ . $row['thumb_cliente']);
			}
		}
	}

    public function listClientes(){

		$banners = array();
		$banners = $this->getClientes();
		//$query = new Conculta("SELECT * FROM banners ORDER BY order_banner DESC");
       ?>
	   	<div id="content-area">
            <table cellspacing="1" cellpading="1" class="listado">
                <thead>
                    <tr class="head">
                        <th align="left">Clientes</th>
                        <th align="center" width="100" class="titulo">Opciones</th>
                   </tr>
                </thead>
            </table>
            <ul id="listadoul" data-orden="ordenarCliente">
			 <?php
				$y = 1;
				foreach($banners as $b){
				?>
				<li class="<?php echo ($y%2 == 0) ? "fila1" : "fila2"; ?>" id="list_item_<?php echo $b['id']; ?>">
					<div class="data"><img style="vertical-align: middle;" src="<?php echo _admin_ ?>icon_banner.png" class="handle"> <?php echo $b['nombre'] ?></div>
					<div class="options">

							<a class="tooltip move" title="Ordenar ( Click + Arrastrar )"><img src="<?php echo _admin_ ?>move.png" class="handle"></a>&nbsp;
							<a title="Editar" class="tooltip" href="clientes.php?id=<?php echo $b['id'] ?>&action=edit"><img src="<?php echo _admin_ ?>edit.png"></a>&nbsp;
							<a title="Eliminar"  href="#" class="tooltip" onClick="mantenimiento('clientes.php','<?php echo $b['id'] ?>','delete')"><img src="<?php echo _admin_ ?>delete.png"></a>&nbsp;
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

    public function getClientes(){
    $sql   = " SELECT * FROM clientes ORDER BY nombres_cliente ASC";
		$query = new Consulta($sql);
		$datos = array();

		while($row = $query->VerRegistro()){
			$datos[] = array(
				'id'  => $row['id_cliente'],
        'nombre'  => $row['nombres_cliente'],
			);
		}
		return $datos;
    }

    public function orderClientes($id=0){
        $query = new Consulta("SELECT MAX(order_cliente) max_orden FROM clientes WHERE id_cliente= '".$id."'");

        $row   = $query->VerRegistro();
        return (int)($row['max_orden']+1);
    }
}
?>
