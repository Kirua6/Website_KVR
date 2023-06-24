<?php //suppression des fichiers
$db = new PDO('mysql:host=localhost;dbname=xibo', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = json_decode(file_get_contents('php://input'), true);
    foreach ($ids as $id) {
        // Récupérer les détails du fichier de la base de données
        $query = $db->prepare("SELECT * FROM documents WHERE id = ?");
        $query->execute([$id]);
        $file = $query->fetch(PDO::FETCH_ASSOC);

        // Supprimer le fichier de la base de données
        $query = $db->prepare("DELETE FROM documents WHERE id = ?");
        $query->execute([$id]);

        // Supprimer le fichier du système de fichiers
        $fileFullPath = __DIR__ . $file['file_path'];
        if (file_exists($fileFullPath)) {
            unlink($fileFullPath);
        }
    }
}

/*   _  ____     __ ___
    | |/ /\ \   / /| __ \
    | ' /  \ \ / / | |_) |
    | . \   \ V /  |  _ /
    |_|\_\   \_/   |_| \_\ */  
