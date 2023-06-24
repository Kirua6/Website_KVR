<?php
try {
    // Création d'une nouvelle instance de l'objet PDO pour se connecter à la base de données MySQL
    $bdd = new PDO("mysql:host=localhost;dbname=xibo;charset=utf8mb4","root","");
} 
// Gestion des exceptions, si une exception est levée lors de la tentative de connexion à la base de données
catch(Exception $e) {
    // Affichage d'un message d'erreur suivi du message de l'exception
    die('Erreur : '.$e->getMessage());
}
?>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  
