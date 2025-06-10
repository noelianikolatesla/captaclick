// seleccionem el canvas  
const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");

// variables animacio
let posicionCasaX = 130; // posicio inicial casa
let posicionCasaYBase = 30; // altura base de la casa 
let amplitudSalto = 6; // altura maxima dle bot
let frecuenciaSalto = 0.1; // frecuencia del bot

//funcio pintar
function pintarCasa(x, y) {
  // base casa
  ctx.fillStyle = "#FFA500"; // tarornja
  ctx.fillRect(x, y, 30, 50); // (x, y, width, height)

  // sostre de la casa
  ctx.fillStyle = "#8B0000"; //roig
  ctx.beginPath();
  ctx.moveTo(x, y); // canto superior esquerra
  ctx.lineTo(x + 25, y - 25); // pico
  ctx.lineTo(x + 50, y); // canto superior dreta
  ctx.closePath();
  ctx.fill();

  // porta
  ctx.fillStyle = "#654321"; // marro
  ctx.fillRect(x + 15, y + 20, 20, 30); //porta
}

// funcio animacio
function animar() {
  // netejem el canvas
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  //calcul posicio vertical amb onda senoidal
  const posicionCasaY = posicionCasaYBase - Math.sin(posicionCasaX * frecuenciaSalto) * amplitudSalto;

  //dibuixem la casa en la posicio declara
  pintarCasa(posicionCasaX, posicionCasaY);

  //menejem la casa cap a la derecha
  posicionCasaX += 2;

  // cuan la casa arribe prop del logo (coordena x)
  if (posicionCasaX >= 475) {
    // parem el movimient horizontal 
    posicionCasaX = 0;
    return; // acabem la animacio
  }

  //cridem a la funcio de nou amb un frame de canvas drawing examples i codPen
  requestAnimationFrame(animar);
}

// inciar animacio al carregar la pagina, la cridem am funcio fletxa
window.addEventListener("load", () => {
  animar();
});
