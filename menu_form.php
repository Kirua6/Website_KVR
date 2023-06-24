<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header('Location: login.php');
    exit;
}
// Connexion à la base de données
$bdd = new PDO("mysql:host=localhost;dbname=xibo;charset=utf8mb4","root","");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<link rel="icon" href="navbar/other/kvr.gif" type="image/gif">
<title>Cantine</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="navbar/general.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="CSS/menu_form.css">
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
        <span>Sélectionner le<br> jour voulu et<br>le repas puis <br> &nbsp &nbsp &nbspvalider</span>
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
<div style="display: flex; justify-content: space-between;">
  <div class="form-container">
  <form action="menu_submit.php" method="post">
    <!-- Début du formulaire pour créer un menu -->
    <h2>Créer un menu</h2>
    <label for="jour">Jour:</label><br>
    <!-- Étiquette du champ de sélection du jour -->
    <select id="jour" name="jour">
      <!-- Champ de sélection du jour -->
      <option value="Lundi">Lundi</option>
      <!-- Option "Lundi" -->
      <option value="Mardi">Mardi</option>
      <!-- Option "Mardi" -->
      <option value="Mercredi">Mercredi</option>
      <!-- Option "Mercredi" -->
      <option value="Jeudi">Jeudi</option>
      <!-- Option "Jeudi" -->
      <option value="Vendredi">Vendredi</option>
      <!-- Option "Vendredi" -->
    </select><br>

    <label for="entree">Entrée:</label><br>
    <!-- Étiquette du champ de saisie de l'entrée -->
    <input id="entree" name='entree' type="text" placeholder="Entrée"><br>
    <!-- Champ de saisie de l'entrée -->

    <label for="plat">Plat:</label><br>
    <!-- Étiquette du champ de saisie du plat -->
    <input id="plat" name='plat' type="text" placeholder="Plat"><br>
    <!-- Champ de saisie du plat -->

    <label for="dessert">Dessert:</label><br>
    <!-- Étiquette du champ de saisie du dessert -->
    <input id="dessert" name='dessert' type="text" placeholder="Dessert"><br>
    <!-- Champ de saisie du dessert -->

    <input type="submit" name="valider" value="Valider"><br>
    <!-- Bouton de validation du formulaire -->
</div>
  </form>
  
  <div class="day-visual-container">
    <!-- Début du tableau des visuels des pages -->
    <h2>Visuel des pages</h2>
    <button class="day-button" onclick="window.location.href='Lundi.php'">Lundi</button><br>
    <button class="day-button" onclick="window.location.href='Mardi.php'">Mardi</button><br>
    <button class="day-button" onclick="window.location.href='Mercredi.php'">Mercredi</button><br>
    <button class="day-button" onclick="window.location.href='Jeudi.php'">Jeudi</button><br>
    <button class="day-button" onclick="window.location.href='Vendredi.php'">Vendredi</button><br>
</div>

<script src="navbar/general.js"></script>
</body>
</html>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  