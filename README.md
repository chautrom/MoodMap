# MoodMap
*Follow your emotions*


Installation de l'API sur le RaspberryPi3

Le RaspberryPi3 à besoins des différentes technologies suivantes pour fonctionner :

  1) Apache2 
  2) PHP5
  3) MySQL
  4) Phpmyadmin
  5) Symfony
 
Les 4 premières technologies nous les avons installer avec la distribution Debian.
Nous avons utiliser les paquets de la distribution debian pour faciliter la maintenabilité et l'installation.
Néanmoins, pour la 5ème technologie "Symfony", il n'y avait pas de paquet Debian pour l'installer.
Nous avons alors installer Composer sur le site officiel https://getcomposer.org/download/ afin de pouvoir gérer les dépendances de Symfony.
Une fois cela fait, il suffit de cloner le projet avec git à la racine du serveur Apache2 /var/www/html/.
Après que le projet soit créer il suffit de lancer le serveur Apache2 ainsi que Symfony.
En lançant dans le dossier MoodMap /var/www/html/MoodMap/moodMap la commande :

php app/console server:run *AdresseIP*

En remplaçant bien évidement l'*Adresse IP* 
Et voilà nous pouvons avoir accès à l'API à l'adresse IP choisit sur le port 8000 si vous l'avez laisser par defaut.
*AdresseIP*:8000
