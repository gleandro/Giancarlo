<?php 
class Cuenta extends Main{
	
	private $_cliente, $_errores = 0;
	
	public function __construct(&$cliente){
		$this->_cliente = $cliente;
	}
	
	//Function Cerrar sesion
	public function logoutUsuario(){
		$this->_cliente->setLogeado(FALSE);
		$this->setData(0);
		unset($_SESSION['suit']);
	}
	// Function Asignar Cliente a Cuenta
	public function setCliente($cliente){
		$this->_cliente = $cliente;
	}
	
	// Function Recuperar Cliente
	public function getCliente(){
		return $this->_cliente;
	}
	
	// Function Opciones de Mantenimiento del Cliente.
	public function mantenimiento(){ ?>
		
        <div id="mantenimiento">
        	
            <div class="cuneta_left">
                 <div class="parrafoto_cuenta">
                    <h2><img src="aplication/webroot/imgs/mon.jpg" alt="Mon Compte" /></h2>
                    <ul>
                        <li><a href="cuenta.php?cuenta=edit">Coordonnées personnelles </a> </li>
                        <li><a href="direcciones.php">Mon carnet d'adresses </a> </li>
                        <li><a href="cuenta.php?cuenta=psw_edit">Mon mot de passe</a></li>
                        <li><a href="historial-pedidos.php">Mes Commandes</a></li>
                   </ul>
                  <p><a href="cuenta.php?cuenta=logout">Déconnexion </a></p></div>
            </div>
            <div class="cuneta_rigtht">
            	<?php if($this->printNotificacion() != ""){ echo  $this->printNotificacion(); } ?>
                <h1>Bienvenue <?php echo $this->_cliente->__get("_nombre") ?></h1>
                <p style=" margin:20px 0 20px 0">Votre compte client </p>
                <h1>Coordonnées personnelles </h1>
                <div class="cuenta_iconos_login">
                    <a href="cuenta.php?cuenta=edit"><img src="aplication/webroot/imgs/ico_usuario.jpg" alt="usuario" />
                    	<span>Mes Coordonnées Personnelles</span>
                    </a>
                   
                </div>
                <div class="cuenta_iconos_login">
                    <a href="direcciones.php"><img src="aplication/webroot/imgs/ico_mon_andres.jpg" alt="usuario" />
                   		 <span>Mon carnet d'adresses  </span>
                    </a>
                    
                </div>
                <div class="cuenta_iconos_login">
                    <a href="cuenta.php?cuenta=psw_edit"><img src="aplication/webroot/imgs/ico_mon_mot.jpg" alt="usuario" />
                    	<span>Mon mot de passe </span>
                    </a>
                   
                </div>
                <div class="clear"></div>
                <div class="cuenta_iconos_login2">
                    <h1>Mes Commandes</h1><br />
                    	<a href="historial-pedidos.php"><img src="aplication/webroot/imgs/icono_mes_commandas.jpg" alt="usuario" />
                        	 <span>Mes Commandes</span>
                        </a>
                   
                </div>
            </div>
        </div>
        
			<?php
	}
	
	// Function Asignar Datos al Cliente Logueado
	public function setData($id){
			$clientes = new Clientes();			
			$array_cliente = $clientes -> getClientePorId($id);
			$this->_cliente->__set('_id',$array_cliente[0]['id']);
			$this->_cliente->__set('_usuario',$array_cliente[0]['usuario']);
			$this->_cliente->__set('_nombre',$array_cliente[0]['nombre']);
			$this->_cliente->__set('_apellidos',$array_cliente[0]['apellidos']);
			$this->_cliente->__set('_telefono',$array_cliente[0]['telefono']);
			$this->_cliente->__set('_email',$array_cliente[0]['email']);
			$this->_cliente->__set('_movil',$array_cliente[0]['movil']);
			$this->_cliente->__set('_sexo',$array_cliente[0]['sexo']);
			$this->_cliente->__set('_boletin',$array_cliente[0]['boletin']);
			$this->_cliente->__set('_direccion',$array_cliente[0]['direccion']);
			$this->_cliente->__set('_direccion_facturacion',$array_cliente[0]['direccion_facturacion']);
			$this->_cliente->__set('_direccion_envio',$array_cliente[0]['direccion_envio']);
	}
	
