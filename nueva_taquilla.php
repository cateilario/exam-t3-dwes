<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Añadir Nueva Taquilla</title>
</head>
<body>
    <h2>Añadir Nueva Taquilla</h2>
    <form action="nueva_taquilla.php" method="post">
        <label for="localidad">Localidad:</label><br>
        <select id="localidad" name="localidad" required>
            <option value="">Seleccione una localidad</option>
            <option value="Gijón">Gijón</option>
            <option value="Oviedo">Oviedo</option>
            <option value="Avilés">Avilés</option>
        </select><br>
        
        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="direccion" required><br>
        
        <label for="capacidad">Capacidad:</label><br>
        <input type="number" id="capacidad" name="capacidad" min="1" required><br>
        
        <label for="ocupadas">Taquillas Ocupadas:</label><br>
        <input type="number" id="ocupadas" name="ocupadas" min="0" required><br>
        
        <input type="submit" value="Añadir Taquilla">
    </form>
</body>
</html>


<?php
    require_once 'connection.php';
    $conexion = conectarBD();

    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $localidad = $_POST['localidad'];
        $direccion = $_POST['direccion'];
        $capacidad = $_POST['capacidad'];
        $ocupadas = $_POST['ocupadas'];
    
    // Guardar la info en la base de datos.
    $sql = "INSERT INTO puntosderecogida (localidad, direccion, capacidad, ocupadas) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    // Ejecutar la consulta
    $stmt->execute([$localidad, $direccion, $capacidad, $ocupadas]);

    if ($stmt->execute()) {
        echo "Nueva taquilla añadida con éxito.";
    } else {
        echo "Error al añadir la taquilla.";
    }
}

?>