Le code à été testé dans l'environnement suivant :
Debian Jessie 8.11
Apache 2.4.10
PHP 7.3.5
Python 3.4.2
mysql ver 14.14 Distrib 5.5.62

Prérequis :
Pour faire fonctionner le script il vous faut un LAMP
Il faut les modules sql php pour pouvoir fonctionner avec mysql.
Il faut les modules permettant a python de fonctionner avec mysql.
Il faut configurer apache pour permettre l'execution de fichier script cgi en .py et activer le module cgi.

Utilisation :
Il suffit de cloner le git avec :
git clone https://github.com/RemiBaldy/movieTaste.git

Vous devriez avoir un répertoire movieTaste, il vous suffit de copier son contenu à l'emplacement racine de votre serveur web.
Il y a un fichier sql contenant la base de donnée à importer sur votre serveur Mysql.
Une fois la base de donnée importée il ne vous reste plus qu'a lancer le serveur Python.
Pour lancer le serveur python il faut executer la commande suivante dans le répertoire pythonServ/ :
<Votre emplacement python> ./myServer.py <port>
Exemple : /usr/bin/python3 ./myServer.py 1234
Le port par défaut est 1234, si vous souhaitez modifier le port il vous suffit d'éditer le fichier /php/MoviesRequest.php et de modifier dans la fonction getMyRecommendedMovies() la variable $client qui lance un ClientTCP.

Voici le lien github du projet Android :
https://github.com/TheSmartBeaver/FilmProjectAndroid
