<?php 

class database{

	public static $DB_HOST = "localhost";
	public static $DB_USER = "root";
	public static $DB_PASS = "";
	public static $DB_NAME = "tienda";

	public function connect(){
		$conn = new mysqli(self::$DB_HOST, self::$DB_USER, self::$DB_PASS, self::$DB_NAME);
		$conn->query("SET NAMES 'uft8'");

		return $conn;
	}

}

?>