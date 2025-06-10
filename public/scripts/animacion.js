function iniciar() {
    const assistant = document.querySelector(".assistant");
    // capturem el asitent y li donem el estil de la animacio
    assistant.style.animation = "zoom 4s forwards";
}

// ejecutem la funcio quan acaba de carregar, no antes
window.addEventListener("load", iniciar);

