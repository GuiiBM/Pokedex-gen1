<?php
require_once 'config/database.php';

try {
    $sql = "SELECT * FROM pokemon ORDER BY id ASC";
    $result = $conn->query($sql);
    
    if (!$result) {
        throw new Exception("Erro na consulta: " . $conn->error);
    }
} catch (Exception $e) {
    die("Erro: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex - Primeira Geração</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Pokédex - Primeira Geração</h1>
        <p>Os 151 Pokémons originais</p>
    </header>

    <main>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar Pokémon...">
        </div>

        <div class="pokemon-grid" id="pokemonGrid">
            <?php if ($result->num_rows > 0): ?>
                <?php while($pokemon = $result->fetch_assoc()): ?>
                    <div class="pokemon-card" data-name="<?php echo strtolower($pokemon['name']); ?>" data-type="<?php echo $pokemon['type1']; ?>">
                        <div class="pokemon-number">#<?php echo str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT); ?></div>
                        <img src="<?php echo $pokemon['image_url']; ?>" alt="<?php echo $pokemon['name']; ?>" class="pokemon-image">
                        <h3 class="pokemon-name"><?php echo $pokemon['name']; ?></h3>
                        <div class="pokemon-types">
                            <span class="type <?php echo strtolower($pokemon['type1']); ?>"><?php echo $pokemon['type1']; ?></span>
                            <?php if ($pokemon['type2']): ?>
                                <span class="type <?php echo strtolower($pokemon['type2']); ?>"><?php echo $pokemon['type2']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="pokemon-stats">
                            <div class="stat">
                                <span class="stat-name">HP</span>
                                <span class="stat-value"><?php echo $pokemon['hp']; ?></span>
                            </div>
                            <div class="stat">
                                <span class="stat-name">ATK</span>
                                <span class="stat-value"><?php echo $pokemon['attack']; ?></span>
                            </div>
                            <div class="stat">
                                <span class="stat-name">DEF</span>
                                <span class="stat-value"><?php echo $pokemon['defense']; ?></span>
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
