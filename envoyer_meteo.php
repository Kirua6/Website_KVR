<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "xibo";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$location = $_POST["location"];
$week_start_date = $_POST["week_start_date"];

// Supprimer tous les enregistrements existants
$sql = "DELETE FROM meteo";
if ($conn->query($sql) === TRUE) {
    // Insérer la nouvelle demande
    $sql = "INSERT INTO meteo (location, week_start_date)
            VALUES ('$location', '$week_start_date')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  