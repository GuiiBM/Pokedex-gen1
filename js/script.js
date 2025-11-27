document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const pokemonCards = document.querySelectorAll('.pokemon-card');
    let searchTimeout;

    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const searchTerm = this.value.toLowerCase().trim();
            
            pokemonCards.forEach(card => {
                const pokemonName = card.getAttribute('data-name') || '';
                const pokemonType = card.getAttribute('data-type') || '';
                
                if (pokemonName.includes(searchTerm) || pokemonType.toLowerCase().includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }, 300);
    });

    // Animação de entrada dos cards
    pokemonCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 50);
    });
});
