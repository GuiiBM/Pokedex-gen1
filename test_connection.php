<?php
require_once 'config/database.php';

try {
    $result = $conn->query("SELECT COUNT(*) as total FROM pokemon");
    $row = $result->fetch_assoc();
    echo "✅ Conexão OK! Total de Pokémons: " . $row['total'] . "\n";
    
    $sample = $conn->query("SELECT id, name, type1 FROM pokemon LIMIT 5");
    echo "\n📋 Amostra:\n";
    while($pokemon = $sample->fetch_assoc()) {
        echo "#{$pokemon['id']} - {$pokemon['name']} ({$pokemon['type1']})\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}
?>