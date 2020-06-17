<?php
/*
* En este fichero se establece la conexión con la base de datos
*/
abstract class connectDB {

	private static $server = '127.0.0.1';
	private static $db = 'ReservaPeliculas';
	private static $user = 'root';
	private static $password = 'robert';
	private static $port=3306;

	public static function connectBD() {
		try {
			$connection = new PDO("mysql:host=".self::$server.";dbname=".self::$db.";port=".self::$port.";charset=utf8", self::$user, self::$password);
		} 
		catch (PDOException $e) {
			echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
			die ("Error: " . $e->getMessage());
		}
		return $connection;
	}
}
?>