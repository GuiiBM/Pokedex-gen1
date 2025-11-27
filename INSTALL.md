# 🚀 Instalação Automática - Pokédex

## Setup Zero-Config

Este projeto possui **instalação 100% automática**. Não é necessário configurar banco de dados manualmente.

### Passo Único

1. **Copie a pasta** para seu servidor web
2. **Acesse** `http://localhost/Pokedex-gen1/`
3. **Pronto!** ✅

### O que acontece automaticamente:

- ✅ Cria banco `pokedex`
- ✅ Cria tabela `pokemon`
- ✅ Insere todos os 151 Pokémons
- ✅ Configura imagens da PokéAPI
- ✅ Funciona no primeiro acesso

### Requisitos Mínimos

- PHP 7.4+ com mysqli
- MySQL/MariaDB rodando
- Servidor web (Apache/Nginx)

### Para XAMPP

```bash
# Inicie o XAMPP
sudo /opt/lampp/lampp start

# Acesse
http://localhost/Pokedex-gen1/
```

### Para outros servidores

```bash
# Certifique-se que MySQL está rodando
systemctl start mysql

# Acesse seu domínio
http://seudominio.com/Pokedex-gen1/
```

## ✨ Funcionalidades

- 🔍 Busca inteligente por nome/tipo
- 📱 Design responsivo
- ⚡ Performance otimizada
- 🔒 Segurança integrada
- 🎨 Interface clássica Pokémon

**Zero configuração. Zero complicação. Máxima funcionalidade.**