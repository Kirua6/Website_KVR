<?php
// Téléchargement de fichiers
$db = new PDO('mysql:host=localhost;dbname=xibo', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['file'])) {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $filePath = '/documents/' . $fileName;

        // Vérifier si un fichier avec le même nom existe déjà dans la base de données
        $query = $db->prepare("SELECT COUNT(*) FROM documents WHERE file_name = ?");
        $query->execute([$fileName]);
        $fileCount = $query->fetchColumn();

        if ($fileCount > 0) {
            // Afficher un message d'erreur
            echo 'Un fichier avec le même nom existe déjà. Veuillez choisir un nom de fichier différent.';
        } else {
            // Déplacer le fichier téléchargé vers le répertoire /documents
            if (move_uploaded_file($file['tmp_name'], __DIR__ . $filePath)) {
                // Enregistrer le fichier dans la base de données
                $query = $db->prepare("INSERT INTO documents (file_name, file_path, file_type) VALUES (?, ?, ?)");
                $query->execute([$fileName, $filePath, $file['type']]);
            } else {
                // Afficher un message d'erreur en cas d'échec du déplacement du fichier
                echo 'Une erreur s\'est produite lors du téléchargement du fichier. Veuillez réessayer.';
            }
        }
    } else {
        // Afficher un message d'erreur si aucun fichier n'est sélectionné
        echo 'Aucun fichier sélectionné. Veuillez choisir un fichier à télécharger.';
    }
}
?>

<!--   _  ____     __ ___
      | |/ /\ \   / /| __ \
      | ' /  \ \ / / | |_) |
      | . \   \ V /  |  _ /
      |_|\_\   \_/   |_| \_\ -->  
