//OPEN AND CLOSE MENU

const drawer = document.querySelector('.nav');       
const drawer2 = document.querySelector('.content');       
const menuClose = document.querySelector('.button-menu');

menuClose.onclick = function(){
    drawer.classList.remove('nav-is-open');
}   

const menuOpen = document.querySelector('.button-menu');
menuOpen.onclick = function(){
    drawer.classList.toggle('nav-is-open');
    drawer2.classList.toggle('content-is-full');
}