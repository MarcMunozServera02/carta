<?php
function validarCredenciales($usuario, $contrasena) {
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

    // Consulta SQL preparada para validar credenciales
    $sql = "SELECT id, nombre, contrasena FROM usuarios WHERE usuario = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $usuario);
    $stmt->execute();

    $result = $stmt->get_result();

    // Verifica si se encontraron resultados
    if ($result->num_rows > 0) {
        // Obtiene la información del usuario
        $row = $result->fetch_assoc();

        // Verifica la contraseña utilizando password_verify
        if (password_verify($contrasena, $row['contrasena'])) {
            $usuarioInfo = array(
                'id' => $row['id'],
                'nombre' => $row['nombre']
            );

            // Cierra la conexión a la base de datos
            $stmt->close();
            $conn->close();

            return $usuarioInfo;
        }
    }

    // Credenciales no válidas o usuario no encontrado
    // Cierra la conexión a la base de datos
    $stmt->close();
    $conn->close();
    return null;
}
?>
