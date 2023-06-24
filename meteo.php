<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <link rel="stylesheet" href="CSS/meteo.css" media="screen" type="text/css"> 
    <a id="back-button" href="entrer_meteo.php">Retour</a> 
</head>
<body>
    <div class="weather-container"> 
    <?php
    // Informations de connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "xibo";

    // Créer une connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion à la base de données
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error); // Si la connexion échoue, terminer le script avec un message d'erreur
    }

    // Requête SQL pour obtenir les données de localisation et de date de début de la semaine les plus récentes
    $sql = "SELECT location, week_start_date FROM meteo ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    // Vérifier si la requête a retourné des résultats
    if ($result->num_rows > 0) {
      // Si oui, extraire les données de chaque ligne
      while($row = $result->fetch_assoc()) {
        $location = $row["location"];
        $week_start_date = $row["week_start_date"];
      }
    } else {
      echo "No results"; // Si non, afficher un message indiquant qu'il n'y a pas de résultats
    }
    $conn->close(); // Fermer la connexion à la base de données

    // Calcule la différence en jours entre la date actuelle et la date de début de la semaine
    $date1 = new DateTime();
    $date2 = new DateTime($week_start_date);
    $interval = $date1->diff($date2);
    $days_difference = $interval->format('%a');

    // Si la différence en jours est inférieure ou égale à 5
    if ($days_difference <= 5) {
        // Faire une requête à l'API météo pour obtenir les données météo pour la localisation et les jours spécifiés
        $weather_data = file_get_contents("https://api.weatherapi.com/v1/forecast.json?key=VOTRE_CLE-D'API&q=$location&days=5&lang=fr");
                                                                          //mettez votre clé d'api, sans "" ou autre entre ?key= et &q=$location&days
        // Décode les données JSON retournées par l'API météo
        $weather_data = json_decode($weather_data, true);

        // Définit la localisation en français
        setlocale(LC_TIME, 'fr_FR.utf8');

        // Affiche les informations météo pour chaque jour
        foreach ($weather_data['forecast']['forecastday'] as $day) {
            // Convertit la date en objet DateTime
            $date = new DateTime($day['date']);
            
            // météo dans une table
            echo "<div class='weather-table'>"; 
            echo "<table>"; 
            echo "<tr><th>Date</th><td>" . strftime('%A<br> <br> %e %B', $date->getTimestamp()) . "</td></tr>"; // Affiche le nom du jour et le mois en français
            echo "<tr><td colspan='2'><hr></td></tr>"; // ligne horizontale
            echo "<tr><th>Condition</th><td>" . $day['day']['condition']['text'] . "</td></tr>"; // Affiche l'état météo
            echo "<tr><td colspan='2'><hr></td></tr>"; // ligne horizontale
            echo "<tr><th>Température</th><td>" . $day['day']['avgtemp_c'] . "°C</td></tr>"; // Affiche la température moyenne en degrés Celsius
            echo "</table>";
            echo "</div>";
        }
    } else {
        // Si la différence en jours est supérieure à 5, affiche un message d'erreur et redirige vers "entrer_meteo.php" après 2 secondes
        echo '
        <div class="error-message">
            ERREUR : VEUILLEZ CHOISIR LA DATE D\'AUJOURD\'HUI !
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "entrer_meteo.php";
            }, 2000); // Redirection automatique après 2 secondes
        </script>
        ';
    }
    ?>
    </div>
</body>
</html>


<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  

