import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    // ✅ Ocultar mensaje de éxito después de 5 segundos
    const successMessage = document.querySelector('.alert-success');
    if (successMessage) {
        setTimeout(() => successMessage.style.display = 'none', 5000);
    }

    // ✅ Script dropdown de usuario
    const toggleMenu = document.getElementById('menu-toggle');
    const dropdownMenu = document.getElementById('dropdown-menu');

    if (toggleMenu && dropdownMenu) {
        toggleMenu.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
        });

        window.addEventListener('click', function (e) {
            if (!toggleMenu.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    }

    // ✅ Script hamburguesa + header expand/collapse
const hamburgerBtn = document.getElementById('hamburger-btn');
const mobileMenu = document.getElementById('mobile-menu');
const header = document.querySelector('header');

if (hamburgerBtn && mobileMenu && header) {
    const actualizarEstadoMenu = () => {
        if (window.innerWidth >= 768) {
            mobileMenu.classList.remove('hidden');
            header.classList.remove('expanded');
            mobileMenu.classList.remove('mobile-visible');
        } else {
            mobileMenu.classList.add('hidden');
            header.classList.remove('expanded');
            mobileMenu.classList.remove('mobile-visible');
        }
    };

    actualizarEstadoMenu();

    hamburgerBtn.addEventListener('click', () => {
        if (window.innerWidth < 768) {
            const isHidden = mobileMenu.classList.toggle('hidden');
            header.classList.toggle('expanded', !isHidden);
            mobileMenu.classList.toggle('mobile-visible', !isHidden);
        }
    });

    window.addEventListener('resize', actualizarEstadoMenu);
}


    // ✅ Enlace activo según hash
    const navLinks = document.querySelectorAll('.nav-menu a[href^="#"], .nav-menu a[href*="#"]');

    function updateActiveLink() {
        navLinks.forEach(link => link.classList.remove('active'));
        const hash = window.location.hash;
        if (hash) {
            const activeLink = document.querySelector(`.nav-menu a[href="${hash}"]`);
            if (activeLink) activeLink.classList.add('active');
        }
    }

    updateActiveLink();
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            setTimeout(updateActiveLink, 50);
        });
    });

    // ✅ Asistente virtual
     const asistente = document.getElementById('asistenteVirtual');
    const toggleBtn = document.getElementById('btnAsistente');
    const bocadillo = document.getElementById('bocadilloTexto');

    if (!asistente || !toggleBtn || !bocadillo) {
        console.warn('Elementos del asistente no encontrados.');
        return;
    }

    const frasesPorSeccion = {
        'what-we-do': 'Aquí te mostramos lo que hacemos en CaptaClick.',
        'kit-digital': 'Este es el apartado del Kit Digital, con ayudas para digitalizar tu inmobiliaria.',
        'trial': 'Aquí puedes probar CaptaClick gratis durante 14 días.',
        'contact': 'Contáctanos si tienes dudas. Estamos aquí para ayudarte.',
        'casos-exito': 'Descubre casos reales de éxito con CaptaClick.',
        'tariffs': 'Consulta nuestras tarifas disponibles.'
    };

    const offsetY = 200;
    let seccionAnterior = '';
    let hablarActivado = false;
    let textoActual = '';

    mostrarAsistente();
    bocadillo.innerText = '¡Hola! Soy tu asistente virtual. Si quieres escucharme, pulsa sobre el círculo.';
    textoActual = bocadillo.innerText;

    // Manejar clic en botón del asistente para activar/desactivar la voz
    toggleBtn.addEventListener('click', () => {
        hablarActivado = !hablarActivado;

        if (hablarActivado) {
            desbloquearVoz();
            hablar('Perfecto. A partir de ahora te hablaré mientras navegas por la página.');
        } else {
            speechSynthesis.cancel();
        }
    });

    window.addEventListener('scroll', () => {
        actualizarPosicionAsistente();

        for (const id in frasesPorSeccion) {
            const seccion = document.getElementById(id);
            if (seccion) {
                const rect = seccion.getBoundingClientRect();
                if (rect.top <= 200 && rect.bottom >= 200 && seccionAnterior !== id) {
                    seccionAnterior = id;
                    const texto = frasesPorSeccion[id];
                    bocadillo.innerText = texto;
                    textoActual = texto;
                    if (hablarActivado) {
                        hablar(texto);
                    }
                    break;
                }
            }
        }
    });

    function mostrarAsistente() {
        asistente.classList.remove('hidden');
        asistente.style.opacity = '1';
        asistente.style.transition = 'opacity 0.3s ease';
        actualizarPosicionAsistente();
    }

    function actualizarPosicionAsistente() {
        const btnRect = toggleBtn.getBoundingClientRect();
        const scrollTop = window.scrollY;
        const topPos = scrollTop + btnRect.top - offsetY;
        asistente.style.top = `${topPos}px`;
    }

    function desbloquearVoz() {
        if ('speechSynthesis' in window) {
            const unlock = new SpeechSynthesisUtterance(' ');
            speechSynthesis.speak(unlock);
        }
    }

    function hablar(texto) {
        if ('speechSynthesis' in window) {
            speechSynthesis.cancel();
            const utter = new SpeechSynthesisUtterance(texto);
            utter.lang = 'es-ES';
            utter.rate = 1;
            utter.pitch = 1;
            speechSynthesis.speak(utter);
        }
    }

    // Botón "Volver arriba"
    const btnVolverArriba = document.getElementById('btnVolverArriba');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            btnVolverArriba.classList.remove('hidden');
        } else {
            btnVolverArriba.classList.add('hidden');
        }
    });
    btnVolverArriba.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});

