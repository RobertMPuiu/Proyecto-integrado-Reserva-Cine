<?php
/*
* Clase Sala. equivale a la tabla Sala de la base de datos.
*/
require_once "connectDB.php";
class Sala
{
    private $idSala;
    private $butacas;
    private $tipo;


    public function __construct($idSala, $butacas, $tipo)
    {
        $this->idSala = $idSala;
        $this->butacas = $butacas;
        $this->tipo = $tipo;
    }
    /*
    *   Getters:
    */
    public function getIdSala() {
        return $this->idSala;
    }

    public function getButacas() {
        return $this->butacas;
    }

    public function getTipo() {
        return $this->tipo;
    }
    /*
    *   Metodos:
    */

    /*
    *   Metodo para obtener las butacas disponibles por ID
    *
    *   tiene como parametro la ID de la sala
    *
    *   Devuelve un array de butacas disponibles con la id de esa sala
    */
    public static function obtenerButacas($id) {
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT butacas FROM `Sala` WHERE `IdSala`='$id'";
        $consulta = $conexion->query($seleccion);
        $butacasDisp = [];
        while ($registro = $consulta->fetchObject()) {
          $butacasDisp[] = $registro->butacas;
        }
        return $butacasDisp;    
      }
}
?>