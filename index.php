<?php
// Auto setup na primeira execução
require_once 'auto_setup.php';
autoSetup();

require_once 'config/database.php';

try {
    $sql = "SELECT * FROM pokemon ORDER BY id ASC";
    $result = $conn->query($sql);
    
    if (!$result) {
        throw new Exception("Erro na consulta: " . $conn->error);
    }
} catch (Exception $e) {
    error_log("Pokemon query error: " . $e->getMessage());
    die("Erro ao carregar os Pokémons. Verifique se o banco de dados foi configurado corretamente.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pokédex completa da primeira geração com todos os 151 Pokémons originais">
    <title>Pokédex - Primeira Geração</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://raw.githubusercontent.com">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
</head>
<body>
    <header>
        <h1>Pokédex - Primeira Geração</h1>
        <p>Os 151 Pokémons originais</p>
    </header>

    <main>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar Pokémon..." autocomplete="off" maxlength="50">
        </div>

        <div class="pokemon-grid" id="pokemonGrid">
            <?php if ($result->num_rows > 0): ?>
                <?php while($pokemon = $result->fetch_assoc()): ?>
                    <div class="pokemon-card" data-name="<?php echo strtolower(htmlspecialchars($pokemon['name'], ENT_QUOTES, 'UTF-8')); ?>" data-type="<?php echo strtolower(htmlspecialchars($pokemon['type1'], ENT_QUOTES, 'UTF-8')); ?>">
                        <div class="pokemon-number">#<?php echo str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT); ?></div>
                        <img src="<?php echo htmlspecialchars($pokemon['image_url'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($pokemon['name'], ENT_QUOTES, 'UTF-8'); ?>" class="pokemon-image" loading="lazy">
                        <h3 class="pokemon-name"><?php echo htmlspecialchars($pokemon['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <div class="pokemon-types">
                            <span class="type <?php echo strtolower(htmlspecialchars($pokemon['type1'], ENT_QUOTES, 'UTF-8')); ?>"><?php echo htmlspecialchars($pokemon['type1'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <?php if ($pokemon['type2']): ?>
                                <span class="type <?php echo strtolower(htmlspecialchars($pokemon['type2'], ENT_QUOTES, 'UTF-8')); ?>"><?php echo htmlspecialchars($pokemon['type2'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="pokemon-stats">
                            <div class="stat">
                                <span class="stat-name">HP</span>
                                <span class="stat-value"><?php echo (int)$pokemon['hp']; ?></span>
                            </div>
                            <div class="stat">
                                <span class="stat-name">ATK</span>
                                <span class="stat-value"><?php echo (int)$pokemon['attack']; ?></span>
                            </div>
                            <div class="stat">
                                <span class="stat-name">DEF</span>
                                <span class="stat-value"><?php echo (int)$pokemon['defense']; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhum Pokémon encontrado.</p>
            <?php endif; ?>
        </div>
    </main>

    <script src="js/script.js"></script>
</body>
</html>

<?php $conn->close(); ?>
