<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<link rel="icon" href="navbar/other/kvr.gif" type="image/gif">
<title>NegXiGio</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="navbar/general.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<link rel="stylesheet" href="CSS/login.css" media="screen" type="text/css" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="CSS/pokeball.css" media="screen" type="text/css" >
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
    
    <div class="bubbleContainer bubbleAnimation center" id="bubble">
      <!-- Bulle -->
      <div class="bubble center">
        <span>Bienvenue sur <br>&nbsp le website <br> &nbsp "NEGXIGIO"</span>
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



<div id="container">

<!-- Zone de connexion -->
<form action="verification.php" method="POST">
<!-- Formulaire de connexion qui envoie les données vers "verification.php" en utilisant la méthode POST -->
<h1>Connexion</h1>
<!-- Titre de la section de connexion -->

<label><b>Nom d'utilisateur</b></label>
<!-- Étiquette pour le champ "Nom d'utilisateur" -->
<input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
<!-- Champ de saisie pour le nom d'utilisateur -->

<label><b>Mot de passe</b></label>
<!-- Étiquette pour le champ "Mot de passe" -->
<input type="password" placeholder="Entrer le mot de passe" name="password" required>
<!-- Champ de saisie pour le mot de passe -->

<input type="submit" id='submit' value='SE CONNECTER'>
<!-- Bouton de soumission du formulaire avec l'identifiant "submit" et la valeur "LOGIN" -->

<?php
if(isset($_GET['erreur'])){
    $err = $_GET['erreur'];
    // Vérification si le paramètre 'erreur' est défini dans l'URL
    if($err==1 || $err==2) {
        // Vérification de la valeur de 'erreur'
        echo "<p style='color:white; font-family:Trebuchet MS, sans-serif;'>Utilisateur ou mot de passe incorrect<br><br> Demandez à l'administrateur de vous redonner<br> votre identifiant ou de changer votre mot de passe</p>";

        // Affichage d'un message d'erreur en cas de valeurs 1 ou 2
    }
}
?>
</form>
</div>
<script src="navbar/general.js"></script>
</body>
</html>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  