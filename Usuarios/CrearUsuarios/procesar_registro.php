<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Función para limpiar y validar la entrada
    function limpiarEntrada($dato) {
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }
    function guardarEnArchivo($usuario, $contrasena, $nombre, $email, $admin) {
        // Define el nombre del archivo donde se almacenarán los datos
        $archivo = 'usuarios/usuarios_registrados.txt';
    
        // Construye la cadena de datos del usuario
        $datosUsuario = "Usuario: $usuario, Contraseña: $contrasena, Nombre: $nombre, Email: $email, Admin: $admin" . PHP_EOL;
        
    
        // Abre el archivo en modo de escritura (añadir al final)
        $archivoHandler = fopen($archivo, 'a');
    
        // Escribe los datos en el archivo
        fwrite($archivoHandler, $datosUsuario);
    
        // Cierra el archivo
        fclose($archivoHandler);
    }
    


    // Obtiene los datos del formulario después de limpiar y validar la entrada
    $admin = isset($_POST["admin"]) ? 1 : 0;
    $usuario = limpiarEntrada($_POST["usuario"]);
    $contrasena = limpiarEntrada($_POST["contrasena"]);
    $nombre = limpiarEntrada($_POST["nombre"]);
    $email = limpiarEntrada($_POST["email"]);


    // Hash de la contraseña utilizando password_hash
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Consulta SQL preparada para insertar un nuevo usuario
    $sql = "INSERT INTO usuarios (usuario, contrasena, nombre, email, admin) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $usuario, $contrasena_hash, $nombre, $email, $admin);

    
    if ($stmt->execute()) {
        echo "Usuario registrado exitosamente.";
        echo "<br><a href='login.php'>Iniciar sesión</a>";
        
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }
    guardarEnArchivo($usuario, $contrasena, $nombre, $email, $admin);
    // Cierra la conexión a la base de datos
    $stmt->close();
    $conn->close();
    

}
?>
