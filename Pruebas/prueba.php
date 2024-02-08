<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iaw";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
   die("Conexión fallida: " . $conn->connect_error);
}

echo "Esta carpeta no esta en htdocs <br>";
echo "Te has conectado a la base de datos llamada <b>'".$servername."'</b> con el usuario <b>'".$username."'</b> <br><br>";
$sql = "SELECT ccaa_codi,ccaa_nom from comunidades";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
   while($row = $result->fetch_assoc()) {
      if ($row["ccaa_codi"]%2){
         echo " Codigo inpar --> " . $row["ccaa_codi"]. " - Nombre: " . $row["ccaa_nom"]. "<br>";

      }else{
       echo "Codigo par --> " . $row["ccaa_codi"]. " - Nombre: " . $row["ccaa_nom"]. "<br>";
      }
   }
} else {
   echo "0 resultados";
}
$conn->close();
?>

