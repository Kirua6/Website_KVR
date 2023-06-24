<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header('Location: login.php');
    exit;
}
// Connexion à la base de données
$bdd = new PDO("mysql:host=localhost;dbname=xibo;charset=utf8mb4","root","");

// Vérification si le formulaire a été soumis
if(isset($_POST['valider'])){
  // Récupération des valeurs du formulaire
    $nom_professeur = $_POST['nom'];
    $prenom_professeur = $_POST['prenom'];
    $debut_absence_date = $_POST['debut_absence_date'];
    $debut_absence_time = $_POST['debut_absence_time'] ?? "00:00:00";
    $debut_absence = $debut_absence_date . " " . $debut_absence_time;

    $fin_absence_date = $_POST['fin_absence_date'];
    $fin_absence_time = $_POST['fin_absence_time'] ?? "00:00:00";
    $fin_absence = $fin_absence_date . " " . $fin_absence_time;

    // Préparation de la requête d'insertion
    $query = $bdd->prepare("INSERT INTO professeur(nom_professeur, prenom_professeur, debut_absence, fin_absence) 
                            VALUES(:nom_professeur, :prenom_professeur, :debut_absence, :fin_absence)");

   // Exécution de la requête avec les valeurs fournies
   $query->execute([
        'nom_professeur' => $nom_professeur,
        'prenom_professeur' => $prenom_professeur,
        'debut_absence' => $debut_absence,
        'fin_absence' => $fin_absence
    ]);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<link rel="icon" href="navbar/other/kvr.gif" type="image/gif">
<title>Absence</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="navbar/general.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/absences.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <script src="JS/pokeball.js"></script> 
  </head>
  <body>
    
     <!-- Navbar -->
  <div class="navbar-mobile">
        <i class="fas fa-bars"></i>
        <div class="modal">
            <div class="navbar-mobile-list">
                <a href="absences.php">Absence</a>
                <a href="menu_form.php">Cantine</a>
                <a href="entrer_meteo.php">Météo</a>
                <a href="documents.php">MDL</a>
                <?php
                  // Vérifier si l'utilisateur est connecté et récupérer son ID à partir de la base de données Xibo
                  if (isset($_SESSION['user_id'])) {
                  $userId = $_SESSION['user_id'];

                  // Vérifier si l'utilisateur est l'administrateur (ID = 5)
                  if ($userId == 5) {
                  echo '<a href="add_user.php">Utilisateurs</a>';
                     }   
                  }
                ?>
                <a href="logout.php">Déconnexion</a>
              </div>
        </div>
    </div>
    
    <div class="navbar-desktop">
                <a href="absences.php">Absence</a>
                <a href="menu_form.php">Cantine</a>
                <a href="entrer_meteo.php">Météo</a>
                <a href="documents.php">MDL</a>
                <?php
                  // Vérifier si l'utilisateur est connecté et récupérer son ID à partir de la base de données Xibo
                  if (isset($_SESSION['user_id'])) {
                  $userId = $_SESSION['user_id'];

                  // Vérifier si l'utilisateur est l'administrateur (ID = 5)
                  if ($userId == 5) {
                  echo '<a href="add_user.php">Utilisateurs</a>';
                     }   
                  }
                ?>
                <a href="logout.php">Déconnexion</a>
              </div>
    </div>
    
    <!-- Pokeball -->
  <div class="container">
  <div class="pokeball center animate" id="pokeball">
    <div class="shine"></div>
    <button class="center" id="pkbutton"></button>
    <div class="pokeball-text">KVR</div>
    
   <!-- Bulle -->
    <div class="bubbleContainer bubbleAnimation center" id="bubble">
      <div class="bubble center">
        <span>⚠️ Sélectionner <br>&nbsp &nbsp l'heure n'est <br>&nbsp pas obligatoire</span>
        <div class="bubbleArrow center" id="bubbleArrow"></div>
      </div>
    </div>
   
    <!--  Ombre de la pokeball -->
  </div>
  <div class="pokeballShadow center shadowAnimate" id="pokeShadow"></div>
</div>

<script>
  // Ajout d'un événement de clic sur l'élément avec l'ID "pokeball"
  document.getElementById("pokeball").addEventListener("click", function() {
    var div2 = document.getElementById("bubble");
    
    // Vérification de l'opacité actuelle de la bulle
    if (div2.style.opacity !== "0") {
      // Si l'opacité n'est pas déjà à 0, la mettre à 0 pour masquer la bulle
      div2.style.opacity = "0";
    } else {
      // Sinon, si l'opacité est déjà à 0, la mettre à 1 pour afficher la bulle
      div2.style.opacity = "1";
    }
  });
</script>

    <form method="post">
        <h2>Ajouter une absence</h2>
        <label for="nom">Nom:</label><br>
        <input id="nom" name='nom' type="text" placeholder="Entrez le nom"><br>
        <label for="prenom">Prénom:</label><br>
        <input id="prenom" name='prenom' type="text" placeholder="Entrez le prénom"><br>
        <div class="input-container">
            <label for="debut_absence_date">Sélectionnez la date de début:</label>
            <input type="date" id="debut_absence_date" name="debut_absence_date" min="2000-01-01" max="2999-12-31">
        </div>
        <div class="input-container2">  
            <label for="debut_absence_time"> à l'heure de :</label>
            <input type="time" id="debut_absence_time" name="debut_absence_time">
        </div>
        <div class="input-container">
            <label for="fin_absence_date">Sélectionnez la date de fin:</label>
            <input type="date" id="fin_absence_date" name="fin_absence_date" min="2000-01-01" max="2999-12-31">
        </div>
        <div class="input-container2">  
            <label for="fin_absence_time">à l'heure de :</label>
            <input type="time" id="fin_absence_time" name="fin_absence_time">
        </div>       
       <input type="submit" name="valider" value="Valider">
    </form>
    <form action="validation_absences.php" method="post" class="mon-formulaire">
       <input type="submit" value="Voir les absences" class="submit2">
    </form>
    <script src="navbar/general.js"></script>
    </body>
</html>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  