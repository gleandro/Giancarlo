<?php include("inc.aplication_top.php");

// Recordar por 30 dias la cuenta.
if($_POST){
	if($_POST['recordar_si_MKD'] == 'si')
	{
		setcookie ("pass_MKD", "$_POST[password]", time () + 2592000);
		setcookie ("email_MKD", "$_POST[login]", time () + 2592000);
	}else{
		setcookie ("pass_MKD", "", time () + 604800);
		setcookie ("email_MKD", "", time () + 604800);
	}
}
include(_includes_."admin/inc.header.php");
?>
    <?php include 'menu.php'; ?>
        <?php include 'nav.php'; ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <!-- your content here -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-warning text-center">
                                                <i class="ti-shopping-cart"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Cotizaciones</p>
                                                <?php echo Cotizaciones::getTotalCotizaciones(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Actualizar
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-info text-center">
                                                <i class="ti-pie-chart"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Ventas</p>
                                                <?php echo "$".ceil(Ventas::getVentasTotal()); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Actualizar
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-success text-center">
                                                <i class="ti-car"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Paquetes</p>
                                                <?php echo Paquetes::getTotalPaquetes(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Actualizar
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-danger text-center">
                                                <i class="ti-home"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="numbers">
                                                <p>Hoteles</p>
                                                <?php echo Hoteles::getTotalHoteles(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Actualizar
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <div class="numbers pull-left">
                                                $34,657
                                            </div>
                                        </div>
                                        <div class="col-xs-5">
                                            <div class="pull-right">
                                                <span class="label label-success">
                                                    +18%
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="big-title">total obtenido <span class="text-muted">en los ultimos</span> 6 <span class="text-muted">meses</span></h6>
                                    <div id="chartTotalEarnings"></div>
                                </div>
                                <div class="card-footer">
                                    <hr>
                                    <div class="footer-title">Estadisticas Financieras</div>
                                    <div class="pull-right">
                                        <button class="btn btn-info btn-fill btn-icon btn-sm">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <div class="numbers pull-left">
                                                169
                                            </div>
                                        </div>
                                        <div class="col-xs-5">
                                            <div class="pull-right">
                                                <span class="label label-danger">
                                                    -14%
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="big-title">total subscripciones <span class="text-muted">en los ultimos</span> 7 dias</h6>
                                    <div id="chartTotalSubscriptions"></div>
                                </div>
                                <div class="card-footer">
                                    <hr>
                                    <div class="footer-title">Ver todos los subscriptores</div>
                                    <div class="pull-right">
                                        <button class="btn btn-default btn-fill btn-icon btn-sm">
                                            <i class="ti-angle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <div class="numbers pull-left">
                                                8,960
                                            </div>
                                        </div>
                                        <div class="col-xs-5">
                                            <div class="pull-right">
                                                <span class="label label-warning">
                                                    ~51%
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="big-title">total de descargas <span class="text-muted">en los ultimos</span> 6 años</h6>
                                    <div id="chartTotalDownloads" ></div>
                                </div>
                                <div class="card-footer">
                                    <hr>
                                    <div class="footer-title">Ver mas detalles</div>
                                    <div class="pull-right">
                                        <button class="btn btn-success btn-fill btn-icon btn-sm">
                                            <i class="ti-info"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function(){
                    demo.initOverviewDashboard();
                    demo.initCirclePercentage();

                });
            </script>
            <?php include 'footer.php'; ?>
