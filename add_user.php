<?php 
session_start();
if(!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<link rel="icon" href="navbar/other/kvr.gif" type="image/gif">
<title>Utilisateurs</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="navbar/general.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="CSS/add_user.css" media="screen" type="text/css" >
    <script src="JS/redirection.js"></script>
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
        <span>Uniquement<br>&nbsp personne <br>&nbspréservée !</span>
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

    <div class="column">
        <form action="" method="post">
            <label for="username">Nom d'utilisateur :</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Mot de passe :</label><br>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Ajouter un utilisateur">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les valeurs depuis le formulaire
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Hasher le mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

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

        // Vérifier si l'utilisateur existe déjà
        $user_check_query = "SELECT * FROM utilisateur WHERE nom_utilisateur=? LIMIT 1";
        $stmt = $conn->prepare($user_check_query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) { // Si l'utilisateur existe
            if ($user['nom_utilisateur'] === $username) {
                echo "Le nom d'utilisateur existe déjà";
            }
        } else {
            // Préparer et lier
            $stmt = $conn->prepare("INSERT INTO utilisateur (nom_utilisateur, mot_de_passe) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password); // Utiliser le mot de passe hashé

            // Exécuter la requête
            if ($stmt->execute()) {
                echo "";
            } else {
                echo "Erreur : " . $stmt->error;
            }
        }

        // Fermer la connexion
        $stmt->close();
        $conn->close();
    }
?>

</div>

<div class="column">
<form action="delete_user.php" method="post">
    <div class="submit-button-container">
        <input type="submit" value="Supprimer les utilisateurs sélectionnés">
    </div>            
    <table>
            <tr>
                <th>Nom d'utilisateur</th>
                <th>Supprimer</th>
            </tr>
<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$dbusername = "root"; // Remplacer par votre nom d'utilisateur de la base de données
$dbpassword = ""; // Remplacer par votre mot de passe de la base de données
$dbname = "xibo"; // Remplacer par le nom de votre base de données

// Créer une connexion à la base de données
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs depuis le formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifier si le mot de passe est vide
    if (empty($password)) {
        echo "Le mot de passe est requis.";
    } else {
        // Préparer et lier
        $stmt = $conn->prepare("INSERT INTO utilisateur (nom_utilisateur, mot_de_passe) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        
        // Fermer le stmt
        $stmt->close();
    }
}

// Exécuter la requête pour obtenir la liste des utilisateurs
    $sql = "SELECT id, nom_utilisateur FROM utilisateur";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Afficher les données de chaque utilisateur
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["nom_utilisateur"]. "</td>";
            if ($row["nom_utilisateur"] != "Administrateur") {
                echo "<td><input type='checkbox' name='delete[]' value='" . $row["id"] . "'></td>";
            } else {
                echo "<td></td>"; // Laissé vide pour l'utilisateur Administrateur
            }
            echo "</tr>";
        }
    } else {
        echo "0 résultat";
    }

?>

</table>
 </form>
</div>

    <div class="column">
    <form action="" method="post">
        <label for="username">Nom d'utilisateur :</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Nouveau mot de passe :</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Changer le mot de passe">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Hasher le nouveau mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

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

        // Préparer et lier
        $stmt = $conn->prepare("UPDATE utilisateur SET mot_de_passe=? WHERE nom_utilisateur=?");
        $stmt->bind_param("ss", $hashed_password, $username);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Le mot de passe a été changé avec succès";
        } else {
            echo "Erreur : " . $stmt->error;
        }

        // Fermer la connexion
        $stmt->close();
        $conn->close();
    }
    ?>
    </div>
    <script src="navbar/general.js"></script>
</body>
</html>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  