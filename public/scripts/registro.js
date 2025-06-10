// seleccionem elements necesaris
let password1 = document.getElementById('password1');
let password2 = document.getElementById('password2');
let condiciones = document.getElementById('condiciones');
let formulario = document.getElementById('registro');
let nombre = document.getElementById('nombre');
let email = document.getElementById('email');
let recuerdame = document.getElementById('recuerdame');

// funcio validar passwords
function validarPasswords() {
    if (password1.value !== password2.value) {
        password2.setCustomValidity("Las contraseñas no coinciden");
        return false;
    } else {
        password2.setCustomValidity('');
        return true;
    }
}

//escoltem events
password1.addEventListener('input', validarPasswords);
password2.addEventListener('input', validarPasswords);

//funcio terminos y condiciones
function validarCondiciones() {
    if (!condiciones.checked) {
        condiciones.setCustomValidity("Debes aceptar los términos y condiciones.");
        return false;
    } else {
        condiciones.setCustomValidity('');
        return true;
    }
}

// escoltem el estat del checkbox per a iniciar validacio
condiciones.addEventListener('change', validarCondiciones);

// validacio al enviar el formularis
formulario.addEventListener('submit', function (event) {
    let esValidoPasswords = validarPasswords();
    let esValidoCondiciones = validarCondiciones();

    // Si hi ha algun error return false, activem prventdefault
    if (!esValidoPasswords || !esValidoCondiciones || !formulario.checkValidity()) {
        event.preventDefault(); // Evita que senvie el formulari
    } else {
        // guardem les dades en local o storags depend de la opcio de recordarme
        if (recuerdame.checked) {
            //guardem en local si esta el check
            localStorage.setItem('nombre', nombre.value);
            localStorage.setItem('email', email.value);
        } else {
            // guardem soles en sesio actual
            sessionStorage.setItem('nombre', nombre.value);
            sessionStorage.setItem('email', email.value);
        }
        alert("Formulario enviado correctamente.");
    }
});

//recuperem dades guardades
function recuperarDatos() {
    // obtenim dades de local o sesion
    let nombreGuardado = localStorage.getItem('nombre') || sessionStorage.getItem('nombre');
    let emailGuardado = localStorage.getItem('email') || sessionStorage.getItem('email');

    if (nombreGuardado) {
        nombre.value = nombreGuardado; /*obtenim el dato a traves de value i li donem valor que hi ha local o sesion*/
    }
    if (emailGuardado) {
        email.value = emailGuardado;
    }

    // si esta en local el nombre y correo, marquem el checkbox
    if (localStorage.getItem('nombre') || sessionStorage.getItem('nombre')) {
        recuerdame.checked = true;
    }
}

// cridem la funncio per a carregar les dades si estan les dades guardats
recuperarDatos();
