// App.js - JavaScript pour le site d'adoption de chiens

document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des fonctionnalités
    initSearchForm();
    initDogCards();
    initMobileMenu();
});

// Gestion du formulaire de recherche
function initSearchForm() {
    const searchForm = document.querySelector('.search-form form');
    if (!searchForm) return;

    // Recherche en temps réel (optionnel)
    const inputs = searchForm.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('input', debounce(performSearch, 500));
    });

    // Soumission du formulaire
    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        performSearch();
    });
}

// Fonction de recherche
function performSearch() {
    const form = document.querySelector('.search-form form');
    if (!form) return;

    const formData = new FormData(form);
    const params = new URLSearchParams();
    
    for (let [key, value] of formData.entries()) {
        if (value.trim() !== '') {
            params.append(key, value);
        }
    }

    // Redirection vers la page de recherche avec les paramètres
    window.location.href = '/search?' + params.toString();
}

// Fonction debounce pour éviter trop de requêtes
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Gestion des cartes de chiens
function initDogCards() {
    const dogCards = document.querySelectorAll('.dog-card');
    
    dogCards.forEach(card => {
        // Animation au survol
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });

        // Clic sur l'image pour voir plus de détails
        const img = card.querySelector('img');
        if (img) {
            img.addEventListener('click', function() {
                showDogDetails(card);
            });
        }
    });
}

// Fonction pour contacter à propos d'un chien
function contactAboutDog(dogId, dogName = null) {
    // Si le nom n'est pas fourni, essayer de le récupérer depuis la carte
    if (!dogName) {
        dogName = document.querySelector(`[data-dog-id="${dogId}"]`)?.querySelector('h3')?.textContent || 'ce chien';
    }
    
    if (confirm(`Voulez-vous contacter le refuge à propos de ${dogName} ?`)) {
        // Fermer le modal de détails d'abord
        closeModal();
        
        // Afficher l'alerte avec le numéro de téléphone
        alert(`🐕 Contactez le refuge au 01 23 45 67 89 pour plus d'informations sur ${dogName} !\n\nNous sommes ouverts du lundi au vendredi de 9h à 18h.`);
    }
}

// Fonction pour afficher les détails d'un chien
function showDogDetails(dogId) {
    // Trouver la carte du chien correspondante
    const dogCard = document.querySelector(`[data-dog-id="${dogId}"]`);
    if (!dogCard) {
        console.error('Carte du chien non trouvée');
        return;
    }
    
    const name = dogCard.querySelector('h3').textContent;
    const breed = dogCard.querySelector('.breed').textContent;
    const details = dogCard.querySelector('.details').textContent;
    const description = dogCard.querySelector('.description')?.textContent || 'Aucune description disponible.';
    const image = dogCard.querySelector('img').src;
    
    const modal = createModal(`
        <div class="dog-details-modal">
            <div class="dog-details-header">
                <img src="${image}" alt="${name}" class="dog-detail-image">
                <div class="dog-details-info">
                    <h2>${name}</h2>
                    <p class="breed">${breed}</p>
                    <p class="details">${details}</p>
                </div>
            </div>
            
            <div class="dog-details-content">
                <h3>À propos de ${name}</h3>
                <p class="description">${description}</p>
                
                <div class="dog-characteristics">
                    <h4>Caractéristiques</h4>
                    <div class="characteristics-grid">
                        <div class="characteristic">
                            <span class="label">Race:</span>
                            <span class="value">${breed}</span>
                        </div>
                        <div class="characteristic">
                            <span class="label">Âge:</span>
                            <span class="value">${details.split(' • ')[0]}</span>
                        </div>
                        <div class="characteristic">
                            <span class="label">Sexe:</span>
                            <span class="value">${details.split(' • ')[1]}</span>
                        </div>
                        <div class="characteristic">
                            <span class="label">Taille:</span>
                            <span class="value">${details.split(' • ')[2]}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-actions">
                <button class="btn btn-primary" onclick="contactAboutDog(${dogId}, '${name}')">Contacter le refuge</button>
                <button class="btn btn-secondary" onclick="closeModal()">Fermer</button>
            </div>
        </div>
    `);
    
    document.body.appendChild(modal);
}


// Création d'un modal
function createModal(content) {
    const modal = document.createElement('div');
    modal.className = 'modal-overlay';
    modal.innerHTML = `
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            ${content}
        </div>
    `;
    
    // Styles pour le modal
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    `;
    
    const modalContent = modal.querySelector('.modal-content');
    modalContent.style.cssText = `
        background: white;
        padding: 2rem;
        border-radius: 12px;
        max-width: 500px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        position: relative;
    `;
    
    const closeBtn = modal.querySelector('.modal-close');
    closeBtn.style.cssText = `
        position: absolute;
        top: 10px;
        right: 15px;
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #666;
    `;
    
    return modal;
}

// Fermer le modal
function closeModal() {
    const modal = document.querySelector('.modal-overlay');
    if (modal) {
        modal.remove();
    }
}

// Gestion du menu mobile
function initMobileMenu() {
    // Créer un bouton menu pour mobile
    const navContainer = document.querySelector('.nav-container');
    if (!navContainer) return;
    
    const menuButton = document.createElement('button');
    menuButton.className = 'mobile-menu-btn';
    menuButton.innerHTML = '☰';
    menuButton.style.cssText = `
        display: none;
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
    `;
    
    navContainer.appendChild(menuButton);
    
    const navMenu = document.querySelector('.nav-menu');
    
    // Toggle du menu mobile
    menuButton.addEventListener('click', function() {
        navMenu.classList.toggle('mobile-open');
    });
    
    // Styles pour le menu mobile
    const style = document.createElement('style');
    style.textContent = `
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block !important;
            }
            
            .nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: #667eea;
                flex-direction: column;
                padding: 1rem;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            }
            
            .nav-menu.mobile-open {
                display: flex;
            }
            
            .nav-container {
                position: relative;
            }
        }
    `;
    document.head.appendChild(style);
}

// Fonction pour ajouter des animations de chargement
function showLoading(element) {
    element.innerHTML = '<div class="loading">Chargement...</div>';
}

// Fonction pour gérer les erreurs
function handleError(message) {
    console.error('Erreur:', message);
    alert('Une erreur est survenue. Veuillez réessayer.');
}

// Fonction pour valider les formulaires
function validateForm(form) {
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.style.borderColor = '#ff6b6b';
            isValid = false;
        } else {
            field.style.borderColor = '#e9ecef';
        }
    });
    
    return isValid;
}

// Fonction utilitaire pour formater les dates
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

// Fonction pour sauvegarder les préférences de recherche
function saveSearchPreferences() {
    const form = document.querySelector('.search-form form');
    if (!form) return;
    
    const formData = new FormData(form);
    const preferences = {};
    
    for (let [key, value] of formData.entries()) {
        preferences[key] = value;
    }
    
    localStorage.setItem('dogSearchPreferences', JSON.stringify(preferences));
}

// Fonction pour charger les préférences de recherche
function loadSearchPreferences() {
    const preferences = localStorage.getItem('dogSearchPreferences');
    if (!preferences) return;
    
    try {
        const prefs = JSON.parse(preferences);
        const form = document.querySelector('.search-form form');
        if (!form) return;
        
        Object.keys(prefs).forEach(key => {
            const field = form.querySelector(`[name="${key}"]`);
            if (field) {
                field.value = prefs[key];
            }
        });
    } catch (e) {
        console.error('Erreur lors du chargement des préférences:', e);
    }
}

// Charger les préférences au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    loadSearchPreferences();
});
