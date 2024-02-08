<?php
session_start();

$idiomaActual = isset($_SESSION['idioma']) ? $_SESSION['idioma'] : 'espanol';
// Obtener el idioma actual para las categorías
$idiomaCategorias = isset($_SESSION['idiomaCategorias']) ? $_SESSION['idiomaCategorias'] : 'espanol';

// Obtener el idioma actual para los productos
$idiomaProductos = isset($_SESSION['idiomaProductos']) ? $_SESSION['idiomaProductos'] : 'espanol';

// Incluir el archivo de conexión a la base de datos
include('db.php');

// Conectar a la base de datos
$conn = conectarBD();

// Verificar si se ha enviado un formulario para cambiar el idioma de las categorías y productos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idioma'])) {
    $idiomaSeleccionado = $_POST['idioma'];
    $_SESSION['idiomaCategorias'] = $idiomaSeleccionado;
    $_SESSION['idiomaProductos'] = $idiomaSeleccionado;
}

// Intentar obtener categorías
$categoriasSql = "SELECT C.Id, DDC.Descripción AS Nombre_Categoria
                  FROM Categorias AS C
                  JOIN Descripcion_De_Categorias AS DDC ON C.Id = DDC.Id_Categorias
                  JOIN Idioma AS I ON DDC.Id_Idioma = I.Id AND I.Descripción = '$idiomaCategorias'";

$categoriasResult = $conn->query($categoriasSql);

// Verificar si la consulta de categorías se ejecutó correctamente
if ($categoriasResult !== false) {
    ?>

    <!DOCTYPE html>
    <html lang="<?php echo $idiomaCategorias; ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listado de Productos</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <?php include 'header.php'; ?>

        <!-- Formulario para cambiar el idioma de las categorías y productos -->
        <div style="text-align: right; padding: 10px;">
            <form method="post">
                <select name="idioma" onchange="this.form.submit()">
                    <option value="espanol" <?php echo ($idiomaCategorias == 'espanol') ? 'selected' : ''; ?>>Español</option>
                    <option value="aleman" <?php echo ($idiomaCategorias == 'aleman') ? 'selected' : ''; ?>>Alemán</option>
                    <option value="catalan" <?php echo ($idiomaCategorias == 'catalan') ? 'selected' : ''; ?>>Catalán</option>
                    <option value="frances" <?php echo ($idiomaCategorias == 'frances') ? 'selected' : ''; ?>>Francés</option>
                    <option value="ingles" <?php echo ($idiomaCategorias == 'ingles') ? 'selected' : ''; ?>>Inglés</option>
                    <!-- Añadir más opciones según los idiomas que tengas -->
                </select>
            </form>
        </div>

       <main>
<?php
// Verificar si la variable $categoriasResult está definida y no es null


// Resto del código...

// Verificar si la variable $categoriasResult está definida y no es null
if (isset($categoriasResult) && $categoriasResult !== null) {
    // Mostrar categorías
    while ($categoria = $categoriasResult->fetch_assoc()) {
        echo "<section>";
        echo "<h2>{$categoria['Nombre_Categoria']}</h2>";

        // Consulta SQL para obtener los productos de la categoría actual
        $categoriaId = $categoria['Id'];
        $productosSql = "SELECT P.Id, DDP.Descripción AS Nombre_Producto, P.Precio, P.Disponible
                        FROM Producto AS P
                        JOIN Categorias AS C ON P.Id_categoria = C.Id
                        JOIN Descripcion_De_Producto AS DDP ON P.Id = DDP.Id_Producto
                        JOIN Idioma AS I ON DDP.Id_Idioma = I.Id AND I.Descripción = '$idiomaProductos'
                        WHERE C.Id = $categoriaId";
        $productosResult = $conn->query($productosSql);

        // Verificar si la consulta de productos se ejecutó correctamente
        if ($productosResult !== false) {
            // Mostrar productos de la categoría
            echo "<ul>";
            while ($producto = $productosResult->fetch_assoc()) {
                $disponibilidad = ($producto['Disponible']) ? 'Disponible' : 'No Disponible';
                
                // Aplicar tachado si el producto no está disponible
                $nombreProducto = ($producto['Disponible']) ? $producto['Nombre_Producto'] : "<del>{$producto['Nombre_Producto']}";

                echo "<li>{$nombreProducto} - Precio: {$producto['Precio']}€ </li></del>";
            }
            echo "</ul>";
        } else {
            echo "<p>Error al obtener productos de la categoría.</p>";
        }

        echo "</section>";
    }
} else {
    echo "<p>Error al obtener categorías.</p>";
}
?>

</main>

    </body>
    </html>

    <?php
} else {
    // Mostrar mensaje de error específico para la consulta de categorías
    echo "<p>Error al obtener categorías: " . $conn->error . "</p>";
}

// Cerrar la conexión
$conn->close();
?>
