<?php
//Esta función se conecta a la base de datos en mysql y retorna la instancia de conexión
function conectarse(){

    $link = mysqli_connect("localhost", "sa","Ls1s2s3s5s7","db_hotel");

    //Intenta conectarse a la base datos elegida
    if (mysqli_connect_errno()) {
      echo "Error al conectarse a la base de datos";
    }else {
     // echo $link->host_info."\n";
    }

    //Selecciona la base de datos
    if (!$link->select_db("db_hotel")) {
      echo "Error la seleccionar la base de datos";
      exit();
    }else {
      if ($result = $link->query("SELECT DATABASE()")) {
        $row = $result->fetch_row();
       // echo "La base de datos seleccionada es ".$row[0];
        $result->close();
      }
    }

    return $link;

}

 ?>
