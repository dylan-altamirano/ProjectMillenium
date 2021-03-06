  <?php require_once('classes/header.php'); ?>

    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('img/slides/portada.jpeg');"></div>
                <div class="carousel-caption">
                    <h2>Increíbles paisajes</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('img/slides/comida.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Deliciosa comida</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('img/slides/habitacion.jpeg');"></div>
                <div class="carousel-caption">
                    <h2>Habitaciones de lujo</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Bienvenidos a Hotel Altamira
                </h1>
            </div>

            <!--Características del hotel-->
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i> Instalaciones</h4>
                    </div>
                    <div class="panel-body">
                        <p>Contamos con unas amplias y espaciosas instalaciones. En las cuales, podes disfrutar de muchas comodidades que te encantarán debido a nuestro entorno rústico. Habitaciones, comedores, baños, salones, spa y mucho más...</p>
                        <a href="portfolio-4-col.php" class="btn btn-info">Aprende más</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-gift"></i>Servicio de cotización en línea</h4>
                    </div>
                    <div class="panel-body">
                        <p>¿No quieres reservar todavía? No importa, acá sabemos lo importante que es para tí el administrar bien tu dinero. Por eso contamos con una variedad de servicios, entre ellos tenemos el cotizador en línea que le proveera toda
                            información posible.
                        </p>
                        <?php
                              if (isset($_SESSION['user_name'])) {
                                echo "<a href='pricing.php' class='btn btn-info'>Aprende más</a>";
                              }else{
                                echo "<a href='#' class='btn btn-info' data-toggle='modal' data-target='#signIn'>Aprende más</a>";
                              }
                         ?>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-compass"></i>Reserva fácil</h4>
                    </div>
                    <div class="panel-body">
                        <p>Utiliza nuestro sistema de reservas que estamos seguros encontrarás fácil de usar. Y que nuestro enfoque siempre ha sido, y lo seguirá siendo nuestros clientes. Interfaz gráfica sencilla que te permitirá
                          realizar reservaciones sin complicaciones.

                        </p>
                        <?php
                              if (isset($_SESSION['user_name'])) {
                                echo "<a href='pricing.php' class='btn btn-info'>Aprende más</a>";
                              }else{
                                echo "<a href='#' class='btn btn-info' data-toggle='modal' data-target='#signIn'>Aprende más</a>";
                              }
                         ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!--Valores section-->
        <div class="container row">
            <!--Imagen cerca del accordion element-->
            <div id="image-valores" class="col-xs-2 pull-left clearfix">
              <img class="img-resonsive img-hover img-related thumbnail"src="img/informatives/abcde.jpeg" alt="">

            </div>
            <div class="panel-group col-xs-4 clearfix" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Lo que hacemos
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <p>Lo que pretendemos es mostrar una cara diferente respecto a el negocio hotelero. No ser parte del montón más enorgullecerse de nuestro trabajo, el cual realizamos de la mejor y, más digna manera posible. Queremos expandir nuestras operaciones y proveer a nuestros clientes con un servicio de categoría mundial.
                        Utilizando los más altos estándares posibles para así dar a conocer el futuro del mercado así, también como las nuevas tendencias que salen a la luz. De esta manera influímos significativamente en la vida de las personas que nos rodean, comenzando con nuestros clientes, proveedores y por último pero no menos importante, nuestros colaboradores.
                    </p>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Lo que hemos hecho
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                    Es un antiguo Estado polinesio del siglo XIX, anexado en 1895 a Francia, por la voluntad de la última reina Teriimaevarua III y de los principales jefes del reino.En el siglo XVIII, surge un gran jefe, llamado Puni (Teihotu Matarua), quien consiguió dominar los otros clanes de la isla de Bora-Bora. Se alió a continuación con los líderes de la isla de Tahaa (ubicada entre Bora Bora y Raiatea). Con esta alianza, alcanzó a dominar las islas Raiatea, de Tahaa y de Maupiti. En 1769, cuando James Cook desembarca en Tahaa y Raiatea, las islas ya están bajo la soberanía de Puni. A la muerte de Puni, su sobrino, Tapoa I, jefe supremo de Bora-Bora, Raiatea y Tahaa, se instala en Raiatea, dejando así el poder local de Bora Bora a los caudillos May y Tefaaora, originarios de los poblados de Nunue y Anau, y adjuntos al Marae de Vaiotaha. </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Lo que haremos
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body">
                   Mejorar nuestro servicio y hacer crecer nuestro hotel para que nuestros clientes salgan satisfechos
				   </div>
                </div>
              </div>
            </div>

          </div>



        <hr>

        <!-- Call to Action Section
        <div class="well">
            <div class="row">
             <?php
//require_once('contador.php');

 ?>
<h1 class="col-lg-12">Contador de visitas:1
<?php
//echo contadorVisitas();
?>
</h1>
            </div>
        </div>-->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Grupo Altamira 2017</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/signinfunctions.js">

    </script>
    <script type="js/funciones.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
