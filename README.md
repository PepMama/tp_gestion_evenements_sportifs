#### Prérequis
PHP 8.1 ou supérieur
Composer
Symfony CLI
Un serveur web compatible (Apache, Nginx, etc.)
Une base de données (MySQL, PostgreSQL, etc.)

#### Installation
Cloner le dépôt :
git clone https://votre-repo-git.git
cd votre-repo

## Installer les dépendances :
composer install

#### Configurer les variables d'environnement :

## Copier le fichier .env et renommer la copie en .env.local :
cp .env .env.local

## Modifier les informations de connexion à la base de données dans le fichier .env :
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/nom_de_la_base?serverVersion=8&charset=utf8mb4"

## Créer la base de données :
php bin/console doctrine:database:create

## Effectuer les migrations :
php bin/console doctrine:migrations:migrate

## Lancer le serveur web local :
symfony server:start

Le projet est maintenant accessible à l'adresse https://127.0.0.1:8000.