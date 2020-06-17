<?php
/*
* Clase Reserva. equivale a la tabla Reserva de la base de datos.
*/
require_once "connectDB.php";
class Reserva
{
    private $idReserva;
    private $pelicula;
    private $sala;
    private $fechaReserva;
    private $horaReserva;
    private $asientos;
    private $idProyeccion;
    private $idUsuario;
    private $precio;

    public function __construct($idReserva,$pelicula, $sala, $fechaReserva, $horaReserva, $asientos, $idProyeccion, $idUsuario,$precio)
    {
        $this->idReserva = $idReserva;
        $this->pelicula = $pelicula;
        $this->sala = $sala;
        $this->fechaReserva = $fechaReserva;
        $this->horaReserva = $horaReserva;
        $this->asientos = $asientos;
        $this->idProyeccion= $idProyeccion;
        $this->idUsuario= $idUsuario;
        $this->precio=$precio;
    }
    /*
    *   Getters:
    */
    public function getIdReserva() {
        return $this->idReserva;
    }
    public function getPelicula() {
        return $this->pelicula;
    }
    public function getSala() {
        return $this->sala;
    }

    public function getFechaReserva() {
        return $this->fechaReserva;
    }

    public function getHoraReserva() {
        return $this->horaReserva;
    }

    public function getAsientos() {
        return $this->asientos;
    }

    public function getIdProyeccion() {
        return $this->idProyeccion;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

     public function getPrecio() {
        return $this->precio;
    }
    /*
    *   Metodos:
    */

    /*
    *   Metodo para añadir una Reserva a la base de datos
    *
    *   tiene como parametros:
    *
    *       - $peli -> el nombre de la pelicula
    *       - $salaR -> la sala de la reserva
    *       - $fechaR -> los fecha de la reserva
    *       - $horaR -> la hora de la reserva
    *       - $butacas -> los asientos reservados
    *       - $idPr -> la id de la proyeccion
    *       - $idUsu -> el id del usuario
    *       - $prec -> el precio total de la reserva
    *
    *   Inserta un nuevo objeto reserva 
    */
    public static function crearReserva($peli,$salaR,$fechaR,$horaR,$butacas,$idPr,$idUsu,$prec) {
        try{
        $conexion = connectDB::connectBD();
        $insercion = "INSERT INTO `Reserva` (`IdReserva`, `Pelicula`, `Sala`, `FechaReserva`, `HoraReserva`, `Asientos`, `IdProyeccion`, `IdUsuario`, `Precio`) VALUES (NULL, '$peli', '$salaR', '$fechaR', '$horaR', '$butacas', '$idPr', '$idUsu', '$prec');";
        $conexion->exec($insercion);
    }catch(PDOException $error){
        echo $error->getMessage();
        }
    }

    /*
    *   Metodo para obtener las reservas relacionadas con el ID del usuario
    *
    *   tiene como parametro la id del usuario
    *
    *   Devuelve un array con las reservas existentes de ese usuario
    */
     public static function getReservasByIdUsuario($id) {
        $conexion = connectDB::connectBD();
        $seleccion = "SELECT idReserva, pelicula, sala, fechaReserva, horaReserva, asientos, idProyeccion, idUsuario, precio FROM Reserva WHERE idUsuario='$id'";
        $consulta = $conexion->query($seleccion);
        $reservas = [];
        while ($registro = $consulta->fetchObject()) {
          $reservas[] = new Reserva($registro->idReserva, $registro->pelicula, $registro->sala, $registro->fechaReserva, $registro->horaReserva, $registro->asientos, $registro->idProyeccion, $registro->idUsuario, $registro->precio);

        } 
        return $reservas;    
      }
}
?>