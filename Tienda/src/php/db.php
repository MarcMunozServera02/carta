<?php

function conectarBD() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "iaw";

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
    }

    return $conn;
}


