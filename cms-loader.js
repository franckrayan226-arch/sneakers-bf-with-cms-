// ============================================
// CMS LOADER - SNEAKERS STORE
// Charge les produits dynamiquement depuis le CMS
// À inclure dans ton index.html AVANT la fermeture </body>
// ============================================

(function() {
    'use strict';

    // URL de base du CMS (à adapter si ton CMS est dans un sous-dossier)
    const CMS_BASE = window.CMS_BASE_URL || 'cms';
    const API_URL = CMS_BASE + '/api.php';

    // Charge les produits depuis le CMS
    async function loadCMSProducts() {
        try {
            const response = await fetch(API_URL + '?t=' + Date.now(), {
                cache: 'no-store',
                credentials: 'same-origin'
            });

            if (!response.ok) {
                console.warn('[CMS] API non accessible, utilisation des données locales');
                return false;
            }

            const cmsProducts = await response.json();

            // Filtre les produits en rupture de stock
            const activeProducts = cmsProducts.filter(p => !p.outOfStock);

            // Remplace le contenu du tableau existant (même si c'est un const)
            // en mutant le tableau en place
            if (Array.isArray(window.products)) {
                window.products.length = 0; // vide le tableau
                activeProducts.forEach(p => window.products.push(p));
            } else {
                window.products = activeProducts;
            }

            // Stocke aussi la référence complète
            window.cmsProducts = activeProducts;
            window.cmsAllProducts = cmsProducts;

            console.log('[CMS] ' + cmsProducts.length + ' produits chargés (' + activeProducts.length + ' actifs)');

            // Ré-render le site si les fonctions existent déjà
            if (typeof window.renderProducts === 'function') {
                window.renderProducts();
            }
            if (typeof window.renderSoldes === 'function') {
                window.renderSoldes();
            }

            return true;

        } catch (error) {
            console.error('[CMS] Erreur:', error);
            return false;
        }
    }

    // Expose la fonction globalement
    window.loadCMSProducts = loadCMSProducts;

    // Charge immédiatement
    loadCMSProducts();
})();
