/*Destinado ao menu responsivo*/
const navLogin = document.querySelector('div.nav-login');
const btnMenu = document.querySelector('div.menu-icon');
const closeButton = document.querySelector('div.menu-icon').children[0];

btnMenu.addEventListener('click', () => {
    navLogin.classList.toggle('active')
    
});