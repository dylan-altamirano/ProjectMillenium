<?php
  require_once('classes/funciones.php');

 ?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hola <?php user_greeting(); ?> <b class="caret"></b></a>
    <ul class="dropdown-menu">

        <li>
            <a href="portfolio-4-col.html">Configurar mi cuenta</a>
        </li>
        <?php
              if ($_SESSION['user_name']=="admin@altamira.com") {
                echo "<a href='adminUsers.php' class='btn btn-info'>Administrar usuarios</a>";
              }
         ?>
        <li>
            <a href="classes/logout.php">Salir</a>
        </li>
    </ul>
</li>
