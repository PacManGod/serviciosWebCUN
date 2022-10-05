<?php

require 'database_conexion.php';

session_start();
$email = $_POST['email'];
$pass = $_POST['password'];

$query = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";

$result = pg_query($conexion, $query);
$filas = pg_num_rows($result);

if ($filas > 0) {
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $pass;
    header("location: bienvenido.php");
} else {
    echo "Error en la autenticacion";
}

?>