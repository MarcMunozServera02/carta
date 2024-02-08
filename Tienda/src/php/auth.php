<?php
session_start();

// Función para validar el inicio de sesión
function login($nombre, $contrasena, $conn) {
    $sql = "SELECT * FROM Usuarios WHERE Nombre = '$nombre' AND contraseña = '$contrasena'";
    $result = $conn->query($sql);

    return ($result->num_rows > 0);
}

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contraseña'];

    if (login($nombre, $contrasena, $conn)) {
        $_SESSION['usuario'] = $nombre;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
