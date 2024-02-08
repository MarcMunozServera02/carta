<?php
function obtenerInformacionUsuario($idUsuario) {
    // Realiza la conexión a la base de datos (ajusta los valores según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "IAW";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL preparada para obtener información del usuario por ID
    $sql = "SELECT nombre, email, fecha_registro, admin FROM usuarios WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idUsuario);
    $stmt->execute();

    $result = $stmt->get_result();

    // Verifica si se encontraron resultados
    if ($result->num_rows > 0) {
        // Obtiene la información del usuario
        $row = $result->fetch_assoc();
        $usuarioInfo = array(
            'nombre' => $row['nombre'],
            'email' => $row['email'],
            'fecha_registro' => $row['fecha_registro'],
            'admin' => $row['admin']  
        );

        // Cierra la conexión a la base de datos
        $stmt->close();
        $conn->close();

        return $usuarioInfo;
    } else {
        // No se encontró información para el ID proporcionado
        // Cierra la conexión a la base de datos
        $stmt->close();
        $conn->close();
        return null;
    }
}

?>
