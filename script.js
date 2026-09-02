// ==========================================
// PymeGest - Fase 2
// Interactividad del lado cliente con JavaScript
// ==========================================


// ==========================================
// FUNCIONES REUTILIZABLES
// ==========================================

// Verifica si un campo de texto está vacío
function estaVacio(valor) {
    return valor.trim() === "";
}


// Valida el formato del correo electrónico
function validarCorreo(correo) {
    const patronCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return patronCorreo.test(correo);
}


// Valida teléfonos dominicanos
// Formatos permitidos:
// (809) 000-0000
// (829) 000-0000
// (849) 000-0000
function validarTelefono(telefono) {
    const patronTelefono = /^\((809|829|849)\)\s\d{3}-\d{4}$/;
    return patronTelefono.test(telefono);
}


// Filtra los sectores según el texto introducido
function filtrarSectores(filtro, listaSectores) {
    return listaSectores.filter(sector =>
        sector.toLowerCase().includes(filtro.toLowerCase())
    );
}


// ==========================================
// MENSAJES DEL FORMULARIO
// ==========================================

// Muestra un mensaje de error
function mostrarError(mensaje) {
    const contenedor = document.getElementById("mensajeError");

    if (contenedor) {
        contenedor.textContent = mensaje;
        contenedor.classList.add("error");
        contenedor.classList.remove("exito");
    }
}


// Muestra un mensaje de confirmación
function mostrarConfirmacion(mensaje) {
    const contenedor = document.getElementById("mensajeError");

    if (contenedor) {
        contenedor.textContent = mensaje;
        contenedor.classList.add("exito");
        contenedor.classList.remove("error");
    }
}


// Limpia los mensajes anteriores
function limpiarMensaje() {
    const contenedor = document.getElementById("mensajeError");

    if (contenedor) {
        contenedor.textContent = "";
        contenedor.classList.remove("error", "exito");
    }
}


// ==========================================
// VALIDACIÓN DEL FORMULARIO
// ==========================================

function validarFormulario() {

    limpiarMensaje();

    const nombre = document.getElementById("nombre").value.trim();
    const correo = document.getElementById("correo").value.trim();
    const telefono = document.getElementById("telefono").value.trim();
    const empresa = document.getElementById("empresa").value.trim();
    const sector = document.getElementById("sector").value;
    const tamano = document.getElementById("tamano").value;


    // Validar campos obligatorios
    if (
        estaVacio(nombre) ||
        estaVacio(correo) ||
        estaVacio(telefono) ||
        estaVacio(empresa) ||
        sector === "" ||
        tamano === ""
    ) {
        mostrarError(
            "Por favor, completa todos los campos obligatorios."
        );

        return false;
    }


    // Validar correo electrónico
    if (!validarCorreo(correo)) {
        mostrarError(
            "Por favor, introduce un correo electrónico válido."
        );

        return false;
    }


    // Validar teléfono
    if (!validarTelefono(telefono)) {
        mostrarError(
            "El teléfono debe tener el formato (809) 000-0000, (829) 000-0000 o (849) 000-0000."
        );

        return false;
    }


    // Si todas las validaciones son correctas
    mostrarConfirmacion(
        "Formulario validado correctamente. Gracias por completar la información."
    );

    // Evita que la página se recargue
    return false;
}


// ==========================================
// COMPONENTE DINÁMICO
// BUSCADOR DE SECTORES
// ==========================================

const sectores = [
    "Comercio",
    "Servicios",
    "Tecnología",
    "Manufactura",
    "Agricultura",
    "Otro"
];


function buscarSector() {

    const buscador = document.getElementById("buscadorSector");
    const listaResultados = document.getElementById("resultadosSector");

    // Evita errores si los elementos no existen
    if (!buscador || !listaResultados) {
        return;
    }


    const filtro = buscador.value.trim();

    // Limpiar resultados anteriores
    listaResultados.innerHTML = "";


    // Si el buscador está vacío, no mostrar resultados
    if (filtro === "") {
        return;
    }


    // Filtrar sectores
    const resultados = filtrarSectores(filtro, sectores);


    // Si no existen coincidencias
    if (resultados.length === 0) {

        const li = document.createElement("li");
        li.textContent = "No se encontraron resultados.";

        listaResultados.appendChild(li);

        return;
    }


    // Mostrar los sectores encontrados
    resultados.forEach(sector => {

        const li = document.createElement("li");
        li.textContent = sector;

        listaResultados.appendChild(li);
    });
}