	// Function Ventana de Login
	public function acceso(){ ?>
		<div id="mi_cuenta">
        	<div class="bg_gris">
            	<h2>Se Connecter</h2>
                <div class="cuentRight">
						<?php 
							if($this->printNotificacion() != ""){ echo  $this->printNotificacion();}
						?>
                	<div><img src="aplication/webroot/imgs/l_top.jpg" /></div>
                    <div class="lbg">
                    	<h3>DÉJÀ CLIENT</h3>
						
                        <div>
                        <form name="frmlogin" id="frmlogin" action="cuenta.php?cuenta=acceso&" method="post">
                            <div class="row"><label>Adresse email:</label><input type="text" name="email" title="Entrez votre Email" value="<?php echo $_COOKIE['email_MKD']?>" class="required email txtlog" autocomplete='off'></div>
                            <div class="row"><label>Mot de Passe: </label> <input type="password" name="password"  value="<?php echo $_COOKIE['pass_MKD']?>"  class="required txtlog" title="Entrez votre mot de passe" ></div><br clear="all" />
                            <div class="btn-logear float"><input type="image" src="aplication/webroot/imgs/btn_conect.jpg" alt="clic" /></div>
                        	<div class="float" style="padding:2px 0 0 10px"><a href="cuenta.php?cuenta=rp-cont">Mot de passe perdu ?</a></div>
                         </form>
                        </div>
                    </div>
                    <div><img src="aplication/webroot/imgs/l_bottom.jpg" /></div>
                </div>
                <div class="cuentaLeft">
                    <h3>Nouveau client</h3>
                    <p>En créant un compte chez Nathan´s Suit, vous aurez la possibilité de faire vos achats plus rapidement et de suivre vos commandes. </p>
                    <div  class="btn-regiter" align="center"><a href="cuenta.php?cuenta=registrarse">Créer votre compte &gt; </a></div>	
                	
                </div>
            </div>
		</div>

		<?php	
		
	}
	
	// Function Verificar datos del Logueo  
	public function cuentaAcceso(){
	
		$sql = "SELECT *, CONCAT(nombre_cliente,' ',apellidos_cliente) AS Cliente
				FROM clientes 
					WHERE email_cliente=".comillas_inteligentes($_POST['email'])." AND 
						  password_cliente=".comillas_inteligentes(encriptar($_POST['password']))." ";
	
		$query = new Consulta($sql);
		if($query->NumeroRegistros() > 0){
			
			$row = $query->VerRegistro();
			$this->setData($row['id_cliente']);
			$this->_cliente->setLogeado(TRUE);
			$this->_cliente->sumaIngreso();	
			$this->setNotificacion("");
			
		}else{
			$this->setNotificacion("Note: L'e-mail et / ou mot de passe ne figurent pas dans nos données. ", 1);
		}
	}
	
