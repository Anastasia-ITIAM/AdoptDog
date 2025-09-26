# 🐕 AdoptDog - Site d'Adoption de Chiens

## 📖 Description
Site web moderne d'adoption de chiens développé avec Symfony (back-end) et HTML/CSS/JavaScript (front-end). Le projet permet aux utilisateurs de rechercher et découvrir des chiens disponibles à l'adoption avec un système de filtres avancés.

## 🚀 Fonctionnalités

### ✨ Front-end
- **Design moderne et responsive** : Interface adaptée mobile/desktop
- **Page d'accueil** : Affichage des 6 derniers chiens disponibles
- **Page de recherche** : Système de filtres (race, âge, sexe, taille)
- **Modals de détails** : Affichage complet des informations des chiens
- **Système de contact** : Alertes avec informations du refuge
- **Animations et interactions** : Effets de survol et transitions fluides

### ⚙️ Back-end
- **Architecture Symfony 7.3** : Framework PHP moderne
- **Base de données SQLite** : Gestion des données des chiens
- **Doctrine ORM** : Mapping objet-relationnel
- **Système de migrations** : Gestion des versions de base de données
- **Fixtures** : Données de test avec 12 chiens fictifs

## 🛠️ Technologies Utilisées

### Back-end
- **Symfony 7.3** - Framework PHP
- **Doctrine ORM** - Gestion de base de données
- **SQLite** - Base de données de développement
- **Composer** - Gestionnaire de dépendances

### Front-end
- **HTML5** - Structure sémantique
- **CSS3** - Styles modernes avec Grid/Flexbox
- **JavaScript ES6+** - Interactions et logique côté client
- **Design Responsive** - Mobile-first approach

## 📁 Structure du Projet

```
dog-adoption-site/
├── public/
│   ├── css/
│   │   └── style.css          # Styles CSS (449 lignes)
│   ├── js/
│   │   └── app.js            # JavaScript (360 lignes)
│   └── index.php             # Point d'entrée Symfony
├── src/
│   ├── Controller/
│   │   └── HomeController.php # Contrôleur principal
│   ├── Entity/
│   │   └── Dog.php           # Entité Dog
│   ├── Repository/
│   │   └── DogRepository.php # Repository avec recherche
│   └── DataFixtures/
│       └── DogFixtures.php   # Données de test
├── var/
│   └── data.db              # Base de données SQLite
└── migrations/              # Migrations Doctrine
```

## 🚀 Installation et Utilisation

### Prérequis
- PHP 8.1+
- Composer
- Serveur web (Apache/Nginx) ou serveur de développement PHP

### Installation
```bash
# Cloner le repository
git clone https://github.com/Anastasia-ITIAM/AdoptDog.git
cd AdoptDog

# Installer les dépendances
composer install

# Configurer la base de données
echo 'DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"' > .env.local

# Créer et migrer la base de données
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate --no-interaction

# Charger les données de test
php bin/console doctrine:fixtures:load --no-interaction

# Démarrer le serveur de développement
php -S localhost:8000 -t public
```

### Accès au Site
- **Page d'accueil** : http://localhost:8000/
- **Page de recherche** : http://localhost:8000/search

## 📊 Base de Données

### Structure de la table `dog`
- `id` : Identifiant unique (clé primaire)
- `name` : Nom du chien
- `breed` : Race
- `description` : Description détaillée
- `age` : Âge en années
- `gender` : Sexe (Mâle/Femelle)
- `size` : Taille (Petit/Moyen/Grand)
- `image` : URL de l'image
- `is_adopted` : Statut d'adoption (0/1)
- `location` : Localisation du refuge

### Gestion des Données
Utilisez **DB Browser for SQLite** pour modifier les données :
1. Ouvrir le fichier `var/data.db`
2. Onglet "Browse Data"
3. Sélectionner la table "dog"
4. Modifier les données directement

## 🎯 Fonctionnalités Détaillées

### Page d'Accueil
- Affichage des 6 derniers chiens disponibles
- Cartes avec images, nom, race et informations de base
- Bouton "Voir détails" pour chaque chien

### Page de Recherche
- Formulaire de recherche avec filtres :
  - Race (recherche textuelle)
  - Âge (Chiot, Jeune, Adulte, Senior)
  - Sexe (Mâle, Femelle)
  - Taille (Petit, Moyen, Grand)
- Affichage des résultats en temps réel
- Compteur de résultats

### Modals de Détails
- Image grande taille du chien
- Informations complètes (race, âge, sexe, taille)
- Description détaillée
- Bouton "Contacter le refuge" avec alerte

### Design Responsive
- **Desktop** : Layout en grille avec 3-4 colonnes
- **Tablette** : Layout adaptatif avec 2 colonnes
- **Mobile** : Layout en une colonne avec menu hamburger

## 🔧 Commandes Utiles

```bash
# Voir les routes disponibles
php bin/console debug:router

# Vider le cache
php bin/console cache:clear

# Créer une nouvelle migration
php bin/console make:migration

# Exécuter les migrations
php bin/console doctrine:migrations:migrate

# Recharger les données de test
php bin/console doctrine:fixtures:load --no-interaction
```

## 📱 Responsive Design

Le site est entièrement responsive avec des breakpoints :
- **Mobile** : < 768px
- **Tablette** : 768px - 1024px
- **Desktop** : > 1024px

## 🎨 Design System

### Couleurs
- **Primaire** : Dégradé bleu-violet (#667eea → #764ba2)
- **Accent** : Rouge-orange (#ff6b6b → #ee5a24)
- **Neutre** : Gris (#f8f9fa, #6c757d)

### Typographie
- **Police principale** : Segoe UI, Tahoma, Geneva, Verdana
- **Hiérarchie** : H1 (3rem), H2 (1.8rem), H3 (1.3rem)

### Composants
- **Cartes** : Border-radius 12px, ombres subtiles
- **Boutons** : Dégradés avec effets de survol
- **Formulaires** : Focus states avec couleurs d'accent

## 📈 Performance

- **CSS optimisé** : Utilisation de CSS Grid et Flexbox
- **JavaScript modulaire** : Fonctions réutilisables
- **Images externes** : URLs Unsplash optimisées
- **Cache Symfony** : Mise en cache automatique

## 🔒 Sécurité

- **Validation des entrées** : Échappement HTML avec `htmlspecialchars()`
- **Protection XSS** : Validation côté serveur
- **Configuration sécurisée** : Variables d'environnement

## 📝 Licence

Ce projet est développé dans le cadre d'un dossier professionnel.

## 👨‍💻 Développeur

**Anastasia Degtiar** - Développeuse Full-Stack
- GitHub : [@Anastasia-ITIAM](https://github.com/Anastasia-ITIAM)

---

## 🎯 Compétences Développées

### Front-end
- HTML5 sémantique et accessible
- CSS3 moderne avec Grid/Flexbox
- JavaScript ES6+ avec modules
- Design responsive mobile-first
- Animations et interactions utilisateur

### Back-end
- Architecture Symfony MVC
- Doctrine ORM et migrations
- Gestion de base de données
- Patterns de conception (Repository, Controller)
- Sécurité et validation des données

### Outils et Méthodologie
- Git et GitHub
- Composer et gestion des dépendances
- Développement local avec serveur PHP
- Debugging et résolution de problèmes
- Documentation technique

---

*Projet réalisé avec ❤️ pour l'adoption des animaux*
