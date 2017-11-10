<?php 
include_once("../inc.core.php");
function my_autoloader($class) {
	if(file_exists( _model_.$class.'.php'  )){
		include _model_.$class.'.php';
	}
}
spl_autoload_register('my_autoloader');

?>
<html>
    <head>
        <title>Generador CRUD</title>
        <link rel='stylesheet' type='text/css' href="../aplication/webroot/css/generador.css">
        <script type="text/javascript" src="../aplication/webroot/js/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="../aplication/webroot/js/generador.js"></script>
        
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li>Home</li>
                    <li><a href="index.php">Generador</a></li>
                    <li><a href="generar_tablas.php">Tablas</a></li>
                </ul>
            </nav>
        </header>
        <div id="principal">
        <div id="container">
            <h1>Generador CRUD</h1>
            <?php 
                  if($link = new Conexion($_config['bd']['server'],$_config['bd']['user'],$_config['bd']['password'],$_config['bd']['name'])){
                        $sql = "SHOW TABLES FROM ".$_config['bd']['name'];
                        $query = new Consulta($sql);         
                  ?>
            <div class="load_process">CARGANDO...</div>
                <div id="contenedor_recarga">
                    Seleccione tabla(s):<br><br>
                    <form method="post" action="" id="formulario_generar" name="formulario_generar">
                        <input type="checkbox" name="marcartodo"> Marcar todo<br>
                        <?php    
                     
                            $tablas_restringidas = array('configuracion','idiomas','roles','usuarios','usuarios_secciones','secciones','modulos');
                            while ($row = $query->VerRegistro()) {
                                
                                if(!strstr($tablas_restringidas[0],$row[0]) &&
                                        !strstr($tablas_restringidas[1],$row[0]) &&
                                        !strstr($tablas_restringidas[2],$row[0]) &&
                                        !strstr($tablas_restringidas[3],$row[0]) &&
                                        !strstr($tablas_restringidas[4],$row[0]) &&
                                        !strstr($tablas_restringidas[5],$row[0]) &&
                                        !strstr($tablas_restringidas[6],$row[0])){
                                
                                
                                /*$x = 0;
                                foreach ($tablas_restringidas as $value) {
                                    $x++;
                                    if(!strstr($value,$row[0])){
                                        if($x == 1){ */   
                                            echo '&nbsp;&nbsp;<input type="checkbox" class="check" name="tablelist[]" value="'.$row[0].'" >'.$row[0].'<br>';
                                        /*}
                                    }
                                }*/
                                
                                }
                                
                                
                            }    
                        ?> 
                        <br>
                        <button id="btn_generar" class="btn-primary" type="button">Generar</button>
                    </form>
                </div>  
                  <?php    
                  }else {
                        echo "<div class='error_data'>".$link = new Conexion($_config['bd']['server'],$_config['bd']['user'],$_config['bd']['password'],$_config['bd']['name'])."</div>";
                  }
                  
            ?>
        </div>
        </div>
    </body>
</html>
