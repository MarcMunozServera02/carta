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



    include 'header.php';
    echo '<h1>Panel de Control</h1>';
    echo '<p>Bienvenido, ' . $usuario_info['nombre'] . '!</p>';
    if (isset($usuario_info['admin']) && $usuario_info['admin'] == 1) {
 
        echo '<a href="registro.php">Crear usuario</a>'. '</p>';
        
    }    
    echo '<a href="logout.php">Cerrar sesión</a>';
    include 'footer.php';

?>