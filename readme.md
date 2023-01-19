## Pré requis

**PHP >= 8.1**

## Installation
1. Sélectionner sur Github la branche souhaitée
2. Cloner le repo ou télécharger le zip (le dézipper dans votre dossier www)
3. Créer le fichier .env.local et ajouter la variable **DATABASE_URL**
4. Installer les librairies avec `composer install` dans le terminal. Mettre éventuellement à jour les librairies avec `composer update`.
5. Créer la base de données : `symfony console d:d:c`
6. Exécuter les migrations : `symfony console d:d:m`
7. Exécuter les fixtures : `symfony console d:f:l`
8. Lancer le serveur : `symfony serve`