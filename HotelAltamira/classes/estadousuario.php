<?php
  require_once('classes/funciones.php');

 ?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hola <?php user_greeting(); ?> <b class="caret"></b></a>
    <ul class="dropdown-menu">

        <li>
            <a href="portfolio-4-col.html">Configurar mi cuenta</a>
        </li>
        <li>
            <a href="classes/logout.php">Salir</a>
        </li>
    </ul>
</li>
