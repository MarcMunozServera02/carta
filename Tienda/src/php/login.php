<?php
session_start(); // Inicia la sesión en la página de inicio de sesión

// Verifica si el usuario ya está autenticado
if(isset($_SESSION['usuario_id'])) {
    header("Location: dashboard.php"); // Redirige al panel de control si ya está autenticado
    exit();
}
include 'validarCredenciales.php';
// Verifica si se ha enviado el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aquí debes validar las credenciales del usuario desde la base de datos
    $usuario_valido = validarCredenciales($_POST['usuario'], $_POST['contrasena']);

    if ($usuario_valido) {
        $_SESSION['usuario_id'] = $usuario_valido['id'];
        header("Location: dashboard.php"); // Redirige al panel de control después del inicio de sesión
        exit();
    } else {
        $error = "Credenciales incorrectas";
    }
}

// Resto del contenido de la página de inicio de sesión
include 'header.php';
?>
<h1>Iniciar Sesión</h1>
<?php if (isset($error)) { echo "<p>$error</p>"; } ?>
<form method="post" action="">
    <label for="usuario">usuario:</label>
    <input type="text" name="usuario" required><br>
    <label for="contrasena">contrasena:</label>
    <input type="password" name="contrasena" required><br>
    <input type="submit" value="Iniciar sesión">
</form>

