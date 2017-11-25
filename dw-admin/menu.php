<?php
/*
	if($sesion->getUsuario()->getLogeado() === TRUE){

	}else{
		//$secciones = array($modulos);
	}
  echo $sesion->getUsuario()->getNombre();
  echo $sesion->getUsuario()->getApellidos();
  echo $sesion->getUsuario()->getFoto();
  echo $sesion->getUsuario()->getRol()->getNombre();
  echo '<pre>';
	echo var_dump($sesion->getUsuario());
	echo '</pre>';

*/
?>
<body>
    <div class="wrapper">
        <div class="sidebar" data-background-color="brown" data-active-color="danger">
        <!--
            Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
            Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
        -->
            <div class="logo">
                <a href="index.php" class="simple-text logo-mini">
                    CT
                </a>

                <a href="index.php" class="simple-text logo-normal">
                    Rasgos
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="<?php echo _imgs_.$sesion->getUsuario()->getFoto() ?>" />
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            <span>
                                <?php echo $sesion->getUsuario()->getRol()->getNombre() ?>
                                <b class="caret"></b>
                            </span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li class="hidden">
                                    <a href="#profile">
                                        <span class="sidebar-mini">Mp</span>
                                        <span class="sidebar-normal">Mi Perfil</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="counters.php?action=edit&id=<?php echo $sesion->getUsuario()->getId() ?>">
                                        <span class="sidebar-mini">Ep</span>
                                        <span class="sidebar-normal">Editar Perfil</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#settings">
                                        <span class="sidebar-mini">C</span>
                                        <span class="sidebar-normal">Configuración</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="index.php?action=logout">
                                        <span class="sidebar-mini">S</span>
                                        <span class="sidebar-normal">x Salir</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li>
                        <a href="index.php">
                            <i class="ti-dashboard"></i>
                            <p>Panel</p>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#dashOperaciones">
                            <i class="ti-settings"></i>
                            <p>Operaciones
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="dashOperaciones">
                            <ul class="nav">
                                <li>
                                    <a href="paquetes.php">
                                        <span class="sidebar-mini"><i class="ti-package"></i></span>
                                        <span class="sidebar-normal">Paquetes</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="cotizaciones.php">
                                        <span class="sidebar-mini"><i class="ti-clipboard"></i></span>
                                        <span class="sidebar-normal">Cotizaciones</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#dashboardOverview">
                            <i class="ti-hummer"></i>
                            <p>Mantenimiento
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="dashboardOverview">
                            <ul class="nav">
                                <li>
                                    <a href="hoteles.php">
                                        <span class="sidebar-mini"><i class="ti-home"></i></span>
                                        <span class="sidebar-normal">Hoteles</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="habitaciones.php">
                                        <span class="sidebar-mini"><i class="fa fa-bed"></i></span>
                                        <span class="sidebar-normal">Tipo Habitaciones</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="servicios.php">
                                        <span class="sidebar-mini"><i class="ti-check-box"></i></span>
                                        <span class="sidebar-normal">Servicios</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="tipo_servicios.php">
                                        <span class="sidebar-mini"><i class="ti-truck"></i></span>
                                        <span class="sidebar-normal">Tipos de Servico</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="departamentos.php">
                                        <span class="sidebar-mini"><i class="fa fa-globe"></i></span>
                                        <span class="sidebar-normal">Departamentos</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="agencias.php">
                                        <span class="sidebar-mini"><i class="ti-map-alt"></i></span>
                                        <span class="sidebar-normal">Agencias</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="counters.php">
                                        <span class="sidebar-mini"><i class="ti-headphone-alt"></i></span>
                                        <span class="sidebar-normal">Counters</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#panda">
                                        <span class="sidebar-mini"><i class="ti-user"></i></span>
                                        <span class="sidebar-normal">Clientes</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="empresas.php">
                                        <span class="sidebar-mini"><i class="ti-briefcase"></i></span>
                                        <span class="sidebar-normal">Empresas</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <!-- <a href="calendar.html"> -->
                          <a href="#calendar.html">
                            <i class="ti-clipboard"></i>
                            <p>Reportes</p>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
<?php
?>
