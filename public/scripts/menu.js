var enlaceMenu; // Variable per a guardar lenllaç del manu

// inicilitzem el menu
function iniciarMenu() 
{
    enlaceMenu = document.querySelector("nav>a"); // Seleccionem lenllaç ppal del menu (a de nav)
    enlaceMenu.addEventListener("click", despliegaMenu, false); //afegim un listener que escolta el click per a executar la funcio despliegaMenu
}

// desplega o amaga menu
function despliegaMenu()
{
    //seleccionem la llista i canviem la classe 'desplegado'
    // aquesta clase esta en CSS per a mostrar o amagar el menu
    document.querySelector("nav>ul").classList.toggle('desplegado');
}

//quan estiga carregada inicialitzem menu
window.addEventListener("load", iniciarMenu, false);
