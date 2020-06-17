<?php
/*
* Clase pelicula. equivale a la tabla Pelicula de la base de datos.
*/
require_once "connectDB.php";
class Pelicula
{
    private $idPelicula;
    private $portada;
    private $titulo;
    private $pais;
    private $genero;
    private $duracion;
    private $calificacion;
    private $fechaEstreno;
    private $director;
    private $reparto;
    private $sinopsis;
    private $visible;
    private $trailer;

    public function __construct($idPelicula, $portada, $titulo, $pais,$genero, $duracion, $calificacion, $fechaEstreno, $director, $reparto, $sinopsis,$visible,$trailer)
    {
        $this->idPelicula = $idPelicula;
        $this->portada = $portada;
        $this->titulo = $titulo;
        $this->pais = $pais;
        $this->genero = $genero;
        $this->duracion = $duracion;
        $this->calificacion= $calificacion;
        $this->fechaEstreno= $fechaEstreno;
        $this->director= $director;
        $this->reparto= $reparto;
        $this->sinopsis= $sinopsis;
        $this->visible=$visible;
        $this->trailer=$trailer;
    }
    /*
    *   Getters:
    */
    public function getIdPelicula() {
        return $this->idPelicula;
    }

    public function getPortada() {
        return $this->portada;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getPais() {
        return $this->pais;
    }

     public function getGenero() {
        return $this->genero;
    }

    public function getDuracion() {
        return $this->duracion;
    }

    public function getCalificacion() {
        return $this->calificacion;
    }

    public function getFechaEstreno() {
        return $this->fechaEstreno;
    }

    public function getDirector() {
        return $this->director;
    }

    public function getReparto() {
        return $this->reparto;
    }

    public function getSinopsis() {
        return $this->sinopsis;
    }

    public function getVisible() {
        return $this->visible;
    }
    public function getTrailer() {
        return $this->trailer;
    }

    /*
    *   Metodos:
    */

    /*
    *   Metodo para obtener todos los campos de todas las películas existentes
    *
    *   No se le pasan parametros
    *
    *   Devuelve un array de objetos Pelicula con todas las peliculas
    */
    public static function getCartelera() {
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT idPelicula, portada, titulo, pais, genero, duracion,  calificacion, fechaEstreno, director,reparto, sinopsis, visible, trailer FROM Pelicula";
        $consulta = $conexion->query($seleccion);
        $cartelera = [];
        while ($registro = $consulta->fetchObject()) {
           $cartelera[] = new Pelicula($registro->idPelicula,$registro->portada, $registro->titulo, $registro->pais,$registro->genero, $registro->duracion, $registro->calificacion,$registro->fechaEstreno, $registro->director,$registro->reparto,$registro->sinopsis,$registro->visible, $registro->trailer);
        }
        return $cartelera;    
    }
    /*
    *   Metodo para comprobar si existe una pelicula.
    *
    *   Se le pasa como parametro el titulo de la película que se quiere comprobar
    *
    *   Devuelve verdadero si existe, de lo contrario devuelve false.
    */
    public static function existePelicula($nuevoTitulo) {
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT titulo FROM Pelicula WHERE '$nuevoTitulo' = titulo";
        $consulta = $conexion->query($seleccion);
        $titulos = [];
        while ($registro = $consulta->fetchObject()) {
           $titulos[] = $registro->titulo;
        }
        if($titulos.length()>0){
            return true;
        }else{
            return false;
        }  
    }
    /*
    *   Metodo para obtener la pelicula por el titulo.
    *
    *   Se le pasa como parametro el titulo de la película
    *
    *   Devuelve un array con un unico elemento, que es un objeto pelicula
    */
    public static function getPeliculaByTitulo($nuevoTitulo) {
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT idPelicula, portada, titulo, pais, genero, duracion,  calificacion, fechaEstreno, director,reparto, sinopsis, visible, trailer FROM Pelicula WHERE titulo = '".$nuevoTitulo."'";
        $consulta = $conexion->query($seleccion);
        $cartelera = [];
        while ($registro = $consulta->fetchObject()) {
           $cartelera[] = new Pelicula($registro->idPelicula,$registro->portada, $registro->titulo, $registro->pais,$registro->genero, $registro->duracion, $registro->calificacion,$registro->fechaEstreno, $registro->director,$registro->reparto,$registro->sinopsis,$registro->visible , $registro->trailer);
        }
        return $cartelera;    
    }
    /*
    *   Metodo para obtener la id de la pelicula por el titulo.
    *
    *   Se le pasa como parametro el titulo de la película
    *
    *   Devuelve un array con un unico elemento, que es la id de la pelicula
    */
       public static function getIDPeliculaByTitulo($nuevoTitulo) {
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT idPelicula FROM Pelicula WHERE titulo = '".$nuevoTitulo."'";
        $consulta = $conexion->query($seleccion);
        $cartelera = [];
        while ($registro = $consulta->fetchObject()) {
           $cartelera[] = $registro->idPelicula;
        }
        return $cartelera;    
    }
    /*
    *   Metodo para obtener la pelicula por la ID.
    *
    *   Se le pasa como parametro la ID de la pelicula
    *
    *   Devuelve un array con un unico elemento, que es un objeto pelicula
    */
    public static function getPeliculaByID($id) {
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT idPelicula, portada, titulo, pais, genero, duracion,  calificacion, fechaEstreno, director,reparto, sinopsis, visible, trailer FROM Pelicula WHERE idPelicula = '$id'";
        $consulta = $conexion->query($seleccion);
        $cartelera = [];
        while ($registro = $consulta->fetchObject()) {
           $cartelera[] = new Pelicula($registro->idPelicula,$registro->portada, $registro->titulo, $registro->pais,$registro->genero, $registro->duracion, $registro->calificacion,$registro->fechaEstreno, $registro->director,$registro->reparto,$registro->sinopsis,$registro->visible , $registro->trailer);
        }
        return $cartelera;    
    }
    /*
    *   Metodo para insertar una pelicula.
    *
    *   Se le pasa como parametros:
    *
    *       - enlace de la imagen de portada de la pelicula
    *       - Titulo de la pelicula
    *       - Pais del que proviene
    *       - Género de la pelicula
    *       - Duración de la pelicula en minutos
    *       - Calificación de la pelicula
    *       - Fecha de estreno
    *       - Nombre del director
    *       - Reparto de la pelicula
    *       - Sinopsis de la pelicula
    *       - Enlace del trailer de la pelicula
    *
    *   La sentencia ejecuta un insert con los datos introducidos por un formulario
    */
    public static function subirPelicula($por,$tit,$pai,$gen,$dur,$cal,$fes,$dir,$rep,$sin,$tra) {
        try{
        $conexion = connectDB::connectBD();
        $insercion = "INSERT INTO `Pelicula` (`IdPelicula`, `Portada`, `Titulo`, `Pais`, `Genero`, `Duracion`, `Calificacion`, `FechaEstreno`, `Director`, `Reparto`, `Sinopsis`, `Visible`, `Trailer`) VALUES (NULL, '".$por."', '".$tit."', '".$pai."', '".$gen."', ".$dur.", '".$cal."', '".$fes."', '".$dir."', '".$rep."', '".$sin."', 'no','".$tra."');";
        $conexion->exec($insercion);
    }catch(PDOException $error){
        echo $error->getMessage();
        }
    }
    /*
    *   Metodo para eliminar la pelicula por la ID.
    *
    *   Se le pasa como parametro la ID de la pelicula
    *
    *    La sentencia ejecuta un delete con los datos introducidos por un formulario
    */
    public static function eliminarPelicula($tit){
        try{
        $conexion = connectDB::connectBD();
        $eliminacion = "DELETE FROM `Pelicula` WHERE `Pelicula`.`IdPelicula` = ".$tit." ";
        $conexion->exec($eliminacion);
    }catch(PDOException $error){
        echo $error->getMessage();
        }
    }
    /*
    *   Metodo para actualizar una pelicula mediante la ID.
    *
    *   Se le pasa como parametros:
    *
    *       - enlace de la imagen de portada de la pelicula
    *       - Titulo de la pelicula
    *       - Pais del que proviene
    *       - Género de la pelicula
    *       - Duración de la pelicula en minutos
    *       - Calificación de la pelicula
    *       - Fecha de estreno
    *       - Nombre del director
    *       - Reparto de la pelicula
    *       - Sinopsis de la pelicula
    *       - Enlace del trailer de la pelicula
    *       - ID de la pelicula
    *
    *   La sentencia ejecuta un update con los datos introducidos por un formulario
    */
    public static function actualizarPelicula($por,$tit,$pai,$gen,$dur,$cal,$fes,$dir,$rep,$sin,$tra,$idP){
        try{
            $conexion = ConnectDB::connectBD();
            $actualizacion = "UPDATE `Pelicula` SET `Portada`='$por', `Titulo`='$tit', `Pais`='$pai', `Genero`='$gen', `Duracion`='$dur', `Calificacion`='$cal', `FechaEstreno`='$fes', `Director`='$dir', `Reparto`='$rep', `Sinopsis`='$sin', `Trailer` = '$tra' WHERE `Pelicula`.`IdPelicula` = '$idP';";
            $conexion->exec($actualizacion);
        }catch(PDOException $error){
            echo $error->getMessage();
        }
    }
    /*
    *   Metodo para obtener las peliculas que tienen el campo visible = 'no'.
    *
    *   No se le pasa ningun parametro
    *
    *   Devuelve un array con todos los objetos Pelicula que cumplan la norma de visible = 'no'.
    */
    public static function obtenerPeliculasNoVisibles(){
        $conexion = ConnectDB::connectBD();
        $seleccion = "SELECT idPelicula, portada, titulo, pais, genero, duracion,  calificacion, fechaEstreno, director,reparto, sinopsis, visible, trailer FROM Pelicula WHERE visible = 'no'";
        $consulta = $conexion->query($seleccion);
        $cartelera = [];
        while ($registro = $consulta->fetchObject()) {
           $cartelera[] = new Pelicula($registro->idPelicula,$registro->portada, $registro->titulo, $registro->pais,$registro->genero, $registro->duracion, $registro->calificacion,$registro->fechaEstreno, $registro->director,$registro->reparto,$registro->sinopsis,$registro->visible, $registro->trailer);
        }
        return $cartelera;   
    }
    /*
    *   Actualizar visibilidad mediante la ID.
    *
    *   Se le pasa como parametro la ID de la pelicula
    *
    *   Actualiza el campo Visible a 'si';
    */
    public static function establecerPeliculaVisible($id){
        try{
            $conexion = ConnectDB::connectBD();
            $actualizacion = "UPDATE `Pelicula` SET `Visible` = 'si' WHERE `Pelicula`.`IdPelicula` = '$id';";
            $conexion->exec($actualizacion);
        }catch(PDOException $error){
            echo $error->getMessage();
        }
    }
    /*
    *   Actualizar visibilidad mediante la ID.
    *
    *   Se le pasa como parametro la ID de la pelicula
    *
    *   Actualiza el campo Visible a 'no';
    */
    public static function establecerPeliculaNoVisible($id){
        try{
            $conexion = ConnectDB::connectBD();
            $actualizacion = "UPDATE `Pelicula` SET `Visible`='no' WHERE `Pelicula`.`IdPelicula` = '$id';";
            $conexion->exec($actualizacion);
        }catch(PDOException $error){
            echo $error->getMessage();
        }
    }
}
?>