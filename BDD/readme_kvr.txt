Projet de site créé en complément de Xibo pour pallier à l'absence pendant l'année de mon "coéquipier" dans notre projet étudiant.
Il n'est pas parfait mais englobe l'utilisation de WAMP/LAMP, phpMyAdmin, SGBD MySQL avec hashage de MDP, API, AJAX, jQuery, PHP, JAVASCRIPT, HTML et CSS.
(J'ai modifié pour les besoins de ce Git les identifiants de phpMyAdmin, ils sont fixer sur "root" sans MDP pour l'utilisation de la BDD "xibo") 

Le site gère diverses fonctionnalités comme la connexion et déconnexion des utilisateurs, la gestion des absences des professeurs, l'ajout et suppression des utilisateurs, l'entrée des menus de la semaine, l'entrée de la météo, l'affichage des professeurs absents, l'affichage du menu, l'affichage de la météo. 
(Une clé d'API gratuite est obligatoire pour la partie météo, il suffit de créer un compte : https://www.weatherapi.com/ )

Connexion à la base de donnée si non spécifié dans la page : db.php 

Première page - page de connexion : login.php - login.css - verification.php - principale.php - baggio.jpg - general.css - general.js

Deuxième page - page de choix : choix.php - login.css - verification.php - principale.php - baggio.jpg - general.css - general.js

Page redirigé depuis choix.php : 

Rentrer absence des professeurs : absences.php - absences.css - general.css - general.js

--> Afficher et supprimer les absences des professeurs : validation_absences.php - validation_absences.css - delete_absences.php

Rentrer menu de la cantine : menu_form.php - menu_form.css - menu_submit.php - general.css - general.js

--> Afficher menu de la cantine : lundi.php - mardi.php - mercredi.php - jeudi.php - vendredi.php - jour.css  

Rentrer météo : entrer_meteo.php - entrer_meteo.css - envoyer_meteo.php - jQuery.js - general.css - general.js

--> Afficher météo : meteo.php - meteo.css - nuage.jpg 

Rentrer images maison des collégiens : documents.php - documents.css - scripts.js - upload.php - file_list.php - delete.php - general.css - general.js

--> Afficher images : display.php - display_documents.css  

Ajouter, supprimer utilisateurs et modifier mot de passe : add_user.php - add_user.css - redirection.js - delete_user.php - general.css - general.js

Deconnexion, suppression de la session en cours : logout.php

/*   _  ____     __ ___
    | |/ /\ \   / /| __ \
    | ' /  \ \ / / | |_) |
    | . \   \ V /  |  _ /
    |_|\_\   \_/   |_| \_\ */
