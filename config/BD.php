<?php
require_once __DIR__ . '/../vendor/autoload.php'; //Con dir utiliza siempre la ruta de aqui sin importar desde donde se este llamando todo

use Dotenv\Dotenv;

// Cargar las variables de entorno desde el archivo .env
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
try {
    // Acceder a los datos privados usando $_ENV
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_NAME'];
    $user = $_ENV['DB_USER'];
    $pass = $_ENV['DB_PASS'];

    // Configurar la conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    
    // Configurar manejo de errores en modo excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    error_log($e->getMessage()); // Guarda el error real en los logs del servidor
    die("Error crítico: No se pudo conectar a la base de datos.");
}

