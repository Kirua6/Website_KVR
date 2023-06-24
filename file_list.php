<?php
// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=xibo', 'root', '');

// Vérifier si l'ID est défini dans l'URL
if (isset($_GET['id'])) {
    $selectedId = $_GET['id'];
} else {
    $selectedId = null;
}

// Récupération des fichiers
$query = $db->query("SELECT * FROM documents");
$files = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($files as $file) {
    echo '<tr>';
    echo '<td>'.htmlspecialchars($file['file_name']).'</td>';
    
    // Vérifier si l'ID correspond à celui du fichier en cours
    if ($file['id'] === $selectedId) {
        echo '<td><input type="checkbox" class="use-checkbox" value="'.htmlspecialchars($file['id']).'" checked></td>';
    } else {
        echo '<td><input type="checkbox" class="use-checkbox" value="'.htmlspecialchars($file['id']).'"></td>';
    }
    
    echo '<td><input type="checkbox" class="delete-checkbox" value="'.htmlspecialchars($file['id']).'"></td>';
    echo '</tr>';
}
?>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  