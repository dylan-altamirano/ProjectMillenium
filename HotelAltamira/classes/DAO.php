<?php

  require_once("conexion.php");
  require_once("businesslogic.php");


  /**
   *
   */
  class usuario_dao
  {
      public $link;

      function __construct() {

      }



      public function insert($obj){

          $result;

          $link = conectarse();

          $id= $obj->getId();
          $nombre = $obj->getNombre();
          $correo = $obj->getCorreo();
          $pais = $obj->getPais();
          $role = $obj->getRole();
          $pass = $obj->getPassword();
          $activo = $obj->getActivo()?1:0;


          $statement = $link->prepare("CALL sp_create_user(?,?,?,?,?,?,?)");

          $statement->bind_param("ssssssi",$id,$nombre ,$correo ,$pais ,$role ,$pass ,$activo);

          $result= $statement->execute(); //Returns TRUE on success or FALSE on failure. See more on PHP documentation: http://php.net/manual/en/mysqli-stmt.execute.php

          $statement->close();

          $link->close();

          return $result; //Returns the value of action whether it was successful or not

      }

      public function update($obj){

          $link = conectarse();

          $id= $obj->getId();
          $nombre = $obj->getNombre();
          $correo = $obj->getCorreo();
          $pais = $obj->getPais();
          $role = $obj->getRole();
          $pass = $obj->getPassword();
          $activo = $obj->getActivo()?1:0;

          $statement = $link->prepare("CALL sp_update_user(?,?,?,?,?,?)");

          $statement->bind_param("sssssi",$id,$nombre ,$correo ,$pais, $pass ,$activo);

          $statement->execute();

          $statement->close();

          $link->close();

      }

      public function delete($key){

          $link = conectarse();

          $statement = $link->prepare("CALL sp_delete_user(?)");

          $statement->bind_param("s",$key);

          $statement->execute();

          $statement->close();

          $link->close();

      }

      public function autenticar($email, $password){

          $result;
          $row;
          //Empezamos la sesión en la página
          session_start();

          $link = conectarse();

          $statement = $link->prepare("CALL sp_autenticar_usuario(?, ?)");

          $statement->bind_param("ss",$email,$password);

          $statement->execute();

          $result = $statement->get_result(); //obtiene el resultado

          $row = $result->num_rows; //si es solo uno recorre el primer registro, de lo contrario hay que recorrerlo

          $statement->free_result(); //libera los objetos results

          $statement->close();

          $link->close();

          //Se cuenta el nnúmero de registros que devuelve, si existe creará la sesión para el usuario
            if ($row>0) {
              $_SESSION['user_name']=$email;
            }

          //Si la sesión existe entonces devolverá un valor booleano verdadero
         return ($_SESSION['user_name'])?true:false;
      }

      /**
       * Método que devuelve un valor que indica que si el correo existe en la base de datos
       */
      public function correo_si($email){

          //Variables
          $row = 0;

          $link = conectarse();

          $statement = $link->prepare("CALL sp_correo_si(?)");

          $statement->bind_param("s",$email);

          $statement->execute();

          $statement->bind_result($row); //obtiene el resultado

          $statement->fetch();//si es solo uno recorre el primer registro, de lo contrario hay que recorrerlo



          $statement->close();

          $link->close();

          //retorna la cantidad de registros que poseen ese correo, normalmente no será mayor que 1
          return $row;
      }

      function select($key){
        //Variables
        $row;
        $result;
        $id;
        $nombre;
        $correo;
        $pais;
        $role;
        $pass;
        $activo;
        $usuario = new usuario();

        $link = conectarse();

        $statement = $link->prepare("CALL sp_select_user(?)");

        $statement->bind_param("s",$key);

        $statement->execute();

        $statement->bind_result($id,$nombre,$correo,$pais,$role,$pass,$activo); //obtiene el resultado

        while ($statement->fetch()) {
          # code...
          //$statement->f();//si es solo uno recorre el primer registro, de lo contrario hay que recorrerlo
            $usuario->setID($id);
            $usuario->setNombre($nombre);
            $usuario->setCorreo($correo);
            $usuario->setPais($pais);
            $usuario->setRole($role);
            $usuario->setPassword($pass);
            $usuario->setActivo($activo);
        }


        $statement->free_result();
        $statement->close();

        $link->close();

        //retorna la cantidad de registros que poseen ese correo, normalmente no será mayor que 1
        return $usuario;
      }

  }

  class habitacion_dao{

      public $link;

      function __construct() {

      }

      public function cantidadDisponibleSegunTipo($tipo){

          $result=0;

          $link = conectarse();

          $statement = $link->prepare("CALL sp_cant_disponible_tipo(?)");

          $statement->bind_param("s",$tipo);

          $statement->execute();

          $statement->bind_result($result);

          $statement->fetch(); //Localiza y adquiere el siguiente resultado, si hay más registros entonces debemos recorrerlo con un ciclo

          $statement->close();

          $link->close();

          return $result;
      }

  }

  /**
   * Clase que se encarga de manejar la facturacion del servicio y su respectivo guardado en la base de datos
   */
  class reservacion_dao{

      public $link;

      function __construct() {

      }

      public function insert($reservacion){
          $link = conectarse();

          $id= $reservacion->getId();
          $fecha_ini = $reservacion->getFechaIni();
          $fecha_fin = $reservacion->getFechaFin();
          $id_usuario = $reservacion->getUsuario()->getId();
          $total = $reservacion->calcularPrecio();
          $estado = $reservacion->getEstado();


          $statement = $link->prepare("CALL sp_insert_reservacion(?,?,?,?,?,?)");

          $statement->bind_param("ssssds",$id,$fecha_ini ,$fecha_fin ,$id_usuario ,$total ,$estado);

          $statement->execute();

          $statement->close();

          $link->close();
      }

      /**
       * Función que actualiza los datos de una reservacion.
       */
      public function update($reservacion){

          $link = conectarse();
          //conjunto de variables que obtienen los valores del objeto reservacion. Ya que no se puede pasar por referencia los parametros en bind_param
          $id= $reservacion->getId();
          $fecha_ini = $reservacion->getFechaIni();
          $fecha_fin = $reservacion->getFechaFin();
          $id_usuario = $reservacion->getUsuario()->getId();
          $total = $reservacion->calcularPrecio();
          $estado = $reservacion->getEstado();
          //fin conjunto de variables

          $statement = $link->prepare("CALL sp_update_reservacion(?,?,?,?,?)");

          $statement->bind_param("sssds",$id,$fecha_ini ,$fecha_fin,$total ,$estado);

          $statement->execute();

          $statement->close();

          $link->close();


      }

      /**
       * Función que elimina un registro de la tabla de reservaciones en la bd.
       */
      public function delete($key) {

          $link = conectarse();

          $statement = $link->prepare("CALL sp_delete_reservacion(?)");

          $statement->bind_param("s",$key);

          $statement->execute();

          $statement->close();

          $link->close();

      }

      /**
       * Selecciona un solo registro de la reservacion conociendo su número de factura.
       * @param type $key
       * @return type
       */
      public function select($key) {
          //Variables
          $row;

          $link = conectarse();

          $statement = $link->prepare("CALL sp_select_reservacion(?)");

          $statement->bind_param("s",$key);

          $statement->execute();

          $statement->bind_result($row); //obtiene el resultado

          $statement->fetch();//si es solo uno recorre el primer registro, de lo contrario hay que recorrerlo

          $statement->close();

          $link->close();

          //retorna la cantidad de registros que poseen ese correo, normalmente no será mayor que 1
          return $row;
      }

      /**
       * Guarda las habitaciones en la reservacion del usuario.
       * @param type $reservacion
       */
      public function guardarHabitaciones($reservacion) {

            $link = conectarse();

            $reservacion_id = $reservacion->getId();

            $habitaciones = $reservacion->getHabitaciones();

            $statement = $link->prepare("CALL sp_insert_detalle(?,?)");

           //Recorre el arreglo de habitaciones que posee la reservacion e inserta cada uno de los registros.
           foreach ($habitaciones as $habitacion) {

                $habitacion_id = $habitacion->getID();

                $statement->bind_param("ss",$reservacion_id ,$habitacion_id);
                //Ejecuta cada inserción en la tabla detalle
                $statement->execute();
           }

          $statement->close();

          $link->close();


      }

      /**
       * Obtiene el último ID de la columna ID de la reservacion para crear la siguiente.
       * @return int
       */
      public function getLastID(){

          //Variables
          $row = 0;

          $link = conectarse();

          $statement = $link->prepare("CALL sp_get_last_id()");

          $statement->execute();

          $statement->bind_result($row); //obtiene el resultado

          $statement->fetch();//si es solo uno recorre el primer registro, de lo contrario hay que recorrerlo

          $statement->close();

          $link->close();

          //retorna la cantidad de registros que poseen ese correo, normalmente no será mayor que 1
          return $row;

      }

      /**
       * Obtiene todos los registros de las reservaciones del hotel.
       * @return array
       */
      public function getBookedRooms(){

          $array_reservaciones = array();
          //Variables
          $row;
          $result;

          $link = conectarse();

          $statement = $link->prepare("CALL sp_get_booked_rooms()");


          $statement->execute();

          $result = $statement->get_result(); //obtiene el resultado

          //si es solo uno recorre el primer registro, de lo contrario hay que recorrerlo

          while ($row = $result->fetch_object()) {

              $reservacion = new reservacion();
              $hab = new habitacion();

              $reservacion->setId($row->ID);
              $reservacion->setFechaIni($row->fecha_ini);
              $reservacion->setFechaFin($row->fecha_fin);

              //Obtenemos el id de la habitacion
              $hab->setId($row->IDHabitacion);
              $hab->setTipo($row->tipo);

              $reservacion->addHabitacion($hab);

              array_push($array_reservaciones, $reservacion);

          }


          $statement->close();

          $link->close();

          //retorna la cantidad de registros que poseen ese correo, normalmente no será mayor que 1
          return $array_reservaciones;

      }
      /**
       * Obtiene solo los registros que poseen el tipo de habitacion deseado.
       * @param type $tipop
       * @return array
       */
      public function getRooms($tipop){

          $habitaciones = array();
          //Variables
          $row;
          $result;

          $link = conectarse();

          $statement = $link->prepare("CALL sp_get_rooms(?)");

          $statement->bind_param("s", $tipop);

          $statement->execute();

          $result = $statement->get_result(); //obtiene el resultado

          //si es solo uno recorre el primer registro, de lo contrario hay que recorrerlo

          while ($row = $result->fetch_object()) {

              $hab = new habitacion();

              $hab->setId($row->ID);
              $hab->setTipo($row->tipo);

              array_push($habitaciones, $hab);

          }


          $statement->close();

          $link->close();

          //retorna la cantidad de registros que poseen ese tipo de habitacion, normalmente no será mayor que 1
          return $habitaciones;


      }



  }


 ?>
