<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<link rel="icon" href="navbar/other/kvr.gif" type="image/gif">
<title>MDL</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="navbar/general.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <link rel="stylesheet" href="CSS/documents.css" media="screen" type="text/css" >
    <script src="JS/pokeball.js"></script>
</head>
<body>

  <!-- Pokeball -->
<div class="container">
  <div class="pokeball center animate" id="pokeball">
    <div class="shine"></div>
    <button class="center" id="pkbutton"></button>
    <div class="pokeball-text">KVR</div>
    
    <!-- Bulle -->
    <div class="bubbleContainer bubbleAnimation center" id="bubble">
      <div class="bubble center">
        <span>Les boutons "Utiliser"<br> &nbsp et "Supprimer" sont <br>&nbsp &nbsp activer une fois<br>&nbsp &nbsp&nbspla ou les case(s)<br>&nbsp &nbsp &nbsp &nbsp cochée(s)</span>
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

<?php
    // Paramètres de connexion à la base de données Xibo
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = ""; // Remplacez par le mot de passe de votre base de données Xibo
    $dbname = "xibo";

    // Créer une connexion à la base de données Xibo
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Vérifier la connexion à la base de données Xibo
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    session_start(); // Démarrez la session si elle n'est pas déjà démarrée

    // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
?>
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
    <!-- Bouton "Rediriger" vers display.php avec l'ID pris en compte -->
    <a href="display.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" id="redirect-button">Rediriger vers le fichier</a>

    <form action="upload.php" method="post" enctype="multipart/form-data" id="upload-form">
        <div id="upload-container">
            Glissez et déposez des fichiers ici <br> ou cliquez pour sélectionner des fichiers
            <input type="file" name="filesToUpload[]" id="filesToUpload" multiple="multiple" style="display: none;">
        </div>
    </form>

    <table id="file-table">
        <thead>
            <tr>
                <th>Fichier</th>
                <th><button id="use-button" disabled>Utiliser</button></th>
                <th><button id="delete-button" disabled>Supprimer</button></th>
            </tr>
        </thead>
        <tbody id="file-list">
            <!-- Ce tableau sera rempli par un script PHP qui récupère la liste des fichiers de la base de données -->
        </tbody>
    </table>

    <script src="JS/scripts.js"></script>
    <script src="navbar/general.js"></script>
</body>
</html>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  