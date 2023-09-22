//OPEN AND CLOSE MENU

const buttonMenu = document.querySelector('.button-menu');
const drawer = document.querySelector('.drawer');
buttonMenu.onclick = function(){
    drawer.classList.toggle('drawer--is-open');
}           

const menuClose = document.querySelector('.menu-close');
menuClose.onclick = function(){
    drawer.classList.remove('drawer--is-open');
}
