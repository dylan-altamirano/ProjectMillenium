<?php

require_once("businesslogic.php");
require_once("DAO.php");

$usuario= new usuario();

$usuario->setId("2017006");
$usuario->setNombre("Monica Ramirez");
$usuario->setCorreo("monicaal@aol.net");
$usuario->setPais("United States");
$usuario->setRole("cliente");
$usuario->setPassword("jescasti623");
$usuario->setActivo(true);

$usuario_b= new usuario();

$usuario_b->setId("2017007");
$usuario_b->setNombre("Ciany Mora");
$usuario_b->setCorreo("cianmora@amazon.com");
$usuario_b->setPais("United States");
$usuario_b->setRole("cliente");
$usuario_b->setPassword("123456");
$usuario_b->setActivo(true);

$usuario_c= new usuario();

$usuario_c->setId("2017008");
$usuario_c->setNombre("Alexandra");
$usuario_c->setCorreo("alex@sbcglobal.net");
$usuario_c->setPais("United States");
$usuario_c->setRole("cliente");
$usuario_c->setPassword("almeda");
$usuario_c->setActivo(true);

/*$usuario_d= new usuario_dao();

$usuario_d->delete("2017006");
*/
//$usuario_d = new usuario_dao();
//
//$result = $usuario_d->correo_si("cerdilan@amazon.com");
//
//echo "correo encontrado $result";

//
//$lista = array();
//
//array_push($lista, $usuario);
//array_push($lista, $usuario_b);
//array_push($lista, $usuario_c);
//
//echo '<hr>';
//foreach($lista as $usuario){
//    echo "Nombre: ".$usuario->getNombre();
//    echo "<br>";
//    echo "Correo: ".$usuario->getCorreo();
//    echo "<hr>";
//}


//$reservacion_a = new reservacion();
//
//$reservacion_a->setId("1");
//$reservacion_a->setFechaIni("2017-04-02");
//$reservacion_a->setFechaFin("2017-04-06");
//
//
//$reservacion_b = new reservacion();
//
//$reservacion_b->setId("2");
//$reservacion_b->setFechaIni("2017-04-01");
//$reservacion_b->setFechaFin("2017-04-03");
//
//
//
//$reservacion_c = new reservacion();
//
//$reservacion_c->setId("3");
//$reservacion_c->setFechaIni("2017-04-04");
//$reservacion_c->setFechaFin("2017-04-08");
//
//
//$reservacion_d = new reservacion();
//
//$reservacion_d->setId("4");
//$reservacion_d->setFechaIni("2017-04-03");
//$reservacion_d->setFechaFin("2017-04-05");
//
//$reservacion_e = new reservacion();
//
//$reservacion_e->setId("5");
//$reservacion_e->setFechaIni("2017-04-07");
//$reservacion_e->setFechaFin("2017-04-09");
//
//
//$reservacion_f = new reservacion();
//
//$reservacion_f->setId("6");
//$reservacion_f->setFechaIni("2017-03-25");
//$reservacion_f->setFechaFin("2017-04-01");
//
//
//$reservacion_h = new reservacion();
//
//$reservacion_h->setId("7");
//$reservacion_h->setFechaIni("2017-05-13");
//$reservacion_h->setFechaFin("2017-05-17");


$bookings;
//
//array_push($bookings, $reservacion_a);
//array_push($bookings, $reservacion_b);
//array_push($bookings, $reservacion_c);
//array_push($bookings, $reservacion_d);
//array_push($bookings, $reservacion_e);
//array_push($bookings, $reservacion_f);
//array_push($bookings, $reservacion_h);


$reservacion_a = new reservacion_dao();

$bookings = $reservacion_a->getBookedRooms();

echo "<br>";
foreach ($bookings as $reservacion) {
    echo "ID ".$reservacion->getID()."<br>";
    echo "Fecha Inicio ".$reservacion->getFechaIni()."<br>";
    echo "Fecha Final ".$reservacion->getFechaFin()."<br>";
}

$reservacion = new reservacion();
//
//
//$id = intval($reservacion_a->getLastID());
//
//
//
//$id++;
//
//$reservacion->setId($id);
$reservacion->setFechaIni("2017-04-02");
$reservacion->setFechaFin("2017-04-06");
//$reservacion->setUsuario($usuario_c);
$reservacion->get_array_Bookings_from_database($bookings);
$reservacion->get_array_all_rooms_by_type($reservacion_a->getRooms("Sencilla"));
//$reservacion->setEstado("Facturado");
//
//
//
//
$booked = $reservacion->booking();

   //echo "Nº Reservación: ".$reservacion->getId();
   echo "<hr> <br><br>";
   echo "Booked rooms";

   foreach($booked as $habitacion){
       echo "<br>";
       echo "Room ".$habitacion->getId();
   }
//
//
//   //reservar
//   $reservacion->reservarHabitacion();<
//
//   $habitaciones = $reservacion->getHabitaciones();
//
//   //habitaciones reservadas
//   echo "<hr> <br> Habitaciones a reservar: ";
//   foreach($habitaciones as $hab){
//       echo "<br>";
//       echo "Room ".$hab->getID()." Tipo: ".$hab->getTipo();
//   }
//
//   echo "Precio total: ".
//
//   $reservacion_b = new reservacion_dao();
//
//   $reservacion_b->insert($reservacion);
//   echo "Reservacion guardada";
//
//   if ($reservacion->getEstado()!="Cotizado") {
//    $reservacion_b->guardarHabitaciones($reservacion);
//    echo "Habitaciones guardadas con exito";
//}


?>
<html>
    <head>
        <title>Booking hotel</title>
        <meta charset="utf-8">
    </head>
    <body>

    </body>
</html>
