
===============================
   Application MVC | PHP 8.1
===============================

---------------
1/ Installation
---------------
D�zipper dans : 
-> www/apptest

L'ensemble des fichiers + r�pertoires est accessible dans : 
-> www/apptest

"apptest" �tant la racine du projet, et donc accessible en localhost sur un navigateur :
-> http://localhost/apptest

----------------------------------
2/ Apache et la gestion du routing
----------------------------------
Afin de faire fonctionner normalement le routage, modifier le fichier : 
-> .htaccess 

Dans ce fichier, d�commenter la ligne : 
-> RewriteBase /apptest/
Le r�pertoire "c:\www\apptest" devient alors la racine du projet.

Si le nom du r�pertoire change, il faut alors �galement changer le nom de la racine. Ex:
-> Le r�pertoire "c:\www\projetweb"
-> RewriteBase /projetweb/

En PRODUCTION (sur le serveur sio56.org) cet exemple � ajouter/adapter :
-> RewriteBase /monprenon/E5/projetWeb/live/

------------------
3/ Base de donn�es
------------------
Un exemple est inclus : 
-> apptest.sql 

Ce fichier � importer sur PhpMyAdmin dans une base de donn�es nomm�e :
-> apptest

Le nom de cette BBD doit �tre chang� sur le projet r�el !

Pour configurer l'acc�s � cette BDD, le fichier : 
-> app/BD.php 
doit �tre renseign�.

Par d�faut le nom d'utilisateur est "root", 
mais ceci peut changer en fonction du SGBDR !

----------------------------
4/ Le routage (redirections)
----------------------------
Fichier � analyser/modifier/�diter :
-> app/route/routing.php

### Exemple: $route->add('/cible', 'controleur\MaCible');
Le namespace doit �tre renseign�. Ici le namespace est : 
-> controleur\MaCible
Cette route donne sur un navigateur : 
-> http://localhost/apptest/cible
Ce contr�leur est charg� dans le r�pertoire local : 
-> "apptest/controleur/MaCible.php"

### Exemple avec une classe contenant un seul param�tre :
-> $route->add('/cible', 'controleur\MaCible', "param1");
-> Classe en question : public function __construct("param1"){...}

### Exemple avec une classe contenant plusieurs param�tres.
Se d�clare avec un tableau :
-> $route->add('/cible', 'controleur\MaCible', ["param1", "param2"]);
-> Classe en question : public function __construct("param1", "param2"){...}

----------------
5/ Prise en main
----------------
Voir le fichier : 
-> controleur/Accueil.php

Et ses d�pendances :
-> DAO : modele/DAO/UserDAO.php
--> Logique METIER : modele/User.php
-> VUE : vue/Accueil.php
--> AJAX VUE : vue/ajax/ajaxRechercher.php
--> AJAX CONTROL : controleur/MainAjax.php

Le nom des fichiers est arbitraire, mais leurs noms de classes 
doivent �tre adapt�s en cas de changement, exemple :
-> Fichier : modele/Admin.php
-> Nom de la classe : Admin
-> Nom du namespace : modele
-> Accessibilit� : new \modele\Admin();

Aucun require() ne doit �tre ajout�, l'ensemble est g�r� par le fichier : 
-> app/autoload.php

-----------
6/ D�bogage
-----------
Accessible -partout- la fonction debug() permet de d�composer une variable,
et donc lire son contenu. Par exemple :
-> debug($_SESSION);
-> debug($maVar);
-> debug($_SESSION, $maVar, $_POST, $_GET);
Source de la fonction debug() :
-> app/functions.php

Quelques classes impl�ment�es utilisent aussi un d�bogage en interne, par exemple :
-> app/setup.php --> Router::help();
-> controleur/NotFound.php --> Vue::test();

Pour AJAX (sur le front) un d�buggeur interne est visible par un pop-up sur le
navigateur. Pour l'activer :
-> app/param.php
-> Passer � "true" le param�tre "AJAX_DEBUG".
-> Recharger le navigateur, puis lancer une requ�te AJAX.

-----------
7/ Composer
-----------
Des librairies Composer peuvent �tre ajout�es dans le fichier :
-> composer.json

La librairie en question s'ajoute dans la partie :
-> "require": { "ma/librairie": "version" }

Ou plus simplement par la commande :
-> cd /chemin/absolu/vers/mon/app/ && composer require ma/librairie

Pour importer la librairie, et donc mettre � jour les librairies Composer :
-> cd /chemin/absolu/vers/mon/app/ && composer update

Composer est aussi disponible pour Windows :
-> https://getcomposer.org/Composer-Setup.exe

-----------
8/ Au final
-----------
Une bonne partie du code de cette application MVC est comment� !


