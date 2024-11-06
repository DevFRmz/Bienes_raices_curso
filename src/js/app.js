
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

const adminMenuFilterShow = () => {    
    const vendedoresBtn = document.querySelector('.vendedores-filter-btn');
    const propiedadesBtn = document.querySelector('.propiedades-filter-btn');

    const vendedoresTable = document.querySelector('.administrar-vendedores');
    const propiedadesTable = document.querySelector('.administrar-propiedades');

    if(!vendedoresBtn || !propiedadesBtn) return;

    vendedoresBtn.addEventListener('click', () => {
        vendedoresTable.classList.remove('hidden');
        vendedoresBtn.classList.add('darken');
        
        propiedadesTable.classList.add('hidden');
        propiedadesBtn.classList.remove('darken');
    });

    propiedadesBtn.addEventListener('click', () => {
        propiedadesTable.classList.remove('hidden');
        propiedadesBtn.classList.add('darken');
        
        vendedoresTable.classList.add('hidden');
        vendedoresBtn.classList.remove('darken');
    });
}


//funcion autoinvocada (IIFE) 
(() => {
    menuHamburguer();
    darkMode();
    adminMenuFilterShow();
})();