	// Function Registro del Cliente
	public function registrarse(){
		$objp = new Paises();
		$array_paises = $objp->getPaises();
		$total_paises = count($array_paises);
		 
		?> 
		
		<div id="registro">
			<div>
            	<h2>Nouveau Client</h2>
                <p class="tex_contrasena">EVeuillez remplir le formulaire ci-dessous pour ouvrir un compte sur Nathan´s Suit</p>
                
                <div id="formulario_register">
				<?php 
					if($this->printNotificacion() != ""){ echo  $this->printNotificacion(); }
		 		?>
                
                   <form name="frmregistro" action="cuenta.php?cuenta=add" id="frmregistro" method="post">			
                        <div class="form_left">
                            <div><label class="label_registro">Nom :</label> <input type="text" class="input-reg1 required" name="nombre" title="Veuillez indiquer un nom " value="<?php echo $_SESSION['register'][0]?>" /> </div>
                            <div><label class="label_registro">Prénom :</label> <input type="text" name="apellidos" value="<?php echo $_SESSION['register'][1]?>" class="input-reg1 required" title="Veuillez indiquer un prénom"   /></div>
                            <div><label class="label_registro">E-mail :</label><input type="text"  name="email" value="<?php echo $_SESSION['register'][2]?>"  class="input-reg1 required email" /></div>
                             <label class="label_registro">Sexe :</label>
                            <div class="genero" style="margin-bottom:5px">
                            	<?php $sexo = $_SESSION['register'][3]?>
                                <input type="radio" value="M" <?php if($sexo=="M"){ echo "checked";}?> title="*" name="sexo" class="radio_float required"> <span>Male</span>
                                <input type="radio" value="F" <?php if($sexo=="F"){ echo "checked";}?> name="sexo" class="radio_float required"> <span>Female</span>  
                            </div>
                            <div class="clear"><label class="label_registro">Mot de passe:</label> <input  type="password" name="password" id="password"  class="input-reg1" autocomplete='off' /></div>
                            <div><label class="label_registro">Confirmation :</label><input type="password" name="password_confirma"  class="input-reg1" /></div>
                        </div>
                        <div class="form_right">
                            <div><label class="label_registro">Adresse :</label> <input type="text" name="direccion" title="Veuillez indiquer une adresse"  class="input-reg1 required"  value="<?php echo $_SESSION['register'][5]?>" /> </div>
                            <div><label class="label_registro">Ville :</label> <input type="text"  name="ciudad" title="Veuillez indiquer une ville" value="<?php echo $_SESSION['register'][10]?>" class="input-reg1 required" /></div>
                            <label class="label_registro">Pays :</label>
                            <select name="pais" id="pais"   class="input-reg-select required" title="Choisir un pays">					
								<option value="">- Sélectionnez</option>
								<?php
                                $pais = $_SESSION['register'][8];
                                for($i=0; $i < $total_paises ;$i++){?>
                               	 	<option value="<?php echo $array_paises[$i]['id']?>"<?php if($array_paises[$i]['id']==$pais){ echo 'selected="selected"';} ?>><?php echo $array_paises[$i]['nombre']?></option><?php							
                                }?>
                            </select>
                            <div><label class="label_registro">Code postal :</label> <input type="text" name="cp" title="Veuillez indiquer un code postal"  class="input-reg1 required"  value="<?php echo $_SESSION['register'][7]?>" /> </div>
                            <label class="label_registro">Téléphone fixe :</label> <input type="text"  name="telefono" value="<?php echo $_SESSION['register'][11]?>"   class="input-reg1 required" title="Veuillez indiquer un téléphone"  />
                            <label class="label_registro">Téléphone portable : </label> <input type="text"  name="telefono_movil" value="<?php echo $_SESSION['register'][12]?>"   class="input-reg1"  />
                            <label class="label_registro">Newsletter :</label>
                             <div class="genero">
                            	<?php $bol = $_SESSION['register'][17]?>
                                <input type="radio" value="S" <?php if($bol=="S"){ echo "checked";}?>  name="boletin" checked="checked" class="radio_float"> <span>Si</span>
                                <input type="radio" value="N" <?php if($bol=="N"){ echo "checked";}?> name="boletin" class="radio_float"> <span>Pas</span>  
                            </div>
                        </div>
                        <div class=" clear"></div>
                        <input type="image" src="aplication/webroot/imgs/btn_register.jpg" class="btn_register" alt="register" />
                  </form>
              </div>
            </div>
		</div>
		
	<?php
	$this->setNotificacion("");
	if(isset($_SESSION['register'])){ unset($_SESSION['register']);}
	}
	
