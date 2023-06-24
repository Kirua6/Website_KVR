<?php
// Crée une nouvelle instance de l'objet PDO et se connecte à la base de données MySQL "xibo" sur localhost avec le nom d'utilisateur "root" et aucun mot de passe
$bdd = new PDO("mysql:host=localhost;dbname=xibo;charset=utf8mb4","root","");

// Prépare une requête SQL qui sélectionne toutes les colonnes de la table "menus" où la valeur de la colonne "jour" est égale à "mardi"
$query = $bdd->prepare("SELECT * FROM menus WHERE jour = 'mardi'");

// Exécute la requête préparée
$query->execute();

// Récupère la première ligne de résultat de la requête sous forme de tableau associatif
$menu = $query->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu du mardi</title>
    <link rel="stylesheet" href="CSS/jour.css" media="screen" type="text/css" >
</head>
<body>
    <div class="button-container">
    <a href="menu_form.php" class="menu-button">&#8678;</a> <!-- Lien vers "menu_form.php" avec la classe "menu-button" -->
    </div>
    <div class="container">
        <h1>Menu du mardi</h1>
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
