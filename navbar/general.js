console.log('connecté !');
// Je selectionne et je stocke
// l'icone 
const icone = document.querySelector('.navbar-mobile i');
console.log(icone); 
//la DIV modal
const modal = document.querySelector('.modal');
console.log(modal);
//je soumets l'action au clic
icone.addEventListener('click', function(){
    console.log("icone cliquée");
    modal.classList.toggle('change-modal');
    icone.classList.toggle('fa-times');
});

document.querySelector('.btn-success');
// Je selectionne et je stocke
//bouton .btn-success
const btnSuccess = document.querySelector('.btn-success');
console.log(btnSuccess);
// DIV cookies
const cookies = document.querySelector('.cookies');
console.log(cookies);
btnSuccess.addEventListener('click', function(){
    console.log('bouton cliqué');
    cookies.style.opacity = "0";
});

/* _  ____     __ ___
  | |/ /\ \   / /| __ \
  | ' /  \ \ / / | |_) |
  | . \   \ V /  |  _ /
  |_|\_\   \_/   |_| \_\ */  