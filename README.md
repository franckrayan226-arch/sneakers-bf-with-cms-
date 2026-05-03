# 🎛️ CMS - SNEAKERS STORE
## Centre de Contrôle pour ton site de sneakers

---

## 📦 Contenu du dossier

```
cms/
├── admin.html          → Interface d'administration
├── api.php             → API backend (lecture/écriture JSON)
├── auth.php            → Gestion connexion/déconnexion
├── config.php          → Configuration (mot de passe)
├── products.json       → Base de données produits
└── .htaccess           → Protection serveur
cms-loader.js           → Script à relier à ton site
```

---

## ⚡ Installation rapide (3 étapes)

### Étape 1 : Upload sur ton serveur Linux

Upload le dossier `cms/` à la **racine** de ton site (au même niveau que `index.html`).

```
/var/www/html/          ← racine de ton site
├── index.html          ← ton site actuel
├── cms/                ← NOUVEAU : dossier CMS
│   ├── admin.html
│   ├── api.php
│   ├── auth.php
│   ├── config.php
│   ├── products.json
│   └── .htaccess
└── cms-loader.js       ← NOUVEAU : script de liaison
```

### Étape 2 : Connecte ton site au CMS

Dans ton fichier `index.html`, il faut faire **2 mini-modifications** :

#### A) Remplace `const products` par `let products`

Dans ton `<script>` actuel, trouve cette ligne :
```javascript
const products = [
```

Remplace-la par :
```javascript
let products = [];
```

> ⚠️ **Pourquoi ?** Le CMS charge les produits dynamiquement. `const` empêche la réassignation, `let` l'autorise.

#### B) Ajoute le loader CMS

Juste **avant** la fermeture `</body>`, ajoute :

```html
<script src="cms-loader.js"></script>
```

Et place le fichier `cms-loader.js` à la racine (au même niveau que `index.html`).

---

### Étape 3 : Change le mot de passe (OBLIGATOIRE)

Ouvre `cms/config.php` et modifie le hash du mot de passe.

**Par défaut**, le mot de passe est : `admin123`

Pour créer ton propre hash, crée un fichier `hash.php` temporaire :

```php
<?php
echo password_hash('TON_MOT_DE_PASSE', PASSWORD_DEFAULT);
?>
```

Accède-y via ton navigateur (`https://tonsiteweb.com/cms/hash.php`), copie le résultat, et colle-le dans `config.php` à la place de l'ancien hash.

**Supprime `hash.php` après usage.**

---

## 🚀 Accéder au CMS

Une fois uploadé, accède à :

```
https://tonsiteweb.com/cms/admin.html
```

Connecte-toi avec le mot de passe défini.

---

## ✨ Ce que tu peux faire dans le CMS

| Fonction | Description |
|----------|-------------|
| 🖼 **Changer les images** | Colle directement l'URL de la nouvelle image (hébergement imgur, pinterest, etc.) |
| 💰 **Gérer les prix** | Modifie le prix de base, ajoute un prix promo et un pourcentage de réduction |
| 📦 **Rupture de stock** | Active/désactive un produit en 1 clic (il disparaît du site) |
| 🎨 **Couleurs / Variantes** | Ajoute/modifie les couleurs avec leur image et code HEX |
| 📏 **Pointures** | Gère les tailles disponibles par produit |
| ➕ **Nouveaux produits** | Ajoute des produits sans toucher au code |
| 🗑 **Supprimer** | Retire définitivement un produit |
| 💾 **Sauvegarder** | Envoie les modifications au serveur en temps réel |

---

## ⚙️ Fonctionnement technique

1. **Le CMS** écrit dans `cms/products.json` quand tu cliques sur "Sauvegarder"
2. **Ton site** lit ce fichier via `cms-loader.js` à chaque chargement de page
3. **Temps de mise à jour** : immédiat après sauvegarde (pas besoin de redémarrer le serveur)

---

## 🔒 Sécurité

- Le dossier `cms/` est protégé par `.htaccess` (fichiers sensibles bloqués)
- L'API refuse toute modification sans session authentifiée
- Les backups automatiques de `products.json` sont créés à chaque sauvegarde
- Change impérativement le mot de passe par défaut

---

## 🐛 Problèmes connus / Solutions

| Problème | Solution |
|----------|----------|
| "Erreur de connexion au serveur" | Vérifie que PHP est activé sur ton serveur (`sudo apt install php libapache2-mod-php`) |
| Les produits ne s'affichent pas | Vérifie que `cms-loader.js` est bien inclus et que `products` est en `let` |
| Le panier ne fonctionne plus | Le CMS ne touche pas au panier, vérifie juste que `cms-loader.js` est chargé AVANT les fonctions du panier |
| Images qui ne chargent pas | Vérifie l'URL de l'image (CORS). Préfère des URLs directes (`.jpg`, `.png`) |

---

## 📁 Prérequis serveur

- **PHP 7.4+** (installé par défaut sur la plupart des serveurs Linux)
- **Apache** ou **Nginx** avec module rewrite (pour `.htaccess`)
- Droits d'écriture sur le dossier `cms/` (`chmod 755 cms/`)

---

## 🔄 Mise à jour future

Pour mettre à jour le CMS, tu peux simplement ré-uploader les fichiers `admin.html`, `api.php`, `auth.php` et `config.php`. **Ne supprime pas `products.json`** sinon tu perds tes données.

---

**Créé pour SNEAKERS STORE - 2026**
