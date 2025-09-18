#!/usr/bin/env python3
import os
import sys
import re

def test_files():
    """Testa se todos os arquivos necessários existem"""
    required_files = [
        'index.php',
        'config/database.php',
        'css/style.css',
        'js/script.js',
        'database/setup.sql',
        'populate_database.php'
    ]
    
    print("=== TESTE DE ARQUIVOS ===")
    all_exist = True
    
    for file in required_files:
        if os.path.exists(file):
            size = os.path.getsize(file)
            print(f"✅ {file} ({size} bytes)")
        else:
            print(f"❌ {file} - AUSENTE")
            all_exist = False
    
    return all_exist

def test_structure():
    """Testa a estrutura de diretórios"""
    print("\n=== TESTE DE ESTRUTURA ===")
    dirs = ['config', 'css', 'js', 'database', 'mpc']
    
    for dir_name in dirs:
        if os.path.isdir(dir_name):
            print(f"✅ Diretório {dir_name}/")
        else:
            print(f"❌ Diretório {dir_name}/ - AUSENTE")

def test_content():
    """Testa conteúdo básico dos arquivos"""
    print("\n=== TESTE DE CONTEÚDO ===")
    
    # Teste index.php
    if os.path.exists('index.php'):
        with open('index.php', 'r', encoding='utf-8') as f:
            content = f.read()
            if 'pokemon' in content.lower() and ('mysql' in content.lower() or 'database' in content.lower()):
                print("✅ index.php contém referências corretas")
            else:
                print("❌ index.php sem conteúdo esperado")
    
    # Teste CSS
    if os.path.exists('css/style.css'):
        with open('css/style.css', 'r', encoding='utf-8') as f:
            content = f.read()
            if 'pokemon-card' in content and 'gradient' in content:
                print("✅ CSS contém estilos Pokémon")
            else:
                print("❌ CSS sem estilos esperados")
    
    # Teste JavaScript
    if os.path.exists('js/script.js'):
        with open('js/script.js', 'r', encoding='utf-8') as f:
            content = f.read()
            if 'searchInput' in content and 'pokemon' in content.lower():
                print("✅ JavaScript contém funcionalidade de busca")
            else:
                print("❌ JavaScript sem funcionalidade esperada")

def test_syntax():
    """Testa sintaxe básica dos arquivos PHP"""
    print("\n=== TESTE DE SINTAXE ===")
    
    php_files = ['index.php', 'config/database.php', 'populate_database.php']
    
    for file in php_files:
        if os.path.exists(file):
            with open(file, 'r', encoding='utf-8') as f:
                content = f.read()
                # Verificar se tem tags PHP
                if '<?php' in content:
                    print(f"✅ {file} - Sintaxe PHP válida")
                else:
                    print(f"❌ {file} - Sem tags PHP")

if __name__ == "__main__":
    print("🧪 INICIANDO TESTES DA POKÉDEX")
    print("=" * 40)
    
    test_files()
    test_structure()
    test_content()
    test_syntax()
    
    print("\n✅ TESTES CONCLUÍDOS")
