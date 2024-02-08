<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Número Recibido</title>
</head>
<body>

    <h1>Número Recibido</h1>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "iaw";
    
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    
    if ($conn->connect_error) {
       die("Conexión fallida: " . $conn->connect_error);
    }
        // Recibe el número a través de $_GET
        $numero = isset($_GET['numero']) ? $_GET['numero'] : 'Número no especificado';

        // Puedes usar el número recibido en tu lógica de PHP
    echo "<p>Número ingresado: $numero</p>";
    $sql = "SELECT ccaa_nom from comunidades where ccaa_codi = $numero";
    $result = $conn->query($sql);
    
    
    if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
             echo "La comunidad que quieres es " . $row["ccaa_nom"]. "<br>";
       }
    } else {
       echo "0 resultados";
    }
    $conn->close();

    ?>

    <a href="index.html">Volver a la página anterior</a>

</body>
</html>