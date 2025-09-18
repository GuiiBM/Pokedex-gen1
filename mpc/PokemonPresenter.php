<?php
class PokemonPresenter {
    
    private function sanitize($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
    
    public function formatPokemonCard($pokemon) {
        if (!$pokemon) return '';
        
        $number = str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT);
        $name = $this->sanitize($pokemon['name']);
        $type1 = $this->sanitize($pokemon['type1']);
        $type2 = $pokemon['type2'] ? $this->sanitize($pokemon['type2']) : '';
        $imageUrl = $this->sanitize($pokemon['image_url']);
        
        $type2Html = $type2 ? 
            "<span class='type " . strtolower($type2) . "'>{$type2}</span>" : '';
        
        return "
        <div class='pokemon-card' data-name='" . strtolower($name) . "' data-type='{$type1}'>
            <div class='pokemon-number'>#{$number}</div>
            <img src='{$imageUrl}' alt='{$name}' class='pokemon-image' loading='lazy'>
            <h3 class='pokemon-name'>{$name}</h3>
            <div class='pokemon-types'>
                <span class='type " . strtolower($type1) . "'>{$type1}</span>
                {$type2Html}
            </div>
            <div class='pokemon-stats'>
                <div class='stat'>
                    <span class='stat-name'>HP</span>
                    <span class='stat-value'>{$pokemon['hp']}</span>
                </div>
                <div class='stat'>
                    <span class='stat-name'>ATK</span>
                    <span class='stat-value'>{$pokemon['attack']}</span>
                </div>
                <div class='stat'>
                    <span class='stat-name'>DEF</span>
                    <span class='stat-value'>{$pokemon['defense']}</span>
                </div>
            </div>
        </div>";
    }
    
    public function formatPokemonGrid($pokemonList) {
        if (!$pokemonList) {
            return '<p class="error-message">Erro ao carregar Pokémons.</p>';
        }
        
        $html = '';
        while($pokemon = $pokemonList->fetch_assoc()) {
            $html .= $this->formatPokemonCard($pokemon);
        }
        
        return $html ?: '<p class="no-results">Nenhum Pokémon encontrado.</p>';
    }
}
