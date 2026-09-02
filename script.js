// Valida los campos del formulario antes de enviar
function validarFormulario() {
    const nombre = document.getElementById("nombre").value.trim();
    const correo = document.getElementById("correo").value.trim();
    const telefono = document.getElementById("telefono").value.trim();
    const empresa = document.getElementById("empresa").value.trim();
    const sector = document.getElementById("sector").value;
    const tamano = document.getElementById("tamano").value;

    let mensajeError = "";

    // Validar campos vacíos
    if (nombre === "" || correo === "" || telefono === "" || empresa === "" || sector === "" || tamano === "") {
        mensajeError = "Por favor, completa todos los campos obligatorios.";
    } else {
        // Validar correo
        const patronCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!patronCorreo.test(correo)) {
            mensajeError = "El correo electrónico no es válido.";
        }

        // Validar teléfono en formato (809) 000-0000
        const patronTelefono = /^\(\d{3}\)\s\d{3}-\d{4}$/;
        if (!patronTelefono.test(telefono)) {
            mensajeError = "El teléfono debe tener el formato (809) 000-0000.";
        }
    }

    if (mensajeError !== "") {
        mostrarError(mensajeError);
        return false;
    }

    limpiarMensaje();
    mostrarConfirmacion("Formulario enviado correctamente ✅");
    return true;
}

// Muestra un mensaje de error en pantalla
function mostrarError(mensaje) {
    document.getElementById("mensajeError").textContent = mensaje;
}

// Limpia el mensaje de error
function limpiarMensaje() {
    document.getElementById("mensajeError").textContent = "";
}

// Muestra un mensaje de confirmación
function mostrarConfirmacion(mensaje) {
    alert(mensaje);
}

// -------------------------------
// Componente dinámico: Buscador de sectores
// -------------------------------

// Arreglo de sectores disponibles
const sectores = ["Comercio", "Servicios", "Tecnología", "Manufactura", "Agricultura", "Otro"];

// Filtra los sectores según el texto ingresado
function buscarSector() {
    const filtro = document.getElementById("buscadorSector").value.toLowerCase();
    const resultados = sectores.filter(sector => sector.toLowerCase().includes(filtro));

    const listaResultados = document.getElementById("resultadosSector");
    listaResultados.innerHTML = "";

    if (resultados.length === 0) {
        listaResultados.innerHTML = "<li>No se encontraron resultados</li>";
    } else {
        resultados.forEach(sector => {
            const li = document.createElement("li");
            li.textContent = sector;
            listaResultados.appendChild(li);
        });
    }
}
