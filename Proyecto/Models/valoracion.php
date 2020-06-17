<?php
/*
* Clase Tarifa. equivale a la tabla Tarifa de la base de datos.
*/
require_once "connectDB.php";
class Valoracion
{
    private $valoracion;
    private $idUsuario;
    private $idPelicula;

    public function __construct($valoracion, $idUsuario, $idPelicula)
    {
        $this->valoracion = $valoracion;
        $this->idUsuario = $idUsuario;
        $this->idPelicula = $idPelicula;
    }
    /*
    *   Getters:
    */
    public function getValoracion() {
        return $this->valoracion;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getIdPelicula() {
        return $this->idPelicula;
    }
    /*
    *   Metodos:
    */

    /*
    *   Metodo para obtener las valoraciones existentes
    *
    *   no tiene parametros
    *
    *   Devuelve un array con las valoraciones existentes
    */
    public static function obtenerValoracion() {
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT valoracion, idUsuario, idPelicula FROM Valoracion";
        $consulta = $conexion->query($seleccion);
        $valor = [];
        while ($registro = $consulta->fetchObject()) {
           $valor[] = new Valoracion($registro->valoracion,$registro->idUsuario, $registro->idPelicula);
        }
        return $valor;    
      }
    /*
    *   Metodo para añadir una valoracion
    *
    *   parametros:
    *
    *       - $val -> la valoración para introducir
    *       - $idU -> el id del usuario que valora
    *       - $idP -> la id de la pelicula valorada
    *
    *   Inserta una valoración
    */
    public static function subirValoracion($val,$idU,$idP) {
        try{
        $conexion = connectDB::connectBD();
        $insercion = "INSERT INTO `Valoracion` (`Valoracion`, `IdUsuario`, `IdPelicula`) VALUES ('$val', '$idU', $idP);";
        $conexion->exec($insercion);
    }catch(PDOException $error){
        echo $error->getMessage();
        }
    }
}
?>