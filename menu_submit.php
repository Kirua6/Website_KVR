<?php
$bdd = new PDO("mysql:host=localhost;dbname=xibo;charset=utf8mb4","root","");

if(isset($_POST['valider'])){
    $jour = $_POST['jour'];
    $entree = $_POST['entree'];
    $plat = $_POST['plat'];
    $dessert = $_POST['dessert'];

    // Supprimer l'ancien menu pour le jour sélectionné
    $deleteQuery = $bdd->prepare("DELETE FROM menus WHERE jour = :jour");
    $deleteQuery->execute(['jour' => $jour]);

    // Insérer le nouveau menu
    $insertQuery = $bdd->prepare("INSERT INTO menus(jour, entree, plat, dessert) 
                                  VALUES(:jour, :entree, :plat, :dessert)");
    $insertQuery->execute([
        'jour' => $jour,
        'entree' => $entree,
        'plat' => $plat,
        'dessert' => $dessert
    ]);

    
    header('Location: menu_form.php');

}
?>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  