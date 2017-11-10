<?php include("inc.aplication_top.php");
include(_includes_."admin/inc.header.php"); 
?>
<body>
	<div id="dw-window"> 
    	<div id="dw-admin">
            <div id="dw-menu">
               <!-- Menu -->
               <?php include(_includes_."admin/inc.top.php"); ?>
            </div>
            <div id="dw-page">
                <div id="dw-cuerpo">
                    <h1>Administrar Cont&aacute;ctenos
                        
                    </h1>
                    <?php echo $msgbox->getMsgbox();
                    $obj =  new Contactos($msgbox);
                    if($_GET['action']){
                        $accion = $_GET['action']."Contactos";    
                        $obj->$accion();
                    }else{
                        $obj->editContactos();   
                    }
					?>	
                </div>
            </div> 
			                       
        </div>
    </div>
</body>
</html>
<?php include("inc.aplication_bottom.php"); ?>