<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <?php     
    session_start(); // Inicia la sesión en el panel de control

    // Verifica si el usuario no está autenticado
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: index.php"); // Redirige a la página de inicio si no está autenticado
        exit();
    }
    
    // Obtén información del usuario desde la base de datos
    $usuario_id = $_SESSION['usuario_id'];
    include 'obtenerInformacionUsuario.php'; 
    $usuario_info = obtenerInformacionUsuario($usuario_id);
    
    
    if (isset($usuario_info['admin']) && $usuario_info['admin'] == 1) {
       echo  "<h1>Registro de Usuario</h1>";

    echo "<form action='procesar_registro.php' method='POST'>";
    echo     "<label for='usuario'>Usuario:</label>";
    echo     "<input type='text' name='usuario' required>";
    echo     "<label for='contrasena'>Contraseña:</label>";
    echo     "<input type='password' name='contrasena' required>";
    echo     "<label for='nombre'>Nombre:</label>";
    echo     "<input type='text' name='nombre' required>";
    echo     "<label for='email'>Correo Electrónico:</label>";
    echo     "<input type='email' name='email' required>";
    echo     "<label for='admin'>¿Admin?</label>";
    echo     "<input type='checkbox' name='admin' value='1'>";
    echo     "<button type='submit'>Registrarse</button>";
    echo "</form>";
 
 
}else{
    echo "<h1>No eres admin</h1>";
};    
    ;?>
    

</body>
</html>

