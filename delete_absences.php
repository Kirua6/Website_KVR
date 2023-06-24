<?php
// Établir une connexion à la base de données MySQL
$bdd = new PDO("mysql:host=localhost;dbname=xibo;charset=utf8mb4","root","");

// Vérifier si la variable POST 'delete' est définie
if (isset($_POST['delete'])) {
    // Récupérer les valeurs des cases à cocher cochées
    $absencesToDelete = $_POST['delete'];

    // Préparer une requête pour supprimer les lignes de la table 'professeur' où l'id correspond
    $sql = "DELETE FROM professeur WHERE id IN (" . implode(",", $absencesToDelete) . ")";

    // Préparer la requête pour l'exécution en utilisant la connexion à la base de données
    $query = $bdd->prepare($sql);

    // Exécuter la requête
    $query->execute();
}

// Rediriger vers la page 'validation_absences.php' après la suppression
header("Location: validation_absences.php");
?>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  