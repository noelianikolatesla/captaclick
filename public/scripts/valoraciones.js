document.addEventListener('DOMContentLoaded', () => {
	const mediaDiv = document.getElementById('media-valoraciones'); // contendor valora<cions
	let valoracionesArray = [5, 5, 4, 5, 4]; // array inicial

	//calculem mitja
	function calcularMedia() {
		if (valoracionesArray.length === 0) {
			mediaDiv.textContent = `Media: No hay valoraciones`;
			return;
		}

		// amb reduce recorre el array y suma el array acumulant
		const suma = valoracionesArray.reduce((acc, val) => acc + val, 0);
		const media = (suma / valoracionesArray.length).toFixed(1);

        let fecha = new Date ().toLocaleDateString();
		//repetim amb estrelles el vaolr de lamitja
		const estrellas = '⭐'.repeat(Math.round(media)); 
		mediaDiv.innerHTML = `Valoraciones en tiempo REAL <br>
                              Media: ${estrellas} (${media})<br>
                              Fecha: ${fecha}`; // mostrem estrelles mitja i data
	}

	// cridem funcio
	calcularMedia();

	// actualitzarem la mitja quan senvie una nova valoracio capturant el submit del form
	const form = document.getElementById('form-valoracion');
	form.addEventListener('submit', (event) => {
		event.preventDefault(); 

		//obtenim la nova valoracio, la convertim a entero de base 10, capturant el valor de id valoracion
		const estrellas = parseInt(document.getElementById('valoracion').value, 10);


		// amb push agruegem al final la no va valoracio
		valoracionesArray.push(estrellas);

		// creem una targeta amb div, obtenitn el valor .value de cada id
		const nombre = document.getElementById('nombre').value;
		const comentario = document.getElementById('comentario').value;

		const nuevaValoracion = document.createElement('div');
		nuevaValoracion.classList.add('valoracion');
		nuevaValoracion.innerHTML = `
			<p><strong>${nombre}:</strong></p>
			<p>${comentario}</p>
			<p>${'⭐'.repeat(estrellas)}</p>
		`;

		// agreuem a la seccio valoracions amb appendchild
		const seccionValoraciones = document.getElementById('valoraciones');
		seccionValoraciones.appendChild(nuevaValoracion);

		// actualitzem la mitja criant la funcio calcular media
		calcularMedia();

		// netejem el formulari
		form.reset();
	});
});
