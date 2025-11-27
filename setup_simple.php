<?php
// Script de setup simplificado para criar o banco de dados
echo "=== Setup Pokédex ===\n";

// Verificar se as extensões necessárias estão disponíveis
if (!extension_loaded('mysqli')) {
    echo "❌ Extensão mysqli não encontrada.\n";
    echo "Para resolver:\n";
    echo "1. Inicie o XAMPP: sudo /opt/lampp/lampp start\n";
    echo "2. Ou use: php -m | grep mysqli\n";
    exit(1);
}

// Configurações do banco
$servername = "localhost";
$username = "root";
$password = "";

try {
    // Conectar sem especificar banco para criar
    $conn = new mysqli($servername, $username, $password);
    
    if ($conn->connect_error) {
        throw new Exception("Falha na conexão: " . $conn->connect_error);
    }
    
    echo "✅ Conectado ao MySQL\n";
    
    // Criar banco de dados
    $sql = "CREATE DATABASE IF NOT EXISTS pokedex";
    if ($conn->query($sql) === TRUE) {
        echo "✅ Banco 'pokedex' criado/verificado\n";
    } else {
        throw new Exception("Erro ao criar banco: " . $conn->error);
    }
    
    // Selecionar banco
    $conn->select_db("pokedex");
    
    // Criar tabela
    $sql = "CREATE TABLE IF NOT EXISTS pokemon (
        id INT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        type1 VARCHAR(20) NOT NULL,
        type2 VARCHAR(20),
        hp INT NOT NULL,
        attack INT NOT NULL,
        defense INT NOT NULL,
        image_url VARCHAR(255) NOT NULL
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "✅ Tabela 'pokemon' criada/verificada\n";
    } else {
        throw new Exception("Erro ao criar tabela: " . $conn->error);
    }
    
    // Verificar se já tem dados
    $result = $conn->query("SELECT COUNT(*) as count FROM pokemon");
    $row = $result->fetch_assoc();
    
    if ($row['count'] > 0) {
        echo "✅ Banco já possui {$row['count']} Pokémons\n";
        echo "Para repopular, delete os dados primeiro: TRUNCATE TABLE pokemon;\n";
    } else {
        echo "ℹ️  Banco vazio. Execute populate_database.php para adicionar os Pokémons\n";
    }
    
    $conn->close();
    echo "\n🎉 Setup concluído! Acesse: http://localhost/Pokedex-gen1/\n";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    echo "\nSoluções:\n";
    echo "1. Verifique se o MySQL está rodando\n";
    echo "2. Inicie o XAMPP: sudo /opt/lampp/lampp start\n";
    echo "3. Verifique as credenciais em config/database.php\n";
}
?>