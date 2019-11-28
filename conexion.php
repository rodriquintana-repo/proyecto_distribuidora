<?php
//                                      CONEXION A LA BASE DE DATOS                     //
$pass = "";
$user = "root";
$name = "ventas";

class connection {
    private $conn;

    public function __construct()
    {
        $name = "ventas";
        $user = "root";
        $pass = "";
        $this->conn = new PDO('mysql:host=localhost;dbname=' . $name, $user, $pass);
        $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function get_connection()
    {
        return $this->conn;
    }

}

try{
	$base_de_datos = new PDO('mysql:host=localhost;dbname=' . $name, $user, $pass);
	 $base_de_datos->query("set names utf8;");
    $base_de_datos->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base_de_datos->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}catch(Exception $e){
	echo "Ocurrió algo con la base de datos: " . $e->getMessage();
}
?>