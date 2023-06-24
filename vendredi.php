<?php
// Création d'une nouvelle instance de la classe PDO pour se connecter à la base de données MySQL
$bdd = new PDO("mysql:host=localhost;dbname=xibo;charset=utf8mb4","root","");

// Préparation de la requête SQL qui sélectionne toutes les lignes de la table "menus" où la colonne "jour" est égale à 'vendredi'
$query = $bdd->prepare("SELECT * FROM menus WHERE jour = 'vendredi'");

// Exécution de la requête préparée
$query->execute();

// Récupération de la première ligne de résultat de la requête
$menu = $query->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu du vendredi</title>
    <link rel="stylesheet" href="CSS/jour.css" media="screen" type="text/css" >
</head>
<body>
    <div class="button-container">
    <a href="menu_form.php" class="menu-button">&#8678;</a> <!-- Lien vers "menu_form.php" avec la classe "menu-button" -->
    </div>
    <div class="container">
        <h1>Menu du vendredi</h1>
        <p class="menu-item">Entrée:<br><br><?php echo $menu['entree']; ?></p> <!-- Paragraphe avec la classe "menu-item" pour l'entrée du menu -->
        <p class="menu-item">Plat:<br><br><?php echo $menu['plat']; ?></p> <!-- Paragraphe avec la classe "menu-item" pour le plat du menu -->
        <p class="menu-item">Dessert:<br><br><?php echo $menu['dessert']; ?></p> <!-- Paragraphe avec la classe "menu-item" pour le dessert du menu -->
    </div>
</body>
</html>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  
