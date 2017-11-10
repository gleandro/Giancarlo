<?php 
class Secciones{

	public function home()
	{
	?>
          
            Hola Mundo
     
        <?php  
	}

 
 
        
	public function confirmacion(){
		?>
        <div id="confirmacion">
            <h1><?php echo _web19_ ?></h1>
            <div class="linea"><img src="aplication/webroot/imgs/line.png" alt="" /></div>
           	<div class="text_confirmacion">
            	<img src="aplication/webroot/imgs/mail.png" /> &nbsp;&nbsp; Su mensaje fue enviado correctamente.
            </div>
        </div>
		<?php
	}


    public function login($value='')
    {
        ?>
        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../dashboard/overview.html">Sistema RASGOS</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="register.html">
                                Register
                            </a>
                        </li>
                        <li>
                           <a href="../dashboard/overview.html">
                                Dashboard
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="wrapper wrapper-full-page">
            <div class="full-page login-page" data-color="" data-image="aplication/webroot/imgs/background/background-2.jpg">
            <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                                <form method="POST" action="#">
                                    <div class="card" data-background="color" data-color="blue">
                                        <div class="card-header">
                                            <h3 class="card-title">Login</h3>
                                        </div>
                                        <div class="card-content">
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" placeholder="Enter email" class="form-control input-no-border">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" placeholder="Password" class="form-control input-no-border">
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-fill btn-wd ">Iniciar Sesión</button>
                                            <div class="forgot">
                                                <a href="#pablo">Forgot your password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer footer-transparent">
                    <div class="container">
                        <div class="copyright">
                            &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <?php
    }

} ?>
