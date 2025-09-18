CREATE DATABASE IF NOT EXISTS pokedex;
USE pokedex;

CREATE TABLE IF NOT EXISTS pokemon (
    id INT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    type1 VARCHAR(20) NOT NULL,
    type2 VARCHAR(20),
    hp INT NOT NULL,
    attack INT NOT NULL,
    defense INT NOT NULL,
    image_url VARCHAR(255) NOT NULL
);

INSERT INTO pokemon (id, name, type1, type2, hp, attack, defense, image_url) VALUES
(1, 'Bulbasaur', 'Grass', 'Poison', 45, 49, 49, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png'),
(2, 'Ivysaur', 'Grass', 'Poison', 60, 62, 63, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/2.png'),
(3, 'Venusaur', 'Grass', 'Poison', 80, 82, 83, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/3.png'),
(4, 'Charmander', 'Fire', NULL, 39, 52, 43, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'),
(5, 'Charmeleon', 'Fire', NULL, 58, 64, 58, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/5.png'),
(6, 'Charizard', 'Fire', 'Flying', 78, 84, 78, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/6.png'),
(7, 'Squirtle', 'Water', NULL, 44, 48, 65, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/7.png'),
(8, 'Wartortle', 'Water', NULL, 59, 63, 80, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/8.png'),
(9, 'Blastoise', 'Water', NULL, 79, 83, 100, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/9.png'),
(10, 'Caterpie', 'Bug', NULL, 45, 30, 35, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/10.png'),
(11, 'Metapod', 'Bug', NULL, 50, 20, 55, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/11.png'),
(12, 'Butterfree', 'Bug', 'Flying', 60, 45, 50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/12.png'),
(13, 'Weedle', 'Bug', 'Poison', 40, 35, 30, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/13.png'),
(14, 'Kakuna', 'Bug', 'Poison', 45, 25, 50, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/14.png'),
(15, 'Beedrill', 'Bug', 'Poison', 65, 90, 40, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/15.png'),
(16, 'Pidgey', 'Normal', 'Flying', 40, 45, 40, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/16.png'),
(17, 'Pidgeotto', 'Normal', 'Flying', 63, 60, 55, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/17.png'),
(18, 'Pidgeot', 'Normal', 'Flying', 83, 80, 75, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/18.png'),
(19, 'Rattata', 'Normal', NULL, 30, 56, 35, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/19.png'),
(20, 'Raticate', 'Normal', NULL, 55, 81, 60, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/20.png'),
(25, 'Pikachu', 'Electric', NULL, 35, 55, 40, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png'),
(26, 'Raichu', 'Electric', NULL, 60, 90, 55, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/26.png'),
(150, 'Mewtwo', 'Psychic', NULL, 106, 110, 90, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/150.png'),
(151, 'Mew', 'Psychic', NULL, 100, 100, 100, 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/151.png');
