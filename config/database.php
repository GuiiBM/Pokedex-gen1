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
    
    $conn->set_charset("utf8");
    
} catch (Exception $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>
