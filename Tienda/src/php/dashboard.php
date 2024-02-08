<?php

include('auth.php');

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// Resto del código para la página de dashboard...
?>
