document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const pokemonCards = document.querySelectorAll('.pokemon-card');
    const canvas = document.getElementById('diceCanvas');
    let searchTimeout;
    let scene, camera, renderer, dice, isRolling = false;

    // Inicializar Three.js
    function initDice() {
        scene = new THREE.Scene();
        camera = new THREE.PerspectiveCamera(75, 1, 0.1, 1000);
        renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
        renderer.setSize(60, 60);
        renderer.shadowMap.enabled = true;
        renderer.shadowMap.type = THREE.PCFSoftShadowMap;

        // Dado simples que funciona
        const geometry = new THREE.IcosahedronGeometry(0.8, 0);
        const material = new THREE.MeshPhongMaterial({ 
            color: 0x6c5ce7,
            shininess: 100
        });
        
        dice = new THREE.Mesh(geometry, material);
        dice.castShadow = true;
        scene.add(dice);
        
        // Adicionar números como sprites
        const numbers = [1, 20, 12, 8, 15, 3, 7, 11, 4, 19];
        const positions = [
            [0, 0.9, 0], [0.5, 0.7, 0.3], [-0.5, 0.7, 0.3], [0.3, 0.5, -0.7],
            [-0.3, 0.5, -0.7], [0.8, 0, 0.3], [-0.8, 0, 0.3], [0, -0.5, 0.8],
            [0.5, -0.7, -0.3], [-0.5, -0.7, -0.3]
        ];
        
        numbers.forEach((num, i) => {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = 64;
            canvas.height = 64;
            
            context.fillStyle = '#ffffff';
            context.font = 'bold 20px Arial';
            context.textAlign = 'center';
            context.textBaseline = 'middle';
            context.fillText(num.toString(), 32, 32);
            
            const texture = new THREE.CanvasTexture(canvas);
            const spriteMaterial = new THREE.SpriteMaterial({ map: texture });
            const sprite = new THREE.Sprite(spriteMaterial);
            
            if (positions[i]) {
                sprite.position.set(positions[i][0], positions[i][1], positions[i][2]);
                sprite.scale.set(0.2, 0.2, 0.2);
                dice.add(sprite);
            }
        });

        // Iluminação melhorada
        const ambientLight = new THREE.AmbientLight(0x404040, 0.8);
        scene.add(ambientLight);
        
        const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
        directionalLight.position.set(3, 3, 2);
        directionalLight.castShadow = true;
        scene.add(directionalLight);
        
        const pointLight = new THREE.PointLight(0x74b9ff, 0.5, 10);
        pointLight.position.set(-2, 2, 2);
        scene.add(pointLight);

        camera.position.z = 2.5;
        
        // Animação contínua
        function animate() {
            requestAnimationFrame(animate);
            if (!isRolling) {
                dice.rotation.x += 0.008;
                dice.rotation.y += 0.012;
                dice.rotation.z += 0.004;
            }
            renderer.render(scene, camera);
        }
        animate();
    }
    
    initDice();

    // Busca de Pokémon
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

    // Dado aleatório
    canvas.addEventListener('click', function() {
        if (isRolling) return;
        
        isRolling = true;
        canvas.classList.add('rolling');
        
        // Animação do d20
        const startTime = Date.now();
        const duration = 2500;
        const initialRotation = { x: dice.rotation.x, y: dice.rotation.y, z: dice.rotation.z };
        const targetRotation = {
            x: initialRotation.x + Math.PI * 8 + Math.random() * Math.PI * 3,
            y: initialRotation.y + Math.PI * 10 + Math.random() * Math.PI * 3,
            z: initialRotation.z + Math.PI * 6 + Math.random() * Math.PI * 3
        };
        
        function rollAnimation() {
            const elapsed = Date.now() - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easeOut = 1 - Math.pow(1 - progress, 3);
            
            dice.rotation.x = initialRotation.x + (targetRotation.x - initialRotation.x) * easeOut;
            dice.rotation.y = initialRotation.y + (targetRotation.y - initialRotation.y) * easeOut;
            dice.rotation.z = initialRotation.z + (targetRotation.z - initialRotation.z) * easeOut;
            
            if (progress < 1) {
                requestAnimationFrame(rollAnimation);
            } else {
                // Escolher Pokémon aleatório
                const randomId = Math.floor(Math.random() * 151) + 1;
                const allCards = Array.from(pokemonCards);
                const targetCard = allCards[randomId - 1];
                
                if (targetCard) {
                    const pokemonName = targetCard.querySelector('.pokemon-name').textContent;
                    searchInput.value = pokemonName;
                    
                    const event = new Event('input', { bubbles: true });
                    searchInput.dispatchEvent(event);
                    
                    setTimeout(() => {
                        targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        targetCard.style.transform = 'scale(1.05)';
                        setTimeout(() => {
                            targetCard.style.transform = '';
                        }, 500);
                    }, 300);
                }
                
                canvas.classList.remove('rolling');
                isRolling = false;
            }
        }
        
        rollAnimation();
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
