<?php
/*
* Clase Tarifa. equivale a la tabla Tarifa de la base de datos.
*/
require_once "connectDB.php";
class Usuario
{
    private $idUsuario;
    private $nombre;
    private $apellidos;
    private $dni;
    private $correoElectronico;
    private $contrasenia;
    private $ciudad;
    private $direccion;
    private $codPostal;
    private $admin;

    public function __construct($idUsuario, $nombre, $apellidos, $dni, $correoElectronico, $contrasenia, $ciudad, $direccion, $codPostal, $admin)
    {
        $this->idUsuario = $idUsuario;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->dni = $dni;
        $this->correoElectronico = $correoElectronico;
        $this->contrasenia= $contrasenia;
        $this->ciudad= $ciudad;
        $this->direccion= $direccion;
        $this->codPostal= $codPostal;
        $this->admin= $admin;
    }
    /*
    *   Getters:
    */
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getCorreoElectronico() {
        return $this->correoElectronico;
    }

    public function getContrasenia() {
        return $this->contrasenia;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getCodPostal() {
        return $this->codPostal;
    }

    public function getAdmin() {
        return $this->admin;
    }

    /*
    *   Metodos:
    */

    /*
    *   Metodo para obtener todos los usuarios existentes
    *
    *   no tiene parametros
    *
    *   Devuelve un array con los usuarios existentes
    */
     public static function getUsuarios() {
        $conexion = connectDB::connectDB();
        $seleccion = "SELECT idUsuario, nombre, apellidos, dni, correoElectronico, contrasenia, ciudad, direccion, codPostal, admin FROM Usuario";
        $consulta = $conexion->query($seleccion);
        $usuarios = [];
        while ($registro = $consulta->fetchObject()) {
          $usuarios[] = new Usuario($registro->idUsuario, $registro->nombre, $registro->apellidos, $registro->dni, $registro->correoElectronico, $registro->contrasenia, $registro->ciudad, $registro->direccion, $registro->codPostal, $registro->admin);

        } 
        return $usuarios;    
      }
    /*
    *   Metodo para añadir un usuario a la base de datos
    *
    *   tiene como parametros:
    *
    *       - $nom -> el nombre del usuario
    *       - $ape -> los apellidos del usuario
    *       - $xdni -> el DNI del usuario
    *       - $cel -> el correo electronico del usuario
    *       - $pwd -> la contraseña establecida
    *       - $ciu -> la ciudad del usuario
    *       - $dir -> la dirección del usuario
    *       - $cpos -> el codigo postal del usuario
    *
    *   Inserta un nuevo objeto Usuario 
    */
    public static function crearUsuario($nom,$ape,$xdni,$cel,$pwd,$ciu,$dir,$cpos) {
        try{
        $conexion = connectDB::connectBD();
        $insercion = "INSERT INTO `Usuario` (`IdUsuario`, `Nombre`, `Apellidos`, `DNI`, `CorreoElectronico`, `Contrasenia`, `Ciudad`, `Direccion`, `CodPostal`, `Admin`) VALUES (NULL, '".$nom."', '".$ape."', '".$xdni."', '".$cel."', '".$pwd."', '".$ciu."', '".$dir."', ".$cpos.", 'no');";
        $conexion->exec($insercion);
    }catch(PDOException $error){
        echo $error->getMessage();
        }
    }
    /*
    *   Metodo para comprobar que un usuario existe
    *
    *   no tiene parametros
    *
    *   Devuelve un array con el correo, la contraseña, el nombre y si es admin o no.
    */
    public static function comprobarUsuarios(){
    $conexion = connectDB::connectBD();
    $seleccion = "SELECT correoElectronico,contrasenia,nombre,admin,idUsuario FROM Usuario WHERE correoElectronico='".$_POST['correoElectronico']."' AND contrasenia='".$_POST['contrasenia']. "'";
    foreach ($conexion->query($seleccion) as $row) {
        $usuario = $row['correoElectronico'];
        $contra = $row['contrasenia'];
        $nombre = $row['nombre'];
        $admin = $row['admin'];
        $id = $row['idUsuario'];
        $login = [$usuario,$contra,$nombre,$admin,$id];
    }
      return $login;   
  }
    /*
    *   Metodo para comprobar que un usuario recien registrado existe
    *
    *   no tiene parametros
    *
    *   Devuelve un array con el correo, la contraseña, el nombre y si es admin o no.
    */
    public static function comprobarUsuariosRegistro(){
    $conexion = connectDB::connectBD();
    $seleccion = "SELECT correoElectronico,contrasenia,nombre,admin,idUsuario FROM Usuario WHERE correoElectronico='".$_POST['email']."' AND contrasenia='".$_POST['password']. "'";
    foreach ($conexion->query($seleccion) as $row) {
        $usuario = $row['correoElectronico'];
        $contra = $row['contrasenia'];
        $nombre = $row['nombre'];
        $admin = $row['admin'];
        $id = $row['idUsuario'];
        $login = [$usuario,$contra,$nombre,$admin,$id];
    }
      return $login;   
  }
    /*
    *   Metodo para comprobar que el correo no exista
    *
    *   tiene como parametro el correo introducido al registrarse
    *
    *   Devuelve un objeto con el correoElectronico en caso de que exista
    */
  public static function existeCorreo($correo){
    $conexion = connectDB::connectBD();
    $seleccion = "SELECT correoElectronico FROM Usuario WHERE correoElectronico='$correo'";
    $consulta = $conexion->query($seleccion);
    $registro = $consulta->fetchObject();
    $correoE = $registro->correoElectronico;    
    return $correoE;  
  }
}
?>