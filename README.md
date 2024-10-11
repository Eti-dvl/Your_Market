# YOUR MARKET
## À propos du projet

Ce projet a été réalisé dans le cadre de ma troisième année d'école d'ingénieur (L3) en binôme. L'objectif était d'apprendre le développement web en créant un site de vente d'articles en ligne, similaire à Amazon. Ce site permet aux utilisateurs d'acheter et de vendre des articles, avec des fonctionnalités comme la gestion des comptes, la navigation par catégories, et un système de panier.

## Déploiement du site YOURMARKET

Ce guide vous explique comment déployer le site **YOURMARKET** en utilisant **XAMPP** pour une configuration locale.

### Étape 1 : Installer XAMPP

1. Téléchargez et installez **XAMPP** depuis le site officiel : [Télécharger XAMPP](https://www.apachefriends.org/fr/index.html).
2. Suivez les instructions d’installation, puis lancez **XAMPP**.

### Étape 2 : Copier les fichiers du site

1. Ouvrez le répertoire d'installation de **XAMPP**. Par défaut, ce dossier se trouve généralement à `C:\xampp`.
2. Accédez au dossier `htdocs` à l'intérieur de ce répertoire.
3. Copiez le dossier **yourmarket** (qui contient tous les fichiers du site) dans le dossier `htdocs`. Le chemin final devrait être `C:\xampp\htdocs\yourmarket`.

### Étape 3 : Démarrer Apache et MySQL dans XAMPP

1. Ouvrez le **XAMPP Control Panel**.
2. Démarrez les services **Apache** et **MySQL** en cliquant sur les boutons **Start** à côté de chaque service.

### Étape 4 : Configurer la base de données

1. Ouvrez votre navigateur et allez sur **phpMyAdmin** à l’adresse suivante : [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
2. Connectez-vous avec les informations d'identification par défaut (utilisateur : **root**, mot de passe : **vide**, sauf si vous avez défini un mot de passe).
3. Dans **phpMyAdmin**, cliquez sur **Nouvelle base de données**.
4. Nommez la base de données **yourmarket**, puis cliquez sur **Créer**.
5. Une fois la base de données créée, sélectionnez-la dans la liste.
6. Cliquez sur l’onglet **Importer**, puis téléchargez le fichier SQL de votre base de données (par exemple `yourmarket.sql`) et cliquez sur **Exécuter** pour importer les tables et données.

### Étape 5 : Accéder au site

1. Dans votre navigateur, accédez à l'adresse suivante pour ouvrir la page d’accueil de **YOURMARKET** :  
   [http://localhost/yourmarket/index.php](http://localhost/yourmarket/index.php).

Votre site **YOURMARKET** devrait maintenant être accessible localement et pleinement fonctionnel !
