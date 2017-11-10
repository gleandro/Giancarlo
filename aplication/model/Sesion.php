<?php
// Proyecto: Sistema Develoweb
// Version: 4.0
// Programador: Bryan Arias
// Framework: Develoweb Version: 4.0
// Clase: Proyectos

/** relaciones */
require_once _model_.'Rol.php';
require_once _model_.'Usuario.php';

class Sesion
{

    private $_usuario;
    private $_token;
	private $_idioma;

    public function __construct()
    {
        session_start();
		if(!$_SESSION['usuario'] || empty($_SESSION['usuario'])){
			$_SESSION['usuario'] = new Usuario();
		}

		$this->_usuario = $_SESSION['usuario'] ;
    }

	public function validaAcceso($usuario, $password){

		//$usuario  = trim( str_replace( "'","",str_replace("#","",$usuario) ) );
		//$password = trim( str_replace( "'","",str_replace("#","",$password) ) );

		//$usuario  = mysqli_real_escape_string(Conexion::getInstance(),strip_tags($usuario));
		//$password = md5(mysqli_real_escape_string(Conexion::getInstance(),strip_tags($password)));

	  $sql = " SELECT * FROM usuarios WHERE login_usuario='".$usuario."' AND password_usuario='".encriptar($password)."' ";
    // $sql = " SELECT * FROM usuarios WHERE login_usuario='".$usuario."' AND password_usuario='".$password."' ";

		$query = new Consulta($sql);

		if($query->NumeroRegistros() > 0){

			$row= $query->VerRegistro();
			$this->_usuario = new Usuario($row['id_usuario']);
			$_SESSION['usuario'] = $this->_usuario;
			$this->_usuario->setLogeado(TRUE);

		}else{
			$this->errores += 1;
			return false;
		}
		return true;

	}

	function enviarContrasena(){
		$query = new Consulta("SELECT * FROM usuarios WHERE email_usuario = '".$_POST['login']."'");
		if($query->NumeroRegistros() == 1){
			$row=$query->VerRegistro();

						$email 	 = $row['email_usuario'];
$subject = "Datos de Cuenta - Industria Medina";
$msg="
Estimado(a) ".$row['nombre_usuario']." ".$row['apellidos_usuario'].".
A continuación le recordamos los datos de acceso a Industria Medina:

Usuario: ".$row['login_usuario']."
Contraseña: ".$row['password_usuario']."


Atte
Industria Medina

http://www.industriamedina.com";


			@mail($email,$subject,$msg,"From: soporte@joyeria.com");
			return true;

		}else{
			return false;
		}
	}

	public function isLoged(){
		if(is_object($this->_usuario)){
			return true;
		}else{
			return false;
		}
	}

	public function conFiltro(){

		if($this->_usuario->getRol()->getNombre() == "Administrador" || $this->_usuario->getRol()->getNombre() == "Jefe de Proyectos"){
			return false;
		}else{
			return true;
		}
	}

	public function logout(){

		unset($_SESSION['usuario']);
		//session_destroy();

		$this->_usuario = new Usuario();
		$this->_usuario->setLogin("Visitante");
		$this->_usuario->setLogeado(FALSE);
		$_SESSION['usuario'] = $usuario;
		header("Location: login.php");
	}

		function acceso(){ ?>
		<form name="login" action="index.php" method="post">
			<table align="center" width="300" id="inicio" cellpadding="1" cellspacing="1">
				<tr>
					<td colspan="2" class="title"> ACCESO AL AREA DE ADMINISTRACI&Oacute;N</td>
				</tr>
				<tr>
					<td colspan="2" ><BR></td>
				</tr>
				<tr>
					<td width="40%" align="right">Usuario : </td>
					<td class="total"><input type="text" name="login" class="text"></td>
				</tr>
				<tr>
					<td align="right">Password : </td>
					<td class="total"><input type="password" name="password" class="text"></td>
				</tr>
				<tr>
					<td align="right"><BR><input type="reset" name="limpiar" value="LIMPIAR" class="button"></td>
					<td align="center"><BR><input type="submit" name="enviar" value="ACEPTAR" class="button"></td>
				</tr>
				<tr>
					<td colspan="2" ><BR></td>
				</tr>
			</table>
		</form>

	<?php
	}

	function inicio($msgbox){
		$usuarios   = new Usuarios();
		//$categorias = new Categorias($this->_idioma, $msgbox);
		//$productos	= new Productos($this->_idioma, $msgbox, $this->_usuario);

		?>
		<h1>Bienvenido a <?php echo NOMBRE_SITIO; ?></h1>
        <ul id="welcome">
       <?php if($this->_usuario->getRol()->getNombre() == "Administrador"){?>
            <li><a href="banners.php"><img src="<?php echo _admin_ ?>icon-banner.jpg" /><span>Banners</span></a></li>

            <li><a href="clientes.php"><img src="<?php echo _admin_ ?>icon-clientes.jpg" /><span>clientes</span></a></li>

            <li><a href="configuracion.php"><img src="<?php echo _admin_ ?>icon-config.jpg" /><span>Configuracion de Sitio</span></a></li>
         <?php } ?>
        </ul>
		<?php

	}




    public function getUsuario()
    {
        return $this->_usuario;
    }

    public function getToken()
    {
        return $this->_token;
    }

    private function _generarToken($text)
    {
        return md5(rand().$text);
    }

    public static function getStatus()
    {
        $session = new Session();

        if(!empty($_SESSION['usuario']) && !empty($_SESSION['token'])) {

            $token = $this->_persistencia->getToken($_SESSION['usuario']);

            if($_SESSION['token'] == $token){
                $this->_usuario = new Usuario($_SESSION['usuario']);
                $this->_token   = $this->_generarToken($usuario);
                //$_persistencia->update($this);
            }else {
                exit;
            }
        }
    }

}
?>
