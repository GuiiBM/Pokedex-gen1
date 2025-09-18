<?php
require_once 'PokemonModel.php';
require_once 'PokemonPresenter.php';

class PokemonController {
    private $model;
    private $presenter;
    
    public function __construct($connection) {
        if (!$connection) {
            throw new Exception("Conexão com banco de dados inválida");
        }
        
        $this->model = new PokemonModel($connection);
        $this->presenter = new PokemonPresenter();
    }
    
    public function displayAllPokemon() {
        try {
            $pokemonList = $this->model->getAllPokemon();
            return $this->presenter->formatPokemonGrid($pokemonList);
        } catch (Exception $e) {
            error_log("Erro no PokemonController::displayAllPokemon: " . $e->getMessage());
            return '<p class="error-message">Erro ao carregar Pokémons.</p>';
        }
    }
    
    public function searchPokemon($searchTerm) {
        try {
            // Validar entrada
            if (empty($searchTerm) || strlen($searchTerm) < 2) {
                return $this->displayAllPokemon();
            }
            
            // Sanitizar entrada
            $searchTerm = trim($searchTerm);
            $searchTerm = preg_replace('/[^a-zA-Z0-9\s]/', '', $searchTerm);
            
            $pokemonList = $this->model->searchPokemon($searchTerm);
            return $this->presenter->formatPokemonGrid($pokemonList);
        } catch (Exception $e) {
            error_log("Erro no PokemonController::searchPokemon: " . $e->getMessage());
            return '<p class="error-message">Erro na busca.</p>';
        }
    }
    
    public function getPokemonDetails($id) {
        try {
            // Validar ID
            if (!is_numeric($id) || $id < 1 || $id > 151) {
                return null;
            }
            
            $pokemon = $this->model->getPokemonById((int)$id);
            return $pokemon ? $this->presenter->formatPokemonCard($pokemon) : null;
        } catch (Exception $e) {
            error_log("Erro no PokemonController::getPokemonDetails: " . $e->getMessage());
            return null;
        }
    }
}
