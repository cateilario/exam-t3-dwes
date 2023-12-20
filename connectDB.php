<?php
function connectDB(){
    $cadena_conexion = 'mysql:dbname=dwes_t3_examen;host=127.0.0.1';
    $usuario = "root";
    $clave = "";

    try {
        $pdo = new PDO($cadena_conexion, $usuario, $clave);
        return $pdo;
    } catch (PDOException $error) {
        echo "Error conectando a la bd: " . $error->getMessage();
    }
}