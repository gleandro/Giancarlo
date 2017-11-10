<?php include("inc.aplication_top.php");
if($_GET['action'] == 'acceso'){
	if($sesion->enviarContrasena()){
		header("Location:login.php?msg=success");
	}else{
		header("Location:login.php?action=recuperar_c&msg=error");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="../aplication/webroot/img/apple-icon.png">
<link rel="icon" type="image/png" sizes="96x96" href="../aplication/webroot/imgs/favicon.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />



<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" />


 <!-- Bootstrap core CSS     -->
<link href="../aplication/webroot/css/bootstrap.min.css" rel="stylesheet" />

<!--  Paper Dashboard core CSS    -->
<link href="../aplication/webroot/css/paper-dashboard.css" rel="stylesheet"/>


<!--  CSS for Demo Purpose, don't include it in your project     -->
<link href="../aplication/webroot/css/demo.css" rel="stylesheet" />


<!--  Fonts and icons     -->
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
<link href="../aplication/webroot/css/themify-icons.css" rel="stylesheet">


<title>ADMINISTRACION <?php echo NOMBRE_SITIO; ?></title>

<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
<script src="../aplication/webroot/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="../aplication/webroot/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="../aplication/webroot/js/perfect-scrollbar.min.js" type="text/javascript"></script>
<script src="../aplication/webroot/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Forms Validations Plugin -->
<script src="../aplication/webroot/js/jquery.validate.min.js"></script>

<!-- Promise Library for SweetAlert2 working on IE -->
<script src="../aplication/webroot/js/es6-promise-auto.min.js"></script>

<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="../aplication/webroot/js/moment.min.js"></script>

<!--  Date Time Picker Plugin is included in this js file -->
<script src="../aplication/webroot/js/bootstrap-datetimepicker.js"></script>

<!--  Select Picker Plugin -->
<script src="../aplication/webroot/js/bootstrap-selectpicker.js"></script>

<!--  Switch and Tags Input Plugins -->
<script src="../aplication/webroot/js/bootstrap-switch-tags.js"></script>

<!-- Circle Percentage-chart -->
<script src="../aplication/webroot/js/jquery.easypiechart.min.js"></script>

<!--  Charts Plugin -->
<script src="../aplication/webroot/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="../aplication/webroot/js/bootstrap-notify.js"></script>

<!-- Sweet Alert 2 plugin -->
<script src="../aplication/webroot/js/sweetalert2.js"></script>

<!-- Vector Map plugin -->
<script src="../aplication/webroot/js/jquery-jvectormap.js"></script>

<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Wizard Plugin    -->
<script src="../aplication/webroot/js/jquery.bootstrap.wizard.min.js"></script>

<!--  Bootstrap Table Plugin    -->
<script src="../aplication/webroot/js/bootstrap-table.js"></script>

<!--  Plugin for DataTables.net  -->
<script src="../aplication/webroot/js/jquery.datatables.js"></script>

<!--  Full Calendar Plugin    -->
<script src="../aplication/webroot/js/fullcalendar.min.js"></script>

<!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
<script src="../aplication/webroot/js/paper-dashboard.js"></script>

<!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
<script src="../aplication/webroot/js/demo.js"></script>

<script type="text/javascript">
    $().ready(function(){
        demo.checkFullPageBackgroundImage();

        setTimeout(function(){
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>


</head>
<!--<body id="login">
	<div id="sitewrapper">
        <div id="content" >
            <div id="main">
			<?php
                if($_GET['action'] == 'recuperar_c'){
                    ?>
                  <div id="forgot-password-flash" class="flash bad" style="display:none;">
                    <div class="inner">
                        <h3>Did you forget your password?</h3>
                        Shame shame shame... Not really - It's actually no problem at all. Just enter your email in the box below and we'll send it right along.                    </div>
                    </div>
                    <?php if($_GET['msg']){ ?>
                    <span id="errors">El correo electronico  no existe en el sistema.</span>
                    <?php } ?>
                    <div id="header"><h1>Recuperar Contraseña</h1></div>
                    <form name="login" action="<?php echo $_SERVER['PHP_SELF'] ?>?action=acceso" method="post">
                        <ul>
                            <li>
                                <label>E-mail:</label><br />
                                <input type="text" name="login" class="txt" id="inp_mail" placeholder="Ingrese su Correo electronico" />
                                <p><strong><a href="login.php">Iniciar Sesión</a></strong></p>
                            </li>
                            <li>
                                <input type="submit" id="btn_enviar" value="" style="float:left; margin-right:20px" />
                            </li>
                        </ul>
                    </form>
                    <?php
                }else{
                    ?>
                 <div id="forgot-password-flash" class="flash bad" style="display:none;">
                    <div class="inner">
                        <h3>Did you forget your password?</h3>
                        Shame shame shame... Not really - It's actually no problem at all. Just enter your email in the box below and we'll send it right along.                    </div>
                    </div>
                    <?php if($_GET['msg']){ ?>
                    <span id="exito">Los datos de acceso a su cuenta senviaron a su email.</span>
                    <?php } ?>
                    <div id="header"><h1>Administrador de Contenidos</h1></div>
                    <form name="login" action="index.php" method="post">
                    	<ul>
                        	<li>
                            	<label>Nombre de Usuario:</label><br />
                                <input type="text" class="txt" id="inp_usu" name="login" placeholder="Ingrese su nombre de usuario" value="<?php echo $_COOKIE['email_MKD']?>" tabindex="1"/>
                            </li>
                            <li>
                            	<label>Contraseña:</label><br />
                                <input type="password" class="txt" id="inp_passw" placeholder="Ingrese su constraseña" value="<?php echo $_COOKIE['pass_MKD']?>"  name="password" tabindex="2" />
                                <p><strong><a  href="login.php?action=recuperar_c">Olvidé mi contraseña</a></strong></p>
                            </li>
                            <li>
                            	<input type="submit" id="sign-in" name="enviar" value="" tabindex="3" />
                                <div id="remember-password">
                                	<label><input  name="recordar_si_MKD" value="si" <?php if(isset($_COOKIE['email_MKD']) && isset($_COOKIE['pass_MKD'])) { echo 'checked="checked"';}?> type="checkbox"  /> Recordarme por 30 días</label><br />
                                </div>

                            </li>
                        </ul>

                    </form>
                    <?php
                }
                ?>
            </div>
        </div>
 </div>
</body>-->


<body>
    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../dashboard/overview.html">Sistema de Cotizaciones Rasgos del Perú</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                       <a href="register.html">
                            Registrar
                        </a>
                    </li>
                    <!--<li>
                       <a href="../dashboard/overview.html">
                            Dashboard
                        </a>
                    </li>-->
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" data-color="" data-image="../aplication/webroot/imgs/background/background-2.jpg">
        <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <?php
                        if($_GET['action'] == 'recuperar_c'){
                        ?>
                            <form name="login" action="<?php echo $_SERVER['PHP_SELF'] ?>?action=acceso" method="post">
                                <div class="card" data-background="color" data-color="blue">
                                    <div class="card-header">
                                        <h3 class="card-title">Recuperar Contraseña</h3>
                                    </div>
                                    <div class="card-content">
                                        <div class="form-group">
                                            <label>Correo electrónico</label>
                                            <input type="mail" placeholder="Ingrese su correo electrónico" class="form-control input-no-border" id="inp_mail" name="login" value="<?php echo $_COOKIE['email_MKD']?>">
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-fill btn-wd ">Enviar Contraseña</button>
                                        <div class="forgot">
                                            <a href="login.php">Iniciar Sesión</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php
                        }else{
                        ?>
                            <form name="login" action="index.php" method="post">
                                <div class="card" data-background="color" data-color="blue">
                                    <div class="card-header">
                                        <h3 class="card-title">Iniciar Sesión</h3>
                                    </div>
                                    <div class="card-content">
                                        <div class="form-group">
                                            <label>Usuario</label>
                                            <input type="text" placeholder="Nombre de usuario" class="form-control input-no-border" id="inp_usu" name="login" value="<?php echo $_COOKIE['email_MKD']?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Contraseña</label>
                                            <input type="password" placeholder="Contraseña de la cuenta" class="form-control input-no-border" id="inp_passw" value="<?php echo $_COOKIE['pass_MKD']?>"  name="password">
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-fill btn-wd ">Iniciar Sesión</button>
                                        <div class="forgot">
                                            <a href="login.php?action=recuperar_c">Olvidaste la contraseña?</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer footer-transparent">
                <div class="container">
                    <div class="copyright">
                        &copy; <script>document.write(new Date().getFullYear())</script>, Creado Por <a href="http://www.develoweb.net">Develoweb</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