	// Function Regitrar Cliente
	public function cuentaAdd(){
		if(!isset($_POST['email'])){ return false; }
		$sql_ver = "SELECT * FROM clientes WHERE email_cliente='".$_POST['email']."'";
		$query_ver = new Consulta($sql_ver);
		$err = 0;
		$clave = encriptar($_POST['password']);
		
		if($query_ver->NumeroRegistros() == 0){
			if($_POST['boletin'] == "S"){
				$b = "S";
			}else{
				$b = "N";
			}
			$sql   = "INSERT INTO clientes VALUES('','".$_POST['nombre']."','".$_POST['apellidos']."','".$_POST['sexo']."','".$_POST['email']."','','','','".$_POST['telefono_movil']."','".$_POST['telefono']."','".$clave."','".$b."','N','')";
			$query = new Consulta($sql);
			$id	   = @mysql_insert_id();
					    	
			$sql_dir="INSERT INTO clientes_direcciones VALUES('','".$id."','".$_POST['pais']."','".$_POST['id_prov']."','".$_POST['nombre']."',
															  '".$_POST['apellidos']."','".$_POST['empresa']."','".$_POST['direccion']."',
															  '".$_POST['cif']."', '".$_POST['nif']."','".$_POST['cp']."',
															  '".$_POST['ciudad']."','".$_POST['provincia']."','".$_POST['telefono']."') ";
			$query_dir=new Consulta($sql_dir); 
			$id_dir=@mysql_insert_id();
			
			$sql_info="INSERT INTO clientes_informacion VALUES('".$id."','".date('Y-m-d H:i:s')."','1','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','0')";
			$query_info=new Consulta($sql_info);
			
			$sql_update="UPDATE clientes SET id_cliente_direccion     = '".$id_dir."',
											 id_direccion_envio       = '".$id_dir."',
											 id_direccion_facturacion = '".$id_dir."' WHERE id_cliente='".$id."'";
			$query_update=new Consulta($sql_update);
			
			$queryM = new Consulta("SELECT * FROM mailings WHERE email_mailings='".$_POST['email']."'");
			if($queryM->NumeroRegistros() == 0){
				$queryMM = new Consulta("INSERT INTO mailings VALUES('','".$_POST['email']."')");
			}
			
			
			$this->setData($id);
			$this->_cliente->setLogeado(TRUE);
			
			$subject = "Registro en ";
			$msg = "			
				
				BIENVENIDO A ICQUS.
				
				Estimado(a) ".$_POST['nombre']." ".$_POST['apellidos']." su cuenta a sido creada:
				
				Tu Cuenta
				--------------------------------------
				Usuario: ".$_POST['email']." 
				Contraseña: ".$_POST['password']."
				
				Con estos datos de acceso podras ingresar a los servicios   Ofertas, Boletines de Icqus.
				
				
				Atte
				Icqus
				
				http://www.icqus.com		
				
				";	
				@mail($_POST['email'],$subject,$msg,"from: Web site Icqus");	
				
				$this->notificacion="";
			if(isset($_SESSION['register'])){ unset($_SESSION['register']);}
			header("location: cuenta.php?cuenta=bienvenida");
		}else{
			
			
				/********** DATOS DE USUARIO ***********/
				$_SESSION['register'][0]=$_POST['nombre'];
				$_SESSION['register'][1]=$_POST['apellidos'];
				$_SESSION['register'][2]=$_POST['email'];
				$_SESSION['register'][3]=$_POST['sexo'];
				$_SESSION['register'][4]=$_POST['empresa'];
				
				
				/************** ADDRESS ****************/
				$_SESSION['register'][5]=$_POST['direccion'];
				$_SESSION['register'][6]=$_POST['nif'];	
				$_SESSION['register'][7]=$_POST['cp'];
				$_SESSION['register'][8]=$_POST['pais'];	
				$_SESSION['register'][9]=$_POST['provincia'];
				$_SESSION['register'][10]=$_POST['ciudad'];
				
				/****************CONTACTO*****************/
				$_SESSION['register'][11]=$_POST['telefono'];
				$_SESSION['register'][12]=$_POST['telefono_movil'];
				$_SESSION['register'][13]=$_POST['boletin'];
				$_SESSION['register'][14] = $tip;
				$_SESSION['register'][15] = $_POST['cif'];
				$_SESSION['register'][16] = $_POST['id_prov'];
				$_SESSION['register'][17] = $_POST['boletin'];
				
			
				$this->setNotificacion("Su dirección de e-mail ya figura entre nuestros clientes, si desea entre a su cuenta con esta dirección o cree una cuenta nueva con una dirección diferente.", 1);	
							
			
			header("location: cuenta.php?cuenta=registrarse");
		}		
	}
	
	// Function Mensaje de Bienvenida Al cliente
	public function bienvenida(){ ?>
		<div id="confirmacion_registro">
			<div class="welcome">
            	<h2>Votre compte a été créé!</h2>
				<p style="line-height:1.5em"><img src="aplication/webroot/imgs/welcome.jpg" align="left"><b>Félicitations!</b> Votre compte a été créé avec succès! Vous pouvez maintenant profiter des avantages d'avoir un compte pour améliorer votre expérience avec nous. Si vous avez <b> TOUT </b> des questions sur le fonctionnement du catalogue, s'il vous plaît envoyer un courriel au gestionnaire.

Il a envoyé un courriel de confirmation à l'adresse que vous avez fourni. Si ce n'est pas reçue dans 1 heure, s'il vous plaît contactez-nous.</p>
			
				<div  class="btn-regiter" align="center"><a href="cuenta.php">Continuar &gt; </a></div>
			</div>
		</div>
		
		<?php
	}
	
	// Function Editar Cliente
	public function cuentaEdit(){
		?> 
        
        <div id="content_mantenimiento">
            <div class="cuneta_left">
                 <div class="parrafoto_cuenta">
                    <h2><img src="aplication/webroot/imgs/mon.jpg" alt="Mon Compte" /></h2>
                    <ul>
                        <li><a href="cuenta.php?cuenta=edit" class="act">Coordonnées personnelles </a> </li>
                        <li><a href="direcciones.php">Mon carnet d'adresses </a> </li>
                        <li><a href="cuenta.php?cuenta=psw_edit">Mon mot de passe</a></li>
                        <li><a href="historial-pedidos.php">Mes Commandes</a></li>
                   </ul>
                  <p><a href="cuenta.php?cuenta=logout">Déconnexion </a></p></div>
            </div>
            <div id="edit_cuenta">
			<div>
            	<h2>Modification de coordonnées</h2>
                <div class="forms" style="margin:30px 0">
				<?php 
					if($this->printNotificacion() != ""){ echo  $this->printNotificacion(); }
		 		?>
                
                  <form name="frmeditar" action="cuenta.php?cuenta=update" id="frmeditar" method="post">	
                        <div class="form_left">
                            <div><label class="label_registro">Nom :</label> <input type="text" value="<?php echo $this->_cliente->__get("_nombre")?>" class="input-reg1 required" name="nombre" title="Entrez votre nom" /> </div>
                            <div><label class="label_registro">Prénom :</label> <input type="text" name="apellidos" value="<?php echo $this->_cliente->__get("_apellidos")?>" class="input-reg1 required" title="Entrez votre prénom"   /></div>
                            <div><label class="label_registro">E-mail :</label><input type="text"  name="email" value="<?php echo $this->_cliente->__get("_email")?>"  class="input-reg1 required email" /></div>
                        </div>
                        <div class="form_right">
                            <label class="label_registro">Téléphone fixe :</label> <input type="text"  name="telefono" value="<?php echo $this->_cliente->__get("_telefono")?>"   class="input-reg1 required"  />
                            <label class="label_registro">Téléphone portable :</label> <input type="text"  name="telefono_movil" value="<?php echo $this->_cliente->__get("_movil")?>"   class="input-reg1"  />
                            <label class="label_registro">Sexe :</label>
                            <div class="genero">
                            	<?php $sexo = $this->_cliente->__get("_sexo")?>
                                <input type="radio" value="M" <?php if($sexo=="M"){ echo "checked";}?> title="*" name="sexo" class="radio_float required"> <span>Male</span>
                                <input type="radio" value="F" <?php if($sexo=="F"){ echo "checked";}?> name="sexo" class="radio_float required"> <span>Female</span>  
                            </div>
                            <label class="label_registro">Recevoir la newsletter :</label>
                             <div class="genero">
                            	<?php $bol =  $this->_cliente->__get("_boletin")?>
                                <input type="radio" value="S" <?php if($bol=="S"){ echo "checked";}?>  name="boletin" class="radio_float"> <span>Si</span>
                                <input type="radio" value="N" <?php if($bol=="N"){ echo "checked";}?> name="boletin" class="radio_float"> <span>Pas</span>  
                            </div>
                        </div>
                        <div class=" clear"></div>
                        <div align="center" class="btns_editar"><a href="cuenta.php">Retour</a> &nbsp;&nbsp; <input type="image" src="aplication/webroot/imgs/btn_modificar.jpg" alt="register" /></div>
                  </form>
              </div>
              
            </div>
		</div>
        </div>

		<?php
	}	
	
	// Function Actualizar datos del Usuario
	public function cuentaUpdate(){
		
			$sql="UPDATE clientes SET 
					nombre_cliente='".$_POST['nombre']."',
					apellidos_cliente='".$_POST['apellidos']."',
					email_cliente='".$_POST['email']."',
					telefono_cliente='".$_POST['telefono']."',
					movil_cliente='".$_POST['telefono_movil']."',
					sexo_cliente='".$_POST['sexo']."',
					boletin_cliente='".$_POST['boletin']."'
			WHERE id_cliente='".$this->_cliente->__get("_id")."' ";
			
			$query=new Consulta($sql);
			
			$sql_info="UPDATE clientes_informacion 
							SET fecha_ultima_modificacion='".date('Y-m-d')."'
							WHERE id_cliente='".$this->_cliente->__get("_id")."' ";
			$query_info=new Consulta($sql_info);
			$this->_cliente = new Cliente($this->_cliente->__get("_id"));
			$this->_cliente->setLogeado(TRUE);
			$this->setNotificacion("Su cuenta se actualizado correctamente ", 2);	
	}
	
	// Function Editar Clave del Cliente
	public function passwordEdit(){ 
		?>
         <div id="content_mantenimiento">
            <div class="cuneta_left">
                 <div class="parrafoto_cuenta">
                    <h2><img src="aplication/webroot/imgs/mon.jpg" alt="Mon Compte" /></h2>
                    <ul>
                        <li><a href="cuenta.php?cuenta=edit">Coordonnées personnelles </a> </li>
                        <li><a href="direcciones.php">Mon carnet d'adresses </a> </li>
                        <li><a href="cuenta.php?cuenta=psw_edit" class="act">Mon mot de passe</a></li>
                        <li><a href="historial-pedidos.php">Mes Commandes</a></li>
                   </ul>
                  <p><a href="cuenta.php?cuenta=logout">Déconnexion </a></p></div>
            </div>
               <div id="edit_pwd">
                <div>
                    <h2>Mon mot de passe</h2>
                    <div class="content-edit-pdw">
                    <form name="frmr_edit_pwd" action="cuenta.php?cuenta=psw_update" id="frmr_edit_pwd" method="post">
                    
                        <div class="row">
                            <label>Nouveau mot de passe  :</label>
                            <input type="password" name="password" id="password" class="text_r" title="" autocomplete='off' >
                        </div>
                        <div class="row">
                            <label>Confirmer  :</label>
                            <input type="password"  name="password_confirma" id="password_confirma" title="" class="text_r"/>
                        </div>
                        <div class="clear"></div>	
                        <div align="center" class="btns_editar"><a href="cuenta.php">Retour</a>&nbsp;&nbsp;<input type="image" src="aplication/webroot/imgs/btn_modificar.jpg" alt="register" /></div>
                                                
                    
                		</form>
                	</div>
                </div>
            </div> 
         </div>   
           
		
		<?php
	}

	// Function Actualizar Nueva Clave
	public function passwordUpdate(){		 
		
		$sql = "UPDATE clientes SET 
					password_cliente='".encriptar($_POST['password'])."'						
				WHERE id_cliente='".$this->_cliente->__get("_id")."'";
				
		$query = new Consulta($sql);
		
		$sql_info = "UPDATE clientes_informacion 
						SET fecha_ultima_modificacion='".date('Y-m-d')."'
						WHERE id_cliente='".$this->_cliente->__get("_id")."' ";
		$query_info = new Consulta($sql_info);			
		
		$this->setNotificacion("&nbsp; Se actualizó su contraseña satisfactoriamente. ",2);					
	}
	
	// Function recuperar contraseña
	public function recuperarContrasenia(){ ?>

        <div id="rcontrasena">
        	<div class="bg_gris">
            	<h2>Mot de passe oublié</h2>
               <div class="formrc">
               	 	<p class="note">S'il vous plaît laissez-nous votre e-mail et nous allons bientôt envoyer vos informations de connexion. </p> 
                    <form name="frmrecuperar" id="frmrecuperar" action="cuenta.php?cuenta=mandarC" method="post">
                        <div class="row">
                        	<label>E-mail:</label>
                       		<input type="text" name="email"  size="46" class="text_r required email" title="">
                        	<input type="image"  src="aplication/webroot/imgs/btn_enviar.jpg"  class="btn"/>
                         </div>
                        	<br clear="all" />
                    </form>	
               </div>
            </div>
		</div>

		<?php
	}
	
	// Function Enviar Conreaseña	
	public function enviarContrasenia(){
	
		$sql = "SELECT * FROM clientes WHERE email_cliente='".$_POST['email']."'";
		$query=new Consulta($sql);
		if($query->NumeroRegistros()==1){
			$row=$query->VerRegistro();
			$email=$row['email_cliente'];
			$subject="Datos de Cuenta - Nathan's Suit";
			$msg="
Estimado(a) ".$row['nombre_cliente']." ".$row['apellidos_cliente'].". 
A continuación le recordamos los datos de acceso a icqus:

Email: ".$row['email_cliente']." 
Contraseña: ".desencriptar($row['password_cliente'])."			


Atte
Nathan's Suit

www.web.com	
			
";	
			@mail($email,$subject,$msg,"from: soporte@icqus.com");	
			$this->setNotificacion("Leurs données ont été envoyées avec succès accéder à leurs e-mail.", 2);			
		}else{				
			$this->setNotificacion("Désolé, aucun client n'avait été trouvé avec l'e-mail", 1);
		}			
	}	
}
?>