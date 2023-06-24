// Le script JQuery est exécuté lorsque le document est prêt
$(document).ready(function(){

// L'événement "submit" du formulaire est capturé pour empêcher son comportement par défaut
    $("form").on("submit", function(event){
        event.preventDefault();

// Envoi d'une requête Ajax au serveur
    $.ajax({
        url: 'envoyer_meteo.php', // L'URL du script PHP qui traitera la requête
        type: 'post', // Méthode HTTP utilisée
        data: $(this).serialize(), // Les données du formulaire sont sérialisées et envoyées avec la requête
        success: function(data) { // Fonction à exécuter si la requête réussit
            alert('La localisation a été envoyée avec succès'); // Afficher un message d'alerte
            $('#location').val(''); // Réinitialiser le champ "location"
            $('#week_start_date').val(''); // Réinitialiser le champ "week_start_date"
        },
        error: function() { // Fonction à exécuter si la requête échoue
            alert('Une erreur est survenue lors de l\'envoi de la localisation'); // Afficher un message d'alerte
        }
        });
    });
});

/*Objectif de JQuery.js : 
Capture l'événement de soumission d'un formulaire, empêche son comportement par défaut (le rechargement de la page).
Envoie les données du formulaire au serveur en utilisant une requête AJAX. 
Si la requête réussit, un message d'alerte est affiché et les champs du formulaire sont réinitialisés. 
Si la requête échoue, un autre message d'alerte est affiché.*/

/*   _  ____     __ ___
    | |/ /\ \   / /| __ \
    | ' /  \ \ / / | |_) |
    | . \   \ V /  |  _ /
    |_|\_\   \_/   |_| \_\ */