/* El control de reproduccio mitjançant la barra que tenim davall del video.
Si polsem en qualsevol punt de la barra, la reproduccio del vídeo es moura fins a eixe punt */
function redimensionaBarra()
{
	if(!medio.ended)
	{
		var total=parseInt(medio.currentTime*maximo / medio.duration);
		progreso.style.width=total+'px';
	}
	else
	{
		progreso.style.width='0px';
		play.value='\u25BA';
		window.clearInterval(bucle);
	}
}

function desplazarMedio(e)
{
	if(!medio.paused && !medio.ended)
	{
		var ratonX=e.pageX-barra.offsetLeft;
		var nuevoTiempo=ratonX*medio.duration/maximo;
		medio.currentTime=nuevoTiempo;
		progreso.style.width=ratonX+'px';
	}
}

/* Si polsem el boto play, s'iniciara la reproduccio del video, i si tornem a polsar-lo, es posara en pausa */
function accionPlay()
{
	if(!medio.paused && !medio.ended) 
	{
		medio.pause();
		play.value='\u25BA';
		window.clearInterval(bucle);
	}
	else
	{
		medio.play();
		play.value='||';
		bucle=setInterval(redimensionaBarra, 1000);
	}
}

/* En polsar el boto reiniciar, si el video esta iniciat, es reiniciara, as a dir, començara a reproduir-se des del principi */
function accionReiniciar()
{
	progreso.style.width=0;
	medio.currentTime=0;
	medio.play();
	play.value='||';
}

/* En polsar el botó retrasar, la reproduccio del vídeo retrocedira 5 segons */
function accionRetrasar()
{
	medio.currentTime=medio.currentTime-5;
}

/* En polsar el boto adelantar, la reproduccio del video avançara 5 segons */
function accionAdelantar()
{
	medio.currentTime=medio.currentTime+5;
}

/* En polsar el boto silenciar, el so del video es desactivara, i el text del boto canviara a "escoltar".
En tornar a polsar el boto, el so s'activara i el text tornara a ser "silenciar". */
function accionSilenciar()
{
	if(!medio.muted) 
	{
		medio.muted=true;
		silenciar.value="escoltar";
	}
	else
	{
		medio.muted=false;
		silenciar.value="silenciar";
	}	
}

/* En polsar el boto bajarVolumen, es baixarà el volum del vídeo 0.1 punts. Si el volum arriba a 0 punts, no farem res. */
function bajarVolumen()
{
	if (  medio.volume >=0 && medio.volume <= 1 ) {
	
	medio.volume = medio.volume-0.1;
	
	}
}

/* En polsar el boto masVolumen, es pujara el volum del video 0.1 punts. Si el volum arriba a 1 punt, no farem res. */
function subirVolumen()
{
	if (  medio.volume >=0 && medio.volume <= 1 ) {
		medio.volume = medio.volume+0.1;
		}
}

function iniciar() 
{
	maximo=700;
	
	/* obtindre els objectes dels elements necessaris */
	medio=document.getElementById('medio');
	barra=document.getElementById('barra');
	progreso=document.getElementById('progreso');
	play=document.getElementById('play');
	reiniciar=document.getElementById('reiniciar');
	retrasar=document.getElementById('retrasar');
	adelantar=document.getElementById('adelantar');
	silenciar=document.getElementById('silenciar');
	menosVolumen=document.getElementById('menosVolumen');
	masVolumen=document.getElementById('masVolumen');

	/* crear els manejadors d'events per als botons */
	play.addEventListener('click', accionPlay, false);
	reiniciar.addEventListener('click', accionReiniciar, false);
	retrasar.addEventListener('click', accionRetrasar, false);
	adelantar.addEventListener('click', accionAdelantar, false);
	silenciar.addEventListener('click', accionSilenciar, false);
	menosVolumen.addEventListener('click', bajarVolumen, false);
	masVolumen.addEventListener('click', subirVolumen, false);
	/* crear el manejador d'esdeveniments per a la barra de desplaçament */
	barra.addEventListener('click', desplazarMedio, false);
}

window.addEventListener('load', iniciar, false);
