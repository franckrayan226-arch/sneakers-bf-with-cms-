# Sneakers Store

Site e-commerce de sneakers avec catalogue de produits, gestion des variantes et expérimentation d’une interface d’administration.

## Présentation

Ce projet consiste à développer un site marchand spécialisé dans la vente de sneakers. Il comprend une interface de présentation des produits et une structure backend en PHP destinée à expérimenter la gestion dynamique du catalogue.

Le dépôt regroupe le site marchand, les données des produits et plusieurs composants développés pour mettre en place une interface d’administration. Cette dernière est encore en cours de développement et ne constitue pas une solution de gestion finalisée.

## Fonctionnalités et composants

- **Catalogue de produits :** présentation des sneakers et de leurs informations.
- **Variantes :** organisation des caractéristiques des produits, notamment les couleurs et les pointures.
- **Données structurées :** stockage du catalogue dans un fichier JSON.
- **Interface d’administration expérimentale :** développement d’une interface pour modifier les informations des produits.
- **Backend PHP :** mise en place d’une API et de mécanismes d’authentification pour les opérations d’administration.
- **Intégration JavaScript :** script destiné à connecter les données du catalogue au site marchand.

Les fonctionnalités d’administration et leur intégration complète au site restent à finaliser.

## Technologies utilisées

| Technologie | Rôle |
|---|---|
| HTML | Structure des pages |
| CSS | Mise en forme de l’interface |
| JavaScript | Interactions et intégration du catalogue |
| PHP | Logique backend et API |
| JSON | Stockage des données produits |
| Apache | Règles de configuration via `.htaccess` |

## Architecture du dépôt

```text
Sneakers-Store/
├── index.html       # Site marchand
├── admin.html       # Interface d'administration en développement
├── api.php          # API backend
├── auth.php         # Gestion de l'authentification
├── config.php       # Configuration du backend
├── products.json    # Données du catalogue
├── cms-loader.js    # Script de liaison avec le catalogue
├── .htaccess        # Règles de configuration Apache
├── LICENSE          # Licence du projet
└── README.md        # Documentation
```

## Organisation technique

Le projet s’appuie sur une séparation entre l’interface du site marchand, les données du catalogue et les composants backend.

- `index.html` constitue le point d’entrée du site.
- `products.json` contient les données structurées des produits.
- `cms-loader.js` est destiné à assurer le chargement dynamique du catalogue.
- `api.php`, `auth.php` et `config.php` regroupent les composants backend prévus pour la gestion et la sécurisation des opérations d’administration.

Cette architecture représente une première approche de séparation entre présentation, données et logique serveur.

## État du projet

Le site marchand et les composants d’administration sont regroupés dans le même dépôt. Le développement de la partie administration n’est toutefois pas achevé.

Les prochaines étapes consistent notamment à finaliser l’intégration entre le catalogue et le site, à vérifier les opérations de modification des produits et à renforcer les contrôles de sécurité avant tout déploiement en production.

## Installation et environnement

Le site statique peut être consulté en ouvrant  dans un navigateur, sous réserve des fonctionnalités qui nécessitent un serveur.

Pour tester les composants PHP, un environnement serveur compatible est nécessaire :

- PHP 7.4 ou supérieur ;
- Apache pour appliquer directement les règles `.htaccess`, ou une configuration équivalente ;
- des permissions adaptées aux fichiers utilisés pour le stockage des données.

L’interface d’administration et l’API ne doivent pas être exposées en production avant la vérification de l’authentification, des permissions et des opérations d’écriture.

## Licence

Consulter le fichier `LICENSE` pour connaître les conditions d’utilisation et de réutilisation du projet.


**Créé pour SNEAKERS STORE - 2026**
