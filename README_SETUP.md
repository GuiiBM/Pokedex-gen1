# 🚀 Setup Rápido - Pokédex

## Pré-requisitos
- XAMPP instalado em `/opt/lampp/`
- PHP com extensão mysqli

## Instalação

### 1. Iniciar XAMPP
```bash
sudo /opt/lampp/lampp start
```

### 2. Verificar Setup
```bash
cd /opt/lampp/htdocs/Pokedex-gen1
php setup_simple.php
```

### 3. Popular Banco (se necessário)
```bash
php populate_database.php
```

### 4. Acessar Aplicação
```
http://localhost/Pokedex-gen1/
```

## Solução de Problemas

### Erro "mysqli not found"
```bash
# Verificar se XAMPP está rodando
sudo /opt/lampp/lampp status

# Reiniciar XAMPP
sudo /opt/lampp/lampp restart
```

### Erro de Conexão MySQL
1. Verifique se o MySQL está ativo no XAMPP
2. Acesse: http://localhost/phpmyadmin/
3. Verifique credenciais em `config/database.php`

### Permissões
```bash
# Dar permissões corretas
sudo chown -R $USER:$USER /opt/lampp/htdocs/Pokedex-gen1/
sudo chmod -R 755 /opt/lampp/htdocs/Pokedex-gen1/
```

## Estrutura Final
```
Pokedex-gen1/
├── index.php          # ✅ Interface principal
├── config/database.php # ✅ Conexão MySQL
├── css/style.css      # ✅ Estilos
├── js/script.js       # ✅ JavaScript
├── setup_simple.php   # ✅ Setup automático
└── populate_database.php # ✅ Popular dados
```

## Funcionalidades
- ✅ 151 Pokémons da 1ª geração
- ✅ Busca por nome e tipo
- ✅ Design responsivo
- ✅ Lazy loading de imagens
- ✅ Sanitização de dados
- ✅ Tratamento de erros