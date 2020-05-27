<?php 
/*
if (! isset($_SESSION['usuario'])) {
	die('ACCESO DENEGADO');
}*/

header("Content-type: application/json; chartset=UTF-8");

require("conexion.php");

$get = $REQUEST['categoria'];

$result=$pdo->query("SELECT nombre FROM categoria WHERE nombre LIKE '%" . $get . "%' ORDER BY nombre");
$array = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)){
	$array[] = $row['nombre'];
}

echo(json_encode($array,JSON_PRETTY_PRINT));

 ?>