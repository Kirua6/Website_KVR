<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name = 'xibo';
    $db_host = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die('Could not connect to database');

    // Appliquer les fonctions de sécurité pour éviter les attaques par injection SQL et XSS
    $username = mysqli_real_escape_string($db, htmlspecialchars($_POST['username']));
    $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['password']));

    if ($username !== "" && $password !== "") {
        $requete = "SELECT id, nom_utilisateur, mot_de_passe FROM utilisateur WHERE nom_utilisateur = '".$username."'";
        $exec_requete = mysqli_query($db, $requete);
        $reponse = mysqli_fetch_assoc($exec_requete);

        if ($reponse && password_verify($password, $reponse['mot_de_passe'])) {
            // Le mot de passe entré par l'utilisateur correspond au hash stocké dans la base de données
            $userId = $reponse['id'];
            $_SESSION['user_id'] = $userId; // Enregistrer l'ID de l'utilisateur dans la variable de session
            header('Location: principale.php');
        } else {
            header('Location: login.php?erreur=1'); // Nom d'utilisateur ou mot de passe incorrect
        }
    } else {
        header('Location: login.php?erreur=2'); // Nom d'utilisateur ou mot de passe vide
    }
} else {
    header('Location: login.php');
}
mysqli_close($db); // Fermer la connexion
?>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  

