<?php
include("inc.aplication_top.php");
$cu = new Cuenta($cliente);
if ($_GET['param'] == 'page_tutores') {

    if (!isset($_GET['pag'])) {
        $_GET['pag'] = 1;
    }
    $tampag = 4;
    $reg1 = ($_GET['pag'] - 1) * $tampag;

    $obj_usuarios = new Usuarios();
    $array_usuarios = $obj_usuarios->getTutores($reg1, $tampag);
    $total_usuarios = count($array_usuarios);

    for ($i = 0; $i < $total_usuarios; $i++) {
?>
        <div class="tutor">
            <div class="photo_tutor"><a href="#"><img src="aplication/utilities/img_exact.php?imagen=<?php echo $array_usuarios[$i]['imagen'] ?>&w=55&h=80" /></a></div>
            <h1><a href="detalle_tutor.html"><?php echo $array_usuarios[$i]['usuario'] ?></a></h1>
    <p><?php
        $ts = $array_usuarios[$i]['soluciones'];
        echo ($ts == 1) ? "1 solucion" : $ts . " soluciones" ?></p>
        </div>
<?php
    }
} else if ($_GET['param'] == 'page_prods') {

    if (!isset($_GET['pag'])) {
        $_GET['pag'] = 1;
    }
    $tampag = 6;
    $reg1 = ($_GET['pag'] - 1) * $tampag;

    $obj_u = new Usuario();
    $obj_p = new Productos($idioma, $msgbox, $obj_u);

    $array_productos = $obj_p->getProductosHome($reg1, $tampag);
    $total_productos = count($array_productos);

    for ($i = 0; $i < $total_productos; $i++) {
?>

        <div class="solucionario">
            <a href="solucionarios.php?prod=<?php echo $array_productos[$i]['id'] ?>" class="personPopupTrigger" rel="<?php echo $array_productos[$i]['id'] ?>,0"><img src="aplication/webroot/imgs/catalogo/<?php echo $array_productos[$i]['imagen'] ?>" width="54" height="80" alt="productos" /></a>
            <h1><a href="solucionarios.php?prod=<?php echo $array_productos[$i]['id'] ?>" ><?php echo $array_productos[$i]['nombre'] ?></a></h1>
        <p><?php echo $array_productos[$i]['autor']->__get("_nombre") ?></p>
        <p><?php echo $array_productos[$i]['libro']->__get("_titulo") ?></p>
<?php
        //if ($array_productos[$i]['precio'] == 0) {
?>
         <?php
		if($cuenta->getCliente()->getLogeado()==true){
                   if($cu->MostraPrecio($cuenta, $_GET['id']) == 0){
          ?>
                      <div class="precio_gratis">gratis</div>
    <?php //} else {
 ?>
            <div class="precio"><?php echo $cu->MostraPrecio($cuenta, $array_productos[$i]['id'] );?></div>
<?php              }

                 }
            ?>

    </div>
<?php
    }
} else if ($_GET['param'] == 'page_prods_rel') {

    if (!isset($_GET['pag'])) {
        $_GET['pag'] = 1;
    }
    $tampag = 3;
    $reg1 = ($_GET['pag'] - 1) * $tampag;

    $obj_u = new Usuario();
    $obj_p = new Productos($idioma, $msgbox, $obj_u);

    $array_productos = $obj_p->getProductosRelacion($_GET['id'], $reg1, $tampag);
    $total_productos = count($array_productos);

    for ($i = 0; $i < $total_productos; $i++) {
        $p = new Producto($array_productos[$i]['id'], $idioma);
        $imagenes = $p->__get("_imagenes");
?>

        <div class="solucionario">
            <a href="solucionarios.php?prod=<?php echo $p->__get("_id"); ?>"><img src="aplication/webroot/imgs/catalogo/<?php echo $p->__get("_imagen") ?>" width="54" height="80" alt="productos" />
            </a>
            <h1><a href="solucionarios.php?prod=<?php echo $p->__get("_id"); ?>"><?php echo $p->__get("_nombre"); ?></a></h1>
        <p><?php echo $p->__get("_autor")->__get("_nombre") ?></p>
        <p><?php echo $p->__get("_libro")->__get("_titulo") ?></p>
<?php
        if ($p->__get("_precio") == 0) {
?>
            <div class="precio_gratis">gratis</div>
    <?php } else {
 ?>
            <?php
		if($cuenta->getCliente()->getLogeado()==true){
           if($cu->MostraPrecio($cuenta, $_GET['id']) == 0){
    ?>
            <div class="precio"><?php echo $cu->MostraPrecio($cuenta, $p->__get("_id") );?></div>
<?php
        }
                }
    }
?>
        </div>
<?php
    }
} else if ($_GET['param'] == 'page_prods_rel') {

    if (!isset($_GET['pag'])) {
        $_GET['pag'] = 1;
    }
    $tampag = 3;
    $reg1 = ($_GET['pag'] - 1) * $tampag;

    $obj_u = new Usuario();
    $obj_p = new Productos($idioma, $msgbox, $obj_u);

    $array_productos = $obj_p->getProductosRelacion($_GET['id'], $reg1, $tampag);
    $total_productos = count($array_productos);

    for ($i = 0; $i < $total_productos; $i++) {
        $p = new Producto($array_productos[$i]['id'], $idioma);
        $imagenes = $p->__get("_imagenes");
?>

        <div class="solucionario">
            <a href="solucionarios.php?prod=<?php echo $p->__get("_id"); ?>"><img src="aplication/webroot/imgs/catalogo/<?php echo $p->__get("_imagen") ?>" width="54" height="80" alt="productos" />
            </a>
            <h1><a href="solucionarios.php?prod=<?php echo $p->__get("_id"); ?>"><?php echo $p->__get("_nombre"); ?></a></h1>
        <p><?php echo $p->__get("_autor")->__get("_nombre") ?></p>
        <p><?php echo $p->__get("_libro")->__get("_titulo") ?></p>
    <?php
        if ($p->__get("_precio") == 0) {
    ?>
            <div class="precio_gratis">gratis</div>
    <?php } else {
 ?>
           <?php 
		if($cuenta->getCliente()->getLogeado()==true){
           if($cu->MostraPrecio($cuenta, $_GET['id']) == 0){
    ?>
            <div class="precio"><?php echo $cu->MostraPrecio($cuenta, $p->__get("_id") );?></div>
<?php
        }
                }
                
                }
?>
        </div>
<?php
    }
} else if ($_GET['param'] == 'solucionario_detail') {
    $obj = new Producto($_GET['id'], $idioma);
?>
    <div class="content_detail_solucionario">
        <h2><?php echo $obj->__get("_nombre") ?></h2>
        <div><?php echo $obj->__get("_autor")->__get("_nombre") ?></div>
        <div><?php echo $obj->__get("_libro")->__get("_titulo") ?></div>
        <p class="des">
<?php echo $obj->__get("_descripcion_corta") ?>
            <a href="solucionarios.php?prod=<?php echo $obj->__get("_id") ?>"> Ver detalle</a>
    </p>
    <div class="pay">
    <?php 
		if($cuenta->getCliente()->getLogeado()==true){
           if($cu->MostraPrecio($cuenta, $_GET['id']) == 0){
    ?>
        <b>Precio: <?php echo SIMBOLO_MONEDA; ?> 0.00</b>
     <?php
	  }else{ ?>  
       <b>Precio: <?php echo SIMBOLO_MONEDA; ?> <?php echo $cu->MostraPrecio($cuenta, $_GET['id'] );?></b>
       <?php
       }
	}?>
        <a href="cesta.php?prod=<?php echo $obj->__get("_id") ?>&car=add"><img src="aplication/webroot/imgs/add_cart.jpg"></a>
    </div>
</div>
<?php
    } else if ($_GET['action'] == 'acceso') {

        $cuenta->cuentaAcceso();
    } else if ($_GET['action'] == 'registro') {

        $cuenta->cuentaAdd();
    }else if ($_GET['action'] == 'recuperarContrasenia') {

        $cuenta->enviarContrasenia();
    } else if ($_GET['action'] == 'acceso_tutoria') {

        $cuenta->cuentaAccesoTutoria();
    } else if ($_GET['action'] == 'CargaTutores') {

        $sql = new Consulta("SELECT * FROM usuarios u, tutores_especialidad te
		                    WHERE u.id_usuario=te.id_tutor 
							AND te.id_especialidad='" . $_POST['id'] . "' order by 2");

        while ($rows = $sql->VerRegistro()) {
            $combo .= '<option value="' . $rows['id_usuario'] . "-" . $rows['nombre_usuario'] . " " . $rows['apellidos_usuario'] . '">' . $rows['nombre_usuario'] . " " . $rows['apellidos_usuario'] . '</option>';
        }

        echo $combo;


    } else if ($_GET['action'] == 'CargaHorarios') {

        $lista .='<div style="float:left; width:40px; background: #EEFABB;">
                     <div style="border-right: solid 1px; border-bottom: solid 1px;  width:35px; height:20px; text-align:center; padding-top:8px; background: #EEEEEE;">LUN</div>
                     <div style="border-right: solid 1px; border-bottom: solid 1px; width:35px; height:20px; text-align:center; padding-top:8px; background: #EEEEEE;">MAR</div>
                     <div style="border-right: solid 1px; border-bottom: solid 1px; width:35px; height:20px; text-align:center; padding-top:8px; background: #EEEEEE;">MIE</div>
                     <div style="border-right: solid 1px; border-bottom: solid 1px; width:35px; height:20px; text-align:center; padding-top:8px; background: #EEEEEE;">JUE</div>
                     <div style="border-right: solid 1px; border-bottom: solid 1px; width:35px; height:20px; text-align:center; padding-top:8px; background: #EEEEEE;">VIE</div>
                     <div style="border-right: solid 1px; border-bottom: solid 1px; width:35px; height:20px; text-align:center; padding-top:8px; background: #EEEEEE;">SAB</div>
                     <div style="border-right: solid 1px; border-bottom: solid 1px; width:35px; height:20px; text-align:center; padding-top:8px; background: #EEEEEE;">DOM</div>
                  </div>';
            
       
        $sql2 = new Consulta("SELECT hora FROM horarios WHERE id_tutor='".$_POST['id']."' AND dia='LUN' ORDER BY hora");
        $lista .='<div style=" border-bottom: solid 1px; float:left; width:460px; background: #EEFABB;">';
        if($sql2->NumeroRegistros()>0){
           while ($row2 = $sql2->VerRegistro()) {
                  $lista .='<div style=" float:left;  width:35px; height:20px; text-align:center; padding-top:8px; background: #EEFABB;">' . $row2['hora'] . ' - </div>';
           }
        }else{
                  $lista .='<div style=" float:left;  width:420px; height:20px; text-align:center; padding-top:8px; background: #EEFABB;">NO DISPONIBLE</div>';
        }
        $lista .='</div>';



        $sql3 = new Consulta("SELECT hora FROM horarios WHERE id_tutor='".$_POST['id']."' AND dia='MAR' ORDER BY hora");
        $lista .='<div style=" border-bottom: solid 1px; float:left; width:460px; background: #EEFABB;">';
        if($sql3->NumeroRegistros()>0){
           while ($row3 = $sql3->VerRegistro()) {
                  $lista .='<div style=" float:left;  width:35px; height:20px; text-align:center; padding-top:8px; background: #EEFABB;">' . $row3['hora'] . ' - </div>';
           }
        }else{
                  $lista .='<div style=" float:left;  width:420px; height:20px; text-align:center; padding-top:8px; background: #EEFABB;">NO DISPONIBLE</div>';
        }
        $lista .='</div>';



        $sql4 = new Consulta("SELECT hora FROM horarios WHERE id_tutor='".$_POST['id']."' AND dia='MIE' ORDER BY hora");
        $lista .='<div style=" border-bottom: solid 1px; float:left; width:460px; background: #EEFABB;">';
        if($sql4->NumeroRegistros()>0){
           while ($row4 = $sql4->VerRegistro()) {
                  $lista .='<div style=" float:left;  width:35px; height:20px; text-align:center; padding-top:8px; background: #EEFABB;">' . $row4['hora'] . ' - </div>';
           }
        }else{
                  $lista .='<div style=" float:left;  width:420px; height:20px; text-align:center; padding-top:8px; background: #EEFABB;">NO DISPONIBLE</div>';
        }
        $lista .='</div>';



        $sql5 = new Consulta("SELECT hora FROM horarios WHERE id_tutor='".$_POST['id']."' AND dia='JUE' ORDER BY hora");
        $lista .='<div style=" border-bottom: solid 1px; float:left; width:460px; background: #EEFABB;">';
        if($sql5->NumeroRegistros()>0){
           while ($row5 = $sql5->VerRegistro()) {
                  $lista .='<div style=" float:left;  width:35px; height:20px; text-align:center; padding-top:8px; background: #EEFABB;">' . $row5['hora'] . ' - </div>';
           }
        }else{
                  $lista .='<div style=" float:left;  width:420px; height:20px; text-align:center; padding-top:8px; background: #EEFABB;">NO DISPONIBLE</div>';
        }
        $lista .='</div>';



        $sql6 = new Consulta("SELECT hora FROM horarios WHERE id_tutor='".$_POST['id']."' AND dia='VIE' ORDER BY hora");
        $lista .='<div style=" border-bottom: solid 1px; float:left; width:460px; background: #EEFABB;">';
        if($sql6->NumeroRegistros()>0){
           while ($row6 = $sql6->VerRegistro()) {
                  $lista .='<div style=" float:left;  width:35px; height:20px; text-align:center; padding-top:8px; background: #EEFABB;">' . $row6['hora'] . ' - </div>';
           }
        }else{
                  $lista .='<div style=" float:left;  width:420px; height:20px; text-align:center; padding-top:8px; background: #EEFABB;">NO DISPONIBLE</div>';
        }
        $lista .='</div>';



        $sql7 = new Consulta("SELECT hora FROM horarios WHERE id_tutor='".$_POST['id']."' AND dia='SAB' ORDER BY hora");
        $lista .='<div style=" border-bottom: solid 1px; float:left; width:460px; background: #EEFABB;">';
        if($sql7->NumeroRegistros()>0){
           while ($row7 = $sql7->VerRegistro()) {
                  $lista .='<div style=" float:left;  width:35px; height:20px; text-align:center; padding-top:8px; background: #EEFABB;">' . $row7['hora'] . ' - </div>';
           }
        }else{
                  $lista .='<div style=" float:left;  width:420px; height:20px; text-align:center; padding-top:8px; background: #EEFABB;">NO DISPONIBLE</div>';
        }
        $lista .='</div>';



        $sql8 = new Consulta("SELECT hora FROM horarios WHERE id_tutor='".$_POST['id']."' AND dia='DOM' ORDER BY hora");
        $lista .='<div style=" border-bottom: solid 1px; float:left; width:460px; background: #EEFABB;">';
        if($sql8->NumeroRegistros()>0){
           while ($row8 = $sql8->VerRegistro()) {
                  $lista .='<div style=" float:left;  width:35px; height:20px; text-align:center; padding-top:8px; background: #EEFABB;">' . $row8['hora'] . ' - </div>';
           }
        }else{
                  $lista .='<div style=" float:left;  width:420px; height:20px; text-align:center; padding-top:8px; background: #EEFABB;">NO DISPONIBLE</div>';
        }
        $lista .='</div>
                  <br clear="all" />';

       

       echo $lista;
    }
?>