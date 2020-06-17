<?php
/*
* Clase Proyeccion. equivale a la tabla Proyeccion de la base de datos.
*/
require_once "connectDB.php";
class Proyeccion
{
    private $idProyeccion;
    private $fecha;
    private $hora;
    private $disponibles;
    private $idSala;
    private $idPelicula;
    private $tipoEntrada;

    public function __construct($idProyeccion, $fecha, $hora, $disponibles,$idSala, $idPelicula, $tipoEntrada)
    {
        $this->idProyeccion = $idProyeccion;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->disponibles = $disponibles;
        $this->idSala = $idSala;
        $this->idPelicula = $idPelicula;
        $this->tipoEntrada= $tipoEntrada;
    }
    /*
    *   Getters:
    */
    public function getIdProyeccion() {
        return $this->idProyeccion;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHora() {
        return $this->hora;
    }

    public function getDisponibles() {
        return $this->disponibles;
    }

     public function getSala() {
        return $this->idSala;
    }

    public function getIdPelicula() {
        return $this->idPelicula;
    }

    public function getTipoEntrada() {
        return $this->tipoEntrada;
    }

    /*
    *   Metodos:
    */

    /*
    *   Metodo para obtener las horas ocupadas de las distintas proyecciones con ese mismo ID
    *
    *   tiene como parametro la ID de la pelicula
    *
    *   Devuelve un array con las las horas ocupadas con la id de esa pelicula
    */
    public static function getHorasOcupadas($pelicula) {
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT hora FROM Proyeccion WHERE idPelicula='".$pelicula."' ORDER BY hora";
        $consulta = $conexion->query($seleccion);
        $horario = [];
        while ($registro = $consulta->fetchObject()) {
           $horario[] = $registro->hora;
        }
        return $horario;    
      }
    /*
    *   Metodo para obtener las fechas de las distintas proyecciones con ese mismo ID
    *
    *   tiene como parametro la ID de la pelicula
    *
    *   Devuelve un array con las fechas de las proyecciones con la id de esa pelicula
    */
    public static function getFechas($pelicula){
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT DISTINCT fecha FROM Proyeccion WHERE idPelicula ='$pelicula'";
        $consulta = $conexion->query($seleccion);
        $fechas = [];
        while ($registro = $consulta->fetchObject()) {
           $fechas[] = $registro->fecha;
        }
        return $fechas;   
    }
    /*
    *   Metodo para obtener las salas de las distintas proyecciones con ese mismo ID y esa misma Fecha
    *
    *   tiene como parametros:
    *
    *       - $pelicula -> la id de la pelicula
    *       - $fechaProyeccion -> la fecha de la proyeccion
    *
    *   Devuelve un array con las salas de las proyecciones con la id y la fecha de esa pelicula 
    */
    public static function getSalas($pelicula,$fechaProyeccion){
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT DISTINCT idSala FROM Proyeccion WHERE idPelicula='$pelicula' AND fecha='$fechaProyeccion'";
        $consulta = $conexion->query($seleccion);
        $salas = [];
        while ($registro = $consulta->fetchObject()) {
           $salas[] = $registro->idSala;
        }
        return $salas;   
    }
    /*
    *   Metodo para obtener las horas de las distintas proyecciones con ese mismo ID, esa misma fecha, y esa misma sala
    *
    *   tiene como parametros:
    *
    *       - $pelicula -> la id de la pelicula
    *       - $fechaProyeccion -> la fecha de la proyeccion
    *       - $salaProyeccion -> la sala de la proyeccion
    *
    *   Devuelve un array con las horas de las proyecciones con la id , la fecha y la sala de esa pelicula 
    */
    public static function getHoras($pelicula,$fechaProyeccion,$salaProyeccion){
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT hora FROM Proyeccion WHERE idPelicula='$pelicula' AND fecha='$fechaProyeccion' AND idSala='$salaProyeccion'";
        $consulta = $conexion->query($seleccion);
        $horas = [];
        while ($registro = $consulta->fetchObject()) {
           $horas[] = $registro->hora;
        }
        return $horas;   
    }
    /*
    *   Metodo para obtener la proyeccion que se va a reservar
    *
    *   tiene como parametros:
    *
    *       - $pelicula -> la id de la pelicula
    *       - $fechaProyeccion -> la fecha de la proyeccion
    *       - $salaProyeccion -> la sala de la proyeccion
    *       - $hora -> la hora de la proyeccion
    *
    *   Devuelve un objeto con la proyección 
    */
    public static function obtenerProyeccionesReservar($pelicula,$fechaProyeccion,$salaProyeccion,$hora){
        $conexion = connectDB::connectBD();
        $seleccion = "SELECT idProyeccion,fecha,hora,disponibles,idSala,idPelicula,tipoEntrada FROM Proyeccion WHERE idPelicula='$pelicula' AND fecha='$fechaProyeccion' AND idSala='$salaProyeccion' AND hora='$hora'";
        $consulta = $conexion->query($seleccion);
        $registro= $consulta->fetchObject();
        $proyecciones =  new Proyeccion($registro->idProyeccion,$registro->fecha, $registro->hora, $registro->disponibles,$registro->idSala, $registro->idPelicula, $registro->tipoEntrada);
        return $proyecciones;   
    }
    /*
    *   Metodo para obtener las proyecciones ocupadas
    *
    *   tiene como parametros:
    *
    *       - $fecha -> la fecha de la proyeccion
    *       - $sala -> la sala de la proyeccion
    *       - $hora -> la hora de la proyeccion
    *
    *   Devuelve un array con las horas que estan ocupadas 
    */
    public static function proyeccionesNoDisponibles($fec,$sala,$hora){
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT hora FROM Proyeccion WHERE fecha = '$fec' AND idSala='$sala' AND hora='$hora'";
        $consulta = $conexion->query($seleccion);
        $horas = [];
        while ($registro = $consulta->fetchObject()) {
           $horas[] = $registro->hora;
        }
        return $horas;   
    }
    /*
    *   Metodo para añadir una proyeccion a la base de datos
    *
    *   tiene como parametros:
    *
    *       - $fec -> la fecha de la proyeccion
    *       - $hor -> la hora de la proyeccion
    *       - $dis -> os asientos disponibles de la proyeccion
    *       - $idS -> la sala de la proyeccion
    *       - $idP -> la id de la pelicula de la proyeccion
    *       - $tip -> la tarifa de la proyeccion
    *
    *   Inserta un nuevo objeto Proyeccion 
    */
    public static function subirProyeccion($fec,$hor,$dis,$idS,$idP,$tip) {
        try{
        $conexion = connectDB::connectBD();
        $insercion = "INSERT INTO `Proyeccion` (`IdProyeccion`, `Fecha`, `Hora`, `Disponibles`, `IdSala`, `IdPelicula`, `TipoEntrada`) VALUES (NULL, '$fec', '$hor', '$dis', '$idS', '$idP', '$tip');";
        $conexion->exec($insercion);
    }catch(PDOException $error){
        echo $error->getMessage();
        }
    }
    /*
    *   Metodo para obtener todas las proyecciones existentes
    *
    *   no tiene parametros
    *
    *   devuelve un array con todos los objetos Proyeccion que existen
    */
    public static function obtenerProyecciones(){
        $conexion = connectDB::connectBD();
        $seleccion = "SELECT idProyeccion,fecha,hora,disponibles,idSala,idPelicula,tipoEntrada FROM Proyeccion";
        $consulta = $conexion->query($seleccion);
        $proyecciones = [];
        while ($registro = $consulta->fetchObject()) {
           $proyecciones[] = new Proyeccion($registro->idProyeccion,$registro->fecha, $registro->hora, $registro->disponibles,$registro->idSala, $registro->idPelicula, $registro->tipoEntrada);
        }
        return $proyecciones; 
    }
    /*
    *   Metodo para actualizar una proyeccion mediante la ID
    *
    *   tiene como parametros:
    *
    *       - $fec -> la fecha de la proyeccion
    *       - $hor -> la hora de la proyeccion
    *       - $dis -> os asientos disponibles de la proyeccion
    *       - $idS -> la sala de la proyeccion
    *       - $idP -> la id de la pelicula de la proyeccion
    *       - $tip -> la tarifa de la proyeccion
    *       - $id -> la ID de la proyeccion
    *
    *   actualiza la proyeccion con la id seleccionada
    */
    public static function actualizarProyeccion($fec,$hor,$dis,$idS,$idP,$tip,$id) {
         try{
    $conexion = connectDB::connectBD();
    $actualizar = "UPDATE `Proyeccion` SET `Fecha` = '$fec', `Hora` = '$hor', `Disponibles` = '$dis', `IdSala` = '$idS', `IdPelicula` = '$idP', `TipoEntrada` = '$tip' WHERE `Proyeccion`.`IdProyeccion` = '$id';";
    $conexion->exec($actualizar);
      }catch(PDOException $error){
        echo $error->getMessage();
        }
    }
    /*
    *   Metodo para actualizar los asientos disponibles de una proyeccion mediante la ID
    *
    *   tiene como parametros:
    *
    *       - $asientos -> los asientos modificados
    *       - $id -> la ID de la proyeccion
    *
    *   actualiza la proyeccion con la id seleccionada
    */
    public static function actualizarAsientos($asientos,$id){
         try{
        $conexion = connectDB::connectBD();
        $actualizar = "UPDATE `Proyeccion` SET `Disponibles` = '$asientos' WHERE `Proyeccion`.`IdProyeccion` = '$id';";
         $conexion->exec($actualizar);
         }catch(PDOException $error){
        echo $error->getMessage();
        }
    }
    /*
    *   Metodo para eliminar una proyeccion mediante la ID
    *
    *   tiene como parametros:
    *
    *       - $id -> la ID de la proyeccion
    *
    *   elimina la proyeccion con la id seleccionada
    */
    public static function eliminarProyeccion($id){
        try{
            $conexion = connectDB::connectBD();
            $actualizar = "DELETE FROM `Proyeccion` WHERE  `Proyeccion`.`IdProyeccion` = '$id';";
            $conexion->exec($actualizar);
        }catch(PDOException $error){
            echo $error->getMessage();
        }
    }
}
?>