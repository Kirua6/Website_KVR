// Récupération de l'élément HTML avec l'ID "pokeball" et stockage dans la variable "pokeBall"
var pokeBall = document.getElementById("pokeball");

// Déclenchement de l'animation de la bulle du Pokeball après un délai de 1 seconde (1000 millisecondes)
setTimeout(function() {
  
  // Ajout de la classe CSS "bubbleAnimation2" à l'élément avec l'ID "bubble"
  document.getElementById("bubble").className += " bubbleAnimation2";
  
  // Déclenchement de l'affichage de la flèche de la bulle après un délai de 200 millisecondes
  setTimeout(function() {
    
    // Modification de la propriété de style "opacity" de l'élément avec l'ID "bubbleArrow" pour lui donner une opacité de 1 (rendre la flèche visible)
    document.getElementById("bubbleArrow").style.opacity = 1;
    
  }, 200);
  
}, 1000);

//KVR

/*Objectif de pokeball.js : 
Faire une animation sur la bulle de la Pokeball après un délai de 1 seconde (ducoup, 1000 millisecondes).
On joue sur l'opacité.*/

/*   _  ____     __ ___
    | |/ /\ \   / /| __ \
    | ' /  \ \ / / | |_) |
    | . \   \ V /  |  _ /
    |_|\_\   \_/   |_| \_\ */