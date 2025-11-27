<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pokedex";

try {
    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar conexão
    if ($conn->connect_error) {
        throw new Exception("Falha na conexão: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    error_log("Database connection error: " . $e->getMessage());
    die("Erro de conexão com o banco de dados. Tente novamente mais tarde.");
}
?>
