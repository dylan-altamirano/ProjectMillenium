<?php
  require_once('classes/funciones.php');

 ?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hola <?php user_greeting(); ?> <b class="caret"></b></a>
    <ul class="dropdown-menu">

        <li>
            <a href="#">Configurar mi cuenta</a>
        </li>
        <?php
              if ($_SESSION['user_name']=="admin@altamira.com") {
                echo "<li><a href='adminUsers.php' class=''>Administrar usuarios</a></li>";
                echo "<li><a href='envioPublicidad.php' class=''>Enviar correo publicitario</a></li>";
              }
         ?>
        <li>
            <a href="classes/logout.php">Salir</a>
        </li>
    </ul>
</li>
