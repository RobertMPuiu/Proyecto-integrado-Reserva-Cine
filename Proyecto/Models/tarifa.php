<?php
require_once "connectDB.php";
/*
* Clase Tarifa. equivale a la tabla Tarifa de la base de datos.
*/
class Tarifa
{
    private $tipoEntrada;
    private $definicion;
    private $precio;


    public function __construct($tipoEntrada, $definicion, $precio)
    {
        $this->tipoEntrada = $tipoEntrada;
        $this->definicion = $definicion;
        $this->precio = $precio;
    }
    /*
    *   Getters:
    */
    public function getTipoEntrada() {
        return $this->tipoEntrada;
    }

    public function getDefinicion() {
        return $this->definicion;
    }

    public function getPrecio() {
        return $this->precio;
    }
    /*
    *   Metodos:
    */

    /*
    *   Metodo para obtener todas las tarifas existentes
    *
    *   no tiene parametros
    *
    *   Devuelve un array con las tarifas existentes
    */
    public static function getTarifas() {
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT tipoEntrada, definicion, precio FROM Tarifa";
        $consulta = $conexion->query($seleccion);
        $tarifas = [];
        while ($registro = $consulta->fetchObject()) {
          $tarifas[] = new Tarifa($registro->tipoEntrada, $registro->definicion, $registro->precio);
        }
        return $tarifas;    
    }
    /*
    *   Metodo para obtener los precios de las distintas tarifas mediante el tipo de entrada
    *
    *   tiene como parametros:
    *
    *       - $tipo -> el tipo de entrada
    *
    *   Devuelve un array con las salas de las proyecciones con la id y la fecha de esa pelicula 
    */
     public static function obtenerPrecio($tipo) {
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT precio FROM Tarifa WHERE tipoEntrada = '$tipo'";
        $consulta = $conexion->query($seleccion);
        $registro= $consulta->fetchObject();
        $precio = $registro->precio;
        return $precio;    
    }
    /*
    *   Metodo para añadir una tarifa a la base de datos
    *
    *   tiene como parametros:
    *
    *       - $tipo -> el tipo de la tarifa
    *       - $defi -> una breve descripcion de la tarifa
    *       - $prec -> el precio de la tarifa
    *
    *   Inserta un nuevo objeto Tarifa 
    */ 
    public static function subirTarifa($tipo,$defi,$prec) {
        try{
        $conexion = connectDB::connectBD();
        $insercion = "INSERT INTO `Tarifa` (`TipoEntrada`, `Definicion`, `Precio`) VALUES ('".$tipo."', '".$defi."', '".$prec."');";
        $conexion->exec($insercion);
    }catch(PDOException $error){
        echo $error->getMessage();
        }
    }
    /*
    *   Metodo para modificar una tarifa
    *
    *   tiene como parametros:
    *
    *       - $tipo -> el tipo de la tarifa
    *       - $defi -> una breve descripcion de la tarifa
    *       - $prec -> el precio de la tarifa
    *
    *   modifica el objeto Tarifa cuyo tipo de entrada sea el elegido
    */ 
    public static function actualizarTarifa($tipo,$defi,$prec) {
         try{
    $conexion = connectDB::connectBD();
    $actualizar = "UPDATE `Tarifa` SET `Definicion` = '$defi', `Precio` = '$prec' WHERE `Tarifa`.`TipoEntrada` = '$tipo';";
    $conexion->exec($actualizar);
      }catch(PDOException $error){
        echo $error->getMessage();
        }
    }
    /*
    *   Metodo para eliminar una tarifa
    *
    *   tiene como parametros:
    *
    *       - $tipo -> el tipo de la tarifa
    *
    *   elimina un objeto Tarifa que tenga ese tipo de entrada
    */ 
    public static function eliminarTarifa($tipo){
        try{
            $conexion = connectDB::connectBD();
            $actualizar = "DELETE FROM `Tarifa` WHERE  `Tarifa`.`TipoEntrada` = '$tipo';";
            $conexion->exec($actualizar);
        }catch(PDOException $error){
            echo $error->getMessage();
        }
    }
}
?>