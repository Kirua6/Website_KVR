// Obtention des éléments du DOM nécessaires
var form = document.getElementById('upload-form');
var input = document.getElementById('filesToUpload');
var uploadContainer = document.getElementById('upload-container');

// Fonction pour empêcher le comportement par défaut lors d'événements
function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

// Ajout des écouteurs d'événements pour prévenir les comportements par défaut lors des opérations de glisser-déposer
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    uploadContainer.addEventListener(eventName, preventDefaults, false);
});

// Fonction pour ajouter une classe lors du survol par le glisser-déposer
function highlight(e) {
    uploadContainer.classList.add('is-dragover');
}

// Fonction pour supprimer une classe lorsque le glisser-déposer n'est pas en cours
function unhighlight(e) {
    uploadContainer.classList.remove('is-dragover');
}

// Ajout des écouteurs d'événements pour la mise en évidence lors du survol par le glisser-déposer
['dragenter', 'dragover'].forEach(eventName => {
    uploadContainer.addEventListener(eventName, highlight, false);
});

// Ajout des écouteurs d'événements pour enlever la mise en évidence lors du glisser-déposer n'est pas en cours
['dragleave', 'drop'].forEach(eventName => {
    uploadContainer.addEventListener(eventName, unhighlight, false);
});

// Fonction pour gérer le dépôt des fichiers
function handleDrop(e) {
    var dt = e.dataTransfer;
    var files = dt.files;

    handleFiles(files);
}

// Ajout d'un écouteur d'événements pour le dépôt des fichiers
uploadContainer.addEventListener('drop', handleDrop, false);

// Fonction pour gérer les fichiers déposés
function handleFiles(files) {
    ([...files]).forEach(uploadFile);
}

// Fonction pour télécharger un fichier au serveur
function uploadFile(file) {
    var url = 'upload.php';
    var xhr = new XMLHttpRequest();
    var formData = new FormData();
    xhr.open('POST', url, true);

    // Gestionnaire d'événements pour la réponse de la requête AJAX
    xhr.addEventListener('readystatechange', function(e) {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Si le téléchargement a réussi, rechargez la liste de fichiers
            loadFileList();
        }
        else if (xhr.readyState == 4 && xhr.status != 200) {
            // En cas d'erreur, informez l'utilisateur
        }
    });

    formData.append('file', file);
    xhr.send(formData);
}

// Ajout d'un écouteur d'événements pour ouvrir la boîte de dialogue de téléchargement lors d'un clic sur le conteneur
uploadContainer.addEventListener('click', function() {
    input.click();
});

// Gestion des fichiers sélectionnés via la boîte de dialogue de téléchargement
input.addEventListener('change', function(e) {
    var files = e.target.files;
    handleFiles(files);
});

// Obtention des boutons et de la liste de fichiers du DOM
var useButton = document.getElementById('use-button');
var deleteButton = document.getElementById('delete-button');
var fileList = document.getElementById('file-list');

// Gestion du clic sur le bouton "Utiliser"
useButton.addEventListener('click', function() {
    var selectedFiles = Array.from(fileList.querySelectorAll('.use-checkbox:checked')).map(function(checkbox) {
        return checkbox.value;
    });

    // Vérifier qu'un seul fichier est sélectionné pour être utilisé
    if (selectedFiles.length !== 1) {
        alert('Veuillez sélectionner un seul fichier à utiliser.');
        return;
    }

    // Rediriger l'utilisateur vers une nouvelle page avec l'ID du fichier sélectionné dans l'URL
    window.location.href = 'documents.php?id=' + selectedFiles[0];
});

// Gestion du clic sur le bouton "Supprimer"
deleteButton.addEventListener('click', function() {
    var selectedFiles = Array.from(fileList.querySelectorAll('.delete-checkbox:checked')).map(function(checkbox) {
        return checkbox.value;
    });

    // Envoyer une requête au serveur pour supprimer les fichiers sélectionnés
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'delete.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(selectedFiles));

    // Recharger la liste de fichiers après la suppression
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            loadFileList();
        }
    };
});

// Fonction pour charger la liste de fichiers depuis le serveur
function loadFileList() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'file_list.php', true);
    xhr.send();

    // Mettre à jour la liste de fichiers à partir de la réponse du serveur
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            fileList.innerHTML = xhr.responseText;
        }
    };
}

// Charger la liste de fichiers lors du chargement de la page
loadFileList();

// Ajout d'un écouteur d'événements pour activer ou désactiver les boutons en fonction de la sélection des fichiers
fileList.addEventListener('change', function() {
    var selectedFilesUse = fileList.querySelectorAll('.use-checkbox:checked').length;
    var selectedFilesDelete = fileList.querySelectorAll('.delete-checkbox:checked').length;

    // Activer le bouton "Utiliser" si un fichier est sélectionné
    if (selectedFilesUse > 0) {
        useButton.removeAttribute('disabled');
    } else {
        useButton.setAttribute('disabled', '');
    }

    // Activer le bouton "Supprimer" si un ou plusieurs fichiers sont sélectionnés
    if (selectedFilesDelete > 0) {
        deleteButton.removeAttribute('disabled');
    } else {
        deleteButton.setAttribute('disabled', '');
    }
});

// KVR

/*Objectif de scripts.js : 
Gérer le téléchargement des fichiers vers le serveur.
Afficher la liste des fichiers.
Sélectionner et utiliser des fichiers spécifiques.
Supprimer les fichiers sélectionnés. 
Implémentation de fonctionnalités pour l'interface utilisateur : 
événements de glisser-déposer.
écouteurs d'événements pour mettre en évidence les éléments lors des interactions.*/

/*   _  ____     __ ___
    | |/ /\ \   / /| __ \
    | ' /  \ \ / / | |_) |
    | . \   \ V /  |  _ /
    |_|\_\   \_/   |_| \_\ */