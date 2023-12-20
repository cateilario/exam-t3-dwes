<?php
session_start();

require "connection.php";
$conexion = conectarBD();

$selectedCity = 'todas las localidades';

// Implementar sesión que almacene preferencia
if (isset($_SESSION['lastSession'])) {
    $selectedCity = $_SESSION['lastSession'];
}

if (isset($_GET['localidad'])) {
    $selectedCity = $_GET['localidad'];

    // Actualizar localidad según la sesión
    $_SESSION['lastSession'] = $selectedCity;
}

// Obtener taquilla según filtro
$sql = "SELECT localidad, direccion, capacidad, ocupadas FROM puntosderecogida";
if ($selectedCity !== 'todas las localidades') {
    $sql .= " WHERE localidad = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$selectedCity]);
} else {
    $stmt = $conexion->query($sql);
}

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
        <option value="todas las localidades">Todas las localidades</option>
        <option value="Gijón" <?php echo $selectedCity == 'Gijón' ? 'selected' : ''; ?>>Gijón</option>
        <option value="Oviedo" <?php echo $selectedCity == 'Oviedo' ? 'selected' : ''; ?>>Oviedo</option>
        <option value="Avilés" <?php echo $selectedCity == 'Avilés' ? 'selected' : ''; ?>>Avilés</option>
    </select>
    <br>
    <input type="submit" value="Buscar">
    </form>
    <br>

<?php
if ($stmt->rowCount() > 0) {
    echo "<table>
    <tr>
    <th>Localidad</th>
    <th>Dirección</th>
    <th>Capacidad</th>
    <th>Ocupadas</th>
    </tr>";

    // Imprimir filas de tabla

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
        <td>" . htmlspecialchars($row["localidad"]) . 
        "</td>
        <td>" . htmlspecialchars($row["direccion"]) . 
        "</td>
        <td>" . htmlspecialchars($row["capacidad"]) . 
        "</td>
        <td>". htmlspecialchars($row["ocupadas"]) .
        "</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "No hay resultados";
}

?>

<p><a href="nueva_taquilla.php">Crear nueva taquilla</a></p>

</body>

</html>