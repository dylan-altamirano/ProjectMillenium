<?php require_once('classes/header.php');
require_once('classes/DAO.php');

$usuario_a = new usuario_dao();
$usuario = new usuario();

if (isset($_POST['buscar'])) {
  $user_key = $_POST['buscar'];

  $usuario = $usuario_a->select($user_key);
}

?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Administrar Usuarios

                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Inicio</a>
                    </li>
                    <li class="active">Administrar usuarios</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <form class="" action="adminUsers.php" method="post">
            <div class="container">
              <h1 class="display-3">Bienvenido al centro de base de datos de clientes</h1>
              <div class="row">
                <div class="well">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="submit">Buscar</button>
                    </span>
                    <input type="text" class="form-control" name="buscar" placeholder="Buscar por correo electrónico...">
                  </div>
                </div>
            </div>
          </div>
        </form>



          <?php
                if ($usuario->getCorreo()!="") {
                  require_once('classes/mostrarUsuarios.php');
                }else{
                  require_once('classes/no_match.php');
                }
           ?>


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

</body>

</html>
