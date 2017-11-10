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
        <title>Generador Tablas </title>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
        <link rel='stylesheet' type='text/css' href="../aplication/webroot/css/generador.css">
        
        <script type="text/javascript" src="../aplication/webroot/js/jquery-2.1.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
        <script type="text/javascript" src="../aplication/webroot/js/generador.js"></script>
      
    </head>
    <body>
        <div id="principal_tabla">
        <div id="container">
            <h1>Generador Tablas </h1>
            <?php 
                  if($link = new Conexion($_config['bd']['server'],$_config['bd']['user'],$_config['bd']['password'],$_config['bd']['name'])){
                        $sql = "SHOW TABLES FROM ".$_config['bd']['name'];
                        $query = new Consulta($sql);         
                  ?>
            <div class="load_process">CARGANDO...</div>
                <div id="contenedor_recarga">
                    <br>
                    <form method="post" action="" id="formulario_generar_tablas" name="formulario_generar_tablas">
                        <div class="errores_muestra">
                            <b>Falta:</b><br>
                            <span id="most_error"></span>
                        </div>
                        <p>
                            <label>Nombre Tabla :</label><input type="text" name="nombre_tabla" class="text_unic" id="nombre_tabla">&nbsp;
                            <span class="info_btn info1"><img class="img_span" src="../aplication/webroot/imgs/info2.png"></span>
                            <span class="tip inf1">
                                <span class="bg_flecha"></span>
                                
                                * Ingresa el nombre de la tabla en Plural.<br>
                                * Usa "_" para separar las palabras.
                            </span>
                            
                        </p>
                            
                        <p><label>Prefijo Campo :</label><input type="text" onkeyup="CopyPrefiijo()" class="text_unic" name="prefijo_campo" id="prefijo_campo">&nbsp;
                            <!--<span class="comentario"> Ejemplo : id_< PREFIJO > </span>-->
                            <span class="info_btn info2"><img class="img_span" src="../aplication/webroot/imgs/info2.png"></span>
                            <span class="tip inf2">
                                <span class="bg_flecha"></span>
                                * <span class="comentario"> Ejemplo : id_< PREFIJO > </span>
                            </span>
                            
                        </p>
                        <p><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Campos : </label>&nbsp;</p>
                        <p> </p>
                        <div class="cabecera_tabla_campos">
                            <div class="colum camp_nomb">Nombre Campo</div>
                            <div class="colum">Tipo de Dato</div>
                            <div class="colum camp_tam">Tama&ntilde;o</div>
                            <div class="colum coment">Comentario</div>
                            <div class="vacio">&nbsp;</div>
                        </div> 
                        <div class="items-colums">
                            <div class="items camp_nomb">id_<span class="prefijo_fin"></span></div>
                            <div class="items">int</div>
                            <div class="items camp_tam">11</div>
                            <div class="items coment">codigo unico de cada dato</div>
                            <div class="vacio">&nbsp;<img src="../aplication/webroot/imgs/key.png" height="24" title="Primary Key" style="cursor: pointer">&nbsp; <span class="not_null" title="NOT NULL">NOT NULL</span></div>
                        </div>
                        <!--<div class="items-colums">
                            <div class="items camp_nomb"><input type="text" class="text_nomb">_<span class="prefijo_fin"></span></div>
                            <div class="items">
                            <input type="text" class="text_tab" id="txt_tipo_dato" name="txt_tipo_dato"
                                <select id="combobox" name="combobox">
                                  <option value="">Select one...</option>
                                  <option value="bigint">bigint</option>
                                  <option value="binary">binary</option>
                                  <option value="bit">bit</option>
                                  <option value="blob">blob</option>
                                  <option value="bool">bool</option>
                                  <option value="boolean">boolean</option>
                                  <option value="char">char</option>
                                  <option value="date">date</option>
                                  <option value="datetime">datetime</option>
                                  <option value="decimal">decimal</option>
                                  <option value="double">double</option>
                                  <option value="enum">enum</option>
                                  <option value="float">float</option>
                                  <option value="int">int</option>
                                  <option value="longblob">longblob</option>
                                  <option value="longtext">longtext</option>
                                  <option value="mediumblob">mediumblob</option>
                                  <option value="mediumblob">mediumint</option>
                                  <option value="mediumtext">mediumtext</option>
                                  <option value="numeric">numeric</option>
                                  <option value="real">real</option>
                                  <option value="set">set</option>     
                                  <option value="smallint">smallint</option>
                                  <option value="text">text</option>
                                  <option value="time">time</option>
                                  <option value="timestamp">timestamp</option>
                                  <option value="tinyblob">tinyblob</option>
                                  <option value="tinytext">tinytext</option>
                                  <option value="varbinary">varbinary</option>
                                  <option value="varchar">varchar</option>
                                  <option value="year">year</option>    
                                </select>
                                  
                            </div>
                            <div class="items camp_tam"><input type="text" class="text_tab"></div>
                            <div class="items coment"><input type="text" class="text_tab"></div>
                            <div class="vacio"><span class="not_null campo_null">NOT NULL</span></div>
                        </div>-->
                        <div id="campos">
                        </div>
                        
                        <input type="hidden" id="val_itemcampo" name="val_itemcampo" value="0">
                        
                        <div class="items-colums" style="height: 43px;background: rgba(255, 255, 255, 0.64);">
                            <div class="btn_agregar"><a href="javascript:"  onclick="AgregarCampos();" title="Nuevo Campo"><img src="../aplication/webroot/imgs/agregar.png" width="25"><span>Agregar Campo</span></a></div>
                        </div>
                        
                        <div id="posit_boton"><button id="btn_generar_tabla" class="btn-primary" style="margin-top: 40px" type="button">Generar</button></div>
                        
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
