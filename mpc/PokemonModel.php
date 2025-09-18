<?php
class PokemonModel {
    private $conn;
    
    public function __construct($connection) {
        $this->conn = $connection;
    }
    
    public function getAllPokemon() {
        try {
            $sql = "SELECT * FROM pokemon ORDER BY id ASC";
            $result = $this->conn->query($sql);
            
            if (!$result) {
                throw new Exception("Erro na consulta: " . $this->conn->error);
            }
            
            return $result;
        } catch (Exception $e) {
            error_log("Erro no PokemonModel::getAllPokemon: " . $e->getMessage());
            return false;
        }
    }
    
    public function searchPokemon($term) {
        try {
            $sql = "SELECT * FROM pokemon WHERE name LIKE ? OR type1 LIKE ? OR type2 LIKE ? ORDER BY id ASC";
            $stmt = $this->conn->prepare($sql);
            
            if (!$stmt) {
                throw new Exception("Erro na preparação: " . $this->conn->error);
            }
            
            $searchTerm = "%$term%";
            $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
            $stmt->execute();
            
            return $stmt->get_result();
        } catch (Exception $e) {
            error_log("Erro no PokemonModel::searchPokemon: " . $e->getMessage());
            return false;
        }
    }
    
    public function getPokemonById($id) {
        try {
            $sql = "SELECT * FROM pokemon WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            
            if (!$stmt) {
                throw new Exception("Erro na preparação: " . $this->conn->error);
            }
            
            $stmt->bind_param("i", $id);
            $stmt->execute();
            
            $result = $stmt->get_result();
            return $result ? $result->fetch_assoc() : null;
        } catch (Exception $e) {
            error_log("Erro no PokemonModel::getPokemonById: " . $e->getMessage());
            return null;
        }
    }
}
