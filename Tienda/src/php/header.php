<?php
// Iniciar la sesión
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


// Consulta SQL para obtener la información del restaurante
$restauranteSql = "SELECT Nombre, Dirección, Logo, Eslogan FROM Restaurante LIMIT 1";
$result = $conn->query($restauranteSql);

if ($result->num_rows > 0) {
    $restaurante = $result->fetch_assoc();
} else {
    // Manejar el caso en que no se encuentre información del restaurante
    $restaurante = array('Nombre' => 'Nombre del Restaurante', 'Direccion' => 'Dirección del Restaurante', 'Logo' => 'ruta/default/logo.png', 'Eslogan' => 'Eslogan del Restaurante');
}


?>

<header>
    <div id="logo">
        <img src="<?php echo $restaurante['Logo']; ?>" alt="">
    </div>
    <div id="restaurant-info">
        <h1><?php echo $restaurante['Nombre']; ?></h1>
        <p><?php echo $restaurante['Dirección']; ?></p>
        <p><?php echo $restaurante['Eslogan']; ?></p>
    </div>
    <?php
    // Verificar si el usuario ha iniciado sesión
    if (isset($_SESSION['usuario'])) {
        echo '<p>Bienvenido, ' . $_SESSION['usuario'] . '</p>';
        echo '<a href="cerrar_sesion.php">Cerrar Sesión</a>';
    } else {
        echo '<a id="login-button" href="login.php">Iniciar Sesión</a>';
    }
    ?>
</header>
