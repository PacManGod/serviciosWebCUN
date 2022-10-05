<?php

include 'database_conexion.php';

session_start();
$email = $_SESSION['email'];
$pass = $_SESSION['password'];

$query = "SELECT name FROM users WHERE email = '$email' AND password = '$pass'";

$result = pg_query($conexion, $query);


echo "Bienvenido ".pg_fetch_result($result, 0, 0);

?>