<?php require_once('classes/header.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Reservaciones
                    <small>Fácil y sencillo</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a>
                    </li>
                    <li class="active">Reservaciones</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

      <!--Comienzo del formulario de reservacion-->
      <form class="" name="formularioReservacion" action="reservar.php" method="post">


        <!-- Content Row -->
        <!--Habitacion sencilla-->
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sencilla</h3>
                    </div>
                    <div class="panel-body">
                        <span class="price"><sup>$</sup>100<sup>00</sup></span>
                        <span class="period">por noche</span>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>2</strong> personas</li>
                        <li class="list-group-item"><strong>1</strong> Baño</li>
                        <li class="list-group-item"><strong>Servicio</strong> al cuarto</li>
                        <li class="list-group-item"><strong>Comida</strong> incluida</li>
                        <li class="list-group-item"><strong>100Mbps</strong> internet</li>

                        <li class="list-group-item"><label class="form-check-label"><input type="radio" class="form-check-input" name="optionRooms" id="rbdSencilla" value="Sencilla"></label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary text-center">
                    <div class="panel-heading">
                        <h3 class="panel-title">Doble <span class="label label-success">Recomendada</span></h3>
                    </div>
                    <div class="panel-body">
                        <span class="price"><sup>$</sup>140<sup>00</sup></span>
                        <span class="period">por noche</span>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>4</strong> personas</li>
                        <li class="list-group-item"><strong>2</strong> baños</li>
                        <li class="list-group-item"><strong>Servicio</strong> al cuarto</li>
                        <li class="list-group-item"><strong>Comida</strong> incluida</li>
                        <li class="list-group-item"><strong>100Mbps</strong> internet</li>
                        <li class="list-group-item"><label class="form-check-label"><input type="radio" class="form-check-input" name="optionRooms" id="rbdDoble" value="Doble"></label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h3 class="panel-title">Suite</h3>
                    </div>
                    <div class="panel-body">
                        <span class="price"><sup>$</sup>180<sup>00</sup></span>
                        <span class="period">por noche</span>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Más de 7</strong> personas</li>
                        <li class="list-group-item"><strong>4</strong> baños</li>
                        <li class="list-group-item"><strong>Servicio</strong> al cuarto</li>
                        <li class="list-group-item"><strong>Comida</strong> incluida</li>
                        <li class="list-group-item"><strong>100Mbps</strong> internet</li>
                        <li class="list-group-item"><label class="form-check-label"><input type="radio" class="form-check-input" name="optionRooms" id="rbdSuite" value="Suite"></label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-4">
            <div class="form-group row">
                <label for="fecha-inicial-id" class="col-2 col-form-label">Seleccione la fecha inicial</label>
                <div class="col-10">
                  <input class="form-control" type="date" name="fecha-inicial" id="fecha-inicial-id" value=<?php echo date('Y-m-d'); ?>>
                </div>
            </div>

          </div>

          <div class="col-md-4">
            <div class="form-group row">
                <label for="fecha-final-id" class="col-2 col-form-label">Seleccione la fecha final</label>
                <div class="col-10">
                  <input class="form-control" type="date" name="fecha-final" id="fecha-final-id" value=<?php echo date('Y-m-d'); ?>>
                </div>
            </div>

          </div>
          <div class="col-md-4">
            <div class="form-group">

              <div class="col-10">
                <button type="submit" name="cotizar" class="btn btn-primary">Cotizar</button>
              </div>
            </div>
          </div>


        </div>

      </form> <!--Fin del formualario de reservacion-->
        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
