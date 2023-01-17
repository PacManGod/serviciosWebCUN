<?php
$host = "localhost";
$dbname = "sweb";
$user = "postgres";
$password = "---";

$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

$query=("INSERT INTO users(name,email,password) 
    VALUES('$_REQUEST[usuario]','$_REQUEST[correo]','$_REQUEST[password]')");

$consulta = pg_query($conn, $query);
pg_close();
echo "Registro exitoso";

?>
