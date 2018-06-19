démo
====

Cette démo a été développé dans le cadre d'un test demandé par un client.

Des choix ont été fait selon nos règles de développements et le contexte du test.

Ainsi, par exemple, il n'y a pas de base de données mais des entités en mémoire.

Ceci a été réalisé en environ 2h30.

Environnement de développement
==============================

* ubuntu 18.04
* phpstorm

Commandes initiales au projet
=============================

```
sudo apt install composer
sudo apt install php-xml
composer create-project symfony/website-skeleton codeurproject
cd codeur project
git init
```

Au moment d'écrire ces lignes, ubuntu installe php 7.2.5 et composer 1.6.3.

Le squelette de Symfony généré est la version 4.1.0.

Et en cours de dev :
```
composer require annotations
```

Lancement du serveur web
========================
```
composer install
php -S 127.0.0.1:8000 -t public
```

NB : Nous conseillons de passer l'environnement à "prod" dans .env

url à tester : http://localhost:8000/produits

exemples de ligne de commandes :
```
bin/console app:products:by-reference L2
bin/console app:products:by-name ed
```
