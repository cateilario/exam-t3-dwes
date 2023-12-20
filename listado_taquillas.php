<?php
require "connection.php";
$conexion = conectarBD();

?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Taquillator</title>
</head>

<body>
    <form action="" method="get">
    <select name="localidad">
        <option value="">Todas las localidades</option>
        <option value="Gijón">Gijón</option>
        <option value="Oviedo">Oviedo</option>
        <option value="Avilés">Avilés</option>
    </select>
        <input type="submit" value="Buscar">
    </form>

</body>

</html>



<?php
if (isset($_GET['localidad'])) {

    ////////////////////////////////////////////
    // TODO 2: Obtener taquillas según filtro //
    ////////////////////////////////////////////
    

    $resultado = $conexion->query($sql);
    if ($resultado->rowCount() > 0) {
        echo "<table><tr><th>Localidad</th><th>Dirección</th><th>Capacidad</th><th>Ocupadas</th></tr>";
        /////////////////////////////////////
        // TODO 3: Imprimir filas de tabla //
        /////////////////////////////////////
        echo "</table>";
    } else {
        echo "No hay resultados";
    }
}
?>