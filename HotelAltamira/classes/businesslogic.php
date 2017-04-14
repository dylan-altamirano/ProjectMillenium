<?php
require_once("collection.php");//Custom collection class that was created for getting the array of rooms
/**
 *Crea un usuario en el sistema. Este puede ser Cliente o Administrador.
 */
class usuario
{
  private $id;
  private $nombre;
  private $correo;
  private $pais;
  private $role;
  private $password;
  private $activo;

  //Constructor
  function __construct()
  {
    $this->id="";
    $this->nombre="";
    $this->correo="";
    $this->pais="";
    $this->role="Cliente";
    $this->password="";
    $this->activo=true;
  }
  //Accessors
  public function setId($id){
    $this->id=$id;
  }

  public function getId(){
    return $this->id;
  }

  public function setNombre($nombre){
    $this->nombre=$nombre;
  }

  public function getNombre(){
    return $this->nombre;
  }

  public function setCorreo($correo){
    $this->correo=$correo;
  }

  public function getCorreo(){
    return $this->correo;
  }

  public function setPais($pais){
    $this->pais=$pais;
  }

  public function getPais(){
    return $this->pais;
  }

  public function setRole($role){
    $this->role=$role;
  }

  public function getRole(){
    return $this->role;
  }

  public function setPassword($password){
    $this->password=$password;
  }

  public function getPassword(){
    return $this->password;
  }

  public function setActivo($activo){
    $this->activo=$activo;
  }

  public function getActivo(){
    return $this->activo;
  }
//End-accessors

}//End-class-usuario

/**
 * Crea una habitación nueva. Clase base.
 */
class habitacion
{
  private $id;
  private $tipo;
  private $disponible;

  function __construct()
  {

  }

  public function setId($id){
    $this->id=$id;
  }

  public function getId(){
    return $this->id;
  }

  public function setTipo($tipo){
    $this->tipo=$tipo;
  }

  public function getTipo(){
    return $this->tipo;
  }

  //End-of-accessors

  /*
  *Método que calcula el precio de la habitacion
  **/
  public function calcularPrecio(){

    switch ($this->tipo) {
      case 'Sencilla':
        return 100.00;
        break;

      case 'Doble':
        return 140.00;
        break;
      case 'Suite':
        return 180.00;
        break;
    }

  }


}//End-of-class-habitacion

/**
 * Clase que se encarga de procesar la reservacion
 */
class reservacion
{
  private $id;
  private $fecha_ini;
  private $fecha_fin;
  private $usuario;
  private $array_habitaciones;
  private $estado;


  //Otro tipo de variables
  private $array_bookings;
  private $array_booked_rooms;
  private $array_tipo_habitaciones;


  function __construct()
  {
     //$this->$array_habitaciones = new Collection();
     $this->usuario = new usuario();
     $this->fecha_ini = new DateTime();
     $this->fecha_ini->format("Y-m-d");
     $this->fecha_fin = new DateTime();
     $this->fecha_fin->format("Y-m-d");
     $this->array_habitaciones = new ArrayObject();
  }

  public function setId($id){
    $this->id=$id;
  }

  public function getId(){
    return $this->id;
  }

  public function setFechaIni($fecha_ini){
    $this->fecha_ini=$fecha_ini;
  }

  public function getFechaIni(){
    return $this->fecha_ini;
  }

  public function setFechaFin($fecha_fin){
    $this->fecha_fin=$fecha_fin;
  }

  public function getFechaFin(){
    return $this->fecha_fin;
  }

  public function setUsuario(usuario $usuario){
    $this->usuario=$usuario;
  }

  public function getUsuario(){
    return $this->usuario;
  }
  public function setEstado($estado){
    $this->estado=$estado;
  }

  public function getEstado(){
    return $this->estado;
  }
  //End-accessors

  //Methods
  public function addHabitacion($habitacion){
      $this->array_habitaciones->append($habitacion);
  }

  public function getHabitacion($index){
      $obj;

      $obj = $this->array_habitaciones->offsetGet($index);

      return $obj;
  }

  public function getHabitaciones() {
      return $this->array_habitaciones;
  }



