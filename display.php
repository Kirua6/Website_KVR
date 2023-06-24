<?php
$db = new PDO('mysql:host=localhost;dbname=xibo', 'root', '');

// Récupérer l'ID du fichier à partir de la requête GET
$id = $_GET['id'];

// Récupérer les détails du fichier de la base de données
$query = $db->prepare("SELECT * FROM documents WHERE id = ?");
$query->execute([$id]);
$file = $query->fetch(PDO::FETCH_ASSOC);

// Construire le chemin complet du fichier
$fileFullPath = __DIR__ . $file['file_path'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Affichage du fichier</title>
    <link rel="stylesheet" href="CSS/display_documents.css" media="screen" type="text/css" >
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #image-container {
            max-width: 100%;
            max-height: 100%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
<a href="documents.php" id="retour-link">Retour</a>

    <div id="image-container">
    <?php
    // Afficher le contenu de l'image
    if ($file['file_type'] === 'image/jpeg' || $file['file_type'] === 'image/png' || $file['file_type'] === 'image/gif') {
        // Lire le contenu du fichier
        $fileContent = file_get_contents($fileFullPath);
        // Convertir le contenu en base64
        $base64Data = base64_encode($fileContent);
        // Créer le format de source d'image pour les données en base64
        $fileSrc = 'data:' . $file['file_type'] . ';base64,' . $base64Data;
        // Afficher l'image avec la source en base64
        echo '<img src="' . $fileSrc . '" alt="' . $file['file_name'] . '">';
    } else {
        // Afficher un message si le fichier n'est pas une image valide
        echo 'Le fichier sélectionné n\'est pas une image valide ou n\'existe pas.';
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