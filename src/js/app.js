
const menuHamburguer = () => {
    const menu = document.querySelector('.mobile-menu img');
    const nav  = document.querySelector('.navegacion');
    menu.setAttribute('title', 'Mostrar menu');

    const menuHeight = nav.scrollHeight;//calcula la altura del contenido en nav

    
    menu.addEventListener('click', () => {
        if(nav.classList.contains('show')){
            nav.classList.remove('show');
            nav.style.height = '0';
            menu.removeAttribute('title');
            return;
        }
        nav.classList.add('show');
        nav.style.height = menuHeight + 'px';
        menu.setAttribute('title', 'Mostrar menu');
    });
}

const darkMode = () => {
    const systemPreferencesDarkTheme = window.matchMedia('(prefers-color-scheme: dark)');

    if(systemPreferencesDarkTheme.matches){
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    const darkModeButton = document.querySelector('.dark-mode-button');
    darkModeButton.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    });
}

//funcion autoinvocada (IIFE) 
(() => {
    menuHamburguer();
    darkMode();
})();