  /**
   * Obtiene los registros de la base de datos.
   * Usa el método de la clase DAO getBookedRooms(); y pasa el array que devuelve como parámetro
   * @param type $array
   */
  public function get_array_Bookings_from_database($array){
      $this->array_bookings = $array;
  }

  public function get_array_all_rooms_by_type($array){
      $this->array_tipo_habitaciones = $array;
  }

  /**
   * Retorna un valor booleano si la fecha de reservacion es en temporada alta.
   * @return boolean
   */
  public function esTemporadaAlta(){

      $meses = array(7,8,9,10,11,12);

      $start_date = $this->getFechaIni();
      $mes;

      //Obtiene el mes de una fecha específica
      $mes = date("m", strtotime($start_date));

      if(array_search($mes, $meses)>-1){
          return true;
      }
     return false;
  }

  /**
   * Busca las habitaciones reservadas dentro del rango de fechas proporcionado. Devuelve un arreglo con esas habitaciones y sus respectivos
   * identificadores como un arreglo.
   * @param type $arrayBookings
   * @param type $arrival_date
   * @param type $departure_date
   * @return array
   */
  public function booking(){

      $arrayBookings = $this->array_bookings;
      $arrival_date = $this->fecha_ini;
      $departure_date = $this->fecha_fin;

      $habitaciones = array();

      foreach ($arrayBookings as $reservacion) {


          if (($reservacion->getFechaIni() < $arrival_date) && ($reservacion->getFechaFin()<$departure_date || $reservacion->getFechaFin()>$departure_date)) {
                if($reservacion->getFechaFin()<$arrival_date==false){
                    echo "<hr>";
                    echo "Booked: ".$reservacion->getId()."<hr>";

                    for($i = 0; $i<count($reservacion->getHabitaciones());$i++){
                          array_push($habitaciones, $reservacion->getHabitacion($i));
                     }


                }
          }else{
              if($reservacion->getFechaIni()>=$arrival_date  && $reservacion->getFechaIni()<=$departure_date){
                  if ($reservacion->getFechaFin()<=$departure_date || $reservacion->getFechaFin()>$departure_date) {
                      echo "<hr>";
                      echo "Booked: ".$reservacion->getId()."<br>";
                      for($i = 0; $i<count($reservacion->getHabitaciones());$i++){
                          array_push($habitaciones, $reservacion->getHabitacion($i));
                     }

                  }
              }
          }

      }


      return $habitaciones;
  }

  /**
   * Función que obtiene una habitación disponible para el huesped.
   * @param type $booked_rooms
   * @param type $all_rooms_by_type
   * @return type
   */
  private function available_room(){

      $booked_rooms = $this->booking();

      $all_rooms = $this->array_tipo_habitaciones;

      $room;
      $bandera= false;


      while($bandera==false){

          $room = $all_rooms[array_rand($all_rooms)];

          $bandera = $this->isBooked($room,$booked_rooms);

      }

      return $room;

  }

  /**
   * Busca que la habitacion que el sistema escogio por defecto, no esté reservada. Si no lo está devolverá un verdadero.
   * @param type $room_look
   * @param type $booked_rooms
   * @return boolean
   */
  private function isBooked($room_look, $booked_rooms){

      $id = $room_look->getId();
      $booked = $booked_rooms;



      foreach ($booked as $value) {

          if ($value->getId()== $id) {
              return false;
          }
      }

     return true;
  }

  /**
   * Reserva una habitacion que esté disponible por el sistema. Añade la habitacion a la reservacion del usuario.
   */
  public function reservarHabitacion(){

      $room = $this->available_room();

      if ($room!=null) {
          $this->addHabitacion($room);
      }

  }

  /**
   * Función que calcula el precio de la reservación de acuerdo al total de habitaciones.
   * @return type
   */
  public function calcularPrecio(){

      $amount=0.0;
      $calculo=0.0;

      foreach ($this->array_habitaciones as $habitacion) {

          if ($this->esTemporadaAlta()) {
              $calculo = $habitacion->calcularPrecio()*1.50;
              $amount = $amount + $calculo;
          }else{
               $calculo = $habitacion->calcularPrecio()*1.50;
              $amount = $amount + $calculo;
          }

      }

     return $amount;

  }

}



 ?>
