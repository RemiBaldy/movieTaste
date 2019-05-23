Le code � �t� test� dans l'environnement suivant :
Debian Jessie 8.11
Apache 2.4.10
PHP 7.3.5
Python 3.4.2
mysql ver 14.14 Distrib 5.5.62

Pr�requis :
Pour faire fonctionner le script il vous faut un LAMP
Il faut les modules sql php pour pouvoir fonctionner avec mysql.
Il faut les modules permettant a python de fonctionner avec mysql.
Il faut configurer apache pour permettre l'execution de fichier script cgi en .py et activer le module cgi.

Utilisation :
Il suffit de cloner le git avec :
git clone https://github.com/RemiBaldy/movieTaste.git

Vous devriez avoir un r�pertoire movieTaste, il vous suffit de copier son contenu � l'emplacement racine de votre serveur web.
Il y a un r�pertoire BDD avec un fichier sql contenant la base de donn�e � importer sur votre serveur Mysql.
Une fois la base de donn�e import�e il ne vous reste plus qu'a lancer le serveur Python.
Pour lancer le serveur python il faut executer la commande suivante dans le r�pertoire pythonServ/ :
<Votre emplacement python> ./myServer.py <port>
Exemple : /usr/bin/python3 ./myServer.py 1234
Le port par d�faut est 1234, si vous souhaitez modifier le port il vous suffit d'�diter le fichier /php/MoviesRequest.php et de modifier dans la fonction getMyRecommendedMovies() la variable $client qui lance un ClientTCP.

Voici le lien github du projet Android :
https://github.com/TheSmartBeaver/FilmProjectAndroid