<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweb";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión Fallida: " . $conn->connect_error);
}

if (empty($_POST)) {
    die("No se enviaron datos desde el formulario.");
}

// Formulario de inicio de sesión
$correo = $_POST['IEmail'];
$contraseña = $_POST['IPass'];

inicioSesion($correo, $contraseña);

function inicioSesion($correo, $contraseña)
{
    global $conn;
    $sql = "SELECT * FROM Usuarios WHERE CorreoElectronico = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        // Usuario encontrado, verifica la contraseña
        $row = $result->fetch_assoc();
        $contraseñaAlmacenada = $row['Contrasena'];

        if (password_verify($contraseña, $contraseñaAlmacenada)) {
            // Contraseña válida, inicia la sesión del usuario
            session_start();
            $_SESSION['usuario_id'] = $row['ID'];

            $sql = "UPDATE Usuarios SET UltimoInicioSesion = NOW() WHERE ID = " . $_SESSION['usuario_id'];
            $conn->query($sql);

            // Redirige al usuario a la página deseada después del inicio de sesión
            header("Location: /ServiciosWebCUN/pages/hud.html?idPersona=" . urlencode($_SESSION['usuario_id']));
            exit();
        } else {
            header("Location: /ServiciosWebCUN/pages/iniciar.html");
        }
    } else {
        echo "Usuario no encontrado";
    }

    $conn->close();
}
?>