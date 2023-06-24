<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/choix.css" media="screen" type="text/css" >
</head>
<body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        // Récupérer les ID des utilisateurs à supprimer
        $user_ids = $_POST['delete'];

        // Paramètres de connexion à la base de données
        $servername = "localhost";
        $dbusername = "root"; 
        $dbpassword = ""; 
        $dbname = "xibo"; 

        // Créer une connexion à la base de données
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        // Supprimer chaque utilisateur
        foreach ($user_ids as $user_id) {
            // Préparer et lier
            $stmt = $conn->prepare("DELETE FROM utilisateur WHERE id = ?");
            $stmt->bind_param("i", $user_id);

            // Exécuter la requête
            if ($stmt->execute()) {
                echo "L'utilisateur avec l'ID " . $user_id . " a été supprimé avec succès<br>";
            } else {
                echo "Erreur lors de la suppression de l'utilisateur avec l'ID " . $user_id . ": " . $stmt->error . "<br>";
            }

            // Fermer le stmt
            $stmt->close();
        }

        // Fermer la connexion
        $conn->close();

        echo "<br>Tous les utilisateurs sélectionnés ont été supprimés avec succès";
        header("Refresh: 3; url=add_user.php"); // Rediriger vers add_user.php après 3 secondes
    } else {
        echo "Erreur : Aucun utilisateur sélectionné pour la suppression";
        header("Refresh: 3; url=add_user.php"); // Rediriger vers add_user.php après 3 secondes
    }
?>

</body>
</html>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  