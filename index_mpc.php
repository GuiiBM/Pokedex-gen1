<?php
require_once 'config/database.php';
require_once 'mpc/PokemonController.php';

$controller = new PokemonController($conn);
$pokemonGrid = $controller->displayAllPokemon();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex MPC - Primeira Geração</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Pokédex MPC - Primeira Geração</h1>
        <p>Arquitetura Model-Presenter-Controller</p>
    </header>

    <main>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar Pokémon...">
        </div>

        <div class="pokemon-grid" id="pokemonGrid">
            <?php echo $pokemonGrid; ?>
        </div>
    </main>

    <script src="js/script.js"></script>
</body>
</html>

<?php $conn->close(); ?>
