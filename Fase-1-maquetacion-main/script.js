document.addEventListener('DOMContentLoaded', () => {
    // 1. Capturar el formulario y los elementos del DOM
    const formulario = document.querySelector('form') || document.getElementById('formulario');
    const mensajeErrorGeneral = document.getElementById('mensajeError');

    // 2. Componente dinámico: Buscador de sectores
    const buscadorSector = document.getElementById('buscadorSector');
    if (buscadorSector) {
        buscadorSector.addEventListener('input', buscarSector);
    }

    if (!formulario) return;

    // 3. Gestión del evento de envío del formulario
    formulario.addEventListener('submit', (event) => {
        // Evitar la recarga automática de la página
        event.preventDefault();

        // Obtención de valores
        const nombreInput = document.getElementById('nombre');
        const correoInput = document.getElementById('correo');
        const telefonoInput = document.getElementById('telefono');
        const empresaInput = document.getElementById('empresa');
        const sectorInput = document.getElementById('sector');
        const tamanoInput = document.getElementById('tamano');

        let esValido = true;

        // Limpiar errores previos visuales
        limpiarTodosLosErrores();

        // Validaciones individuales con mensajes específicos
        if (!nombreInput || nombreInput.value.trim() === '') {
            mostrarErrorCampo(nombreInput, 'El nombre es obligatorio.');
            esValido = false;
        }

        const patronCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!correoInput || correoInput.value.trim() === '') {
            mostrarErrorCampo(correoInput, 'El correo electrónico es obligatorio.');
            esValido = false;
        } else if (!patronCorreo.test(correoInput.value.trim())) {
            mostrarErrorCampo(correoInput, 'El correo electrónico no es válido.');
            esValido = false;
        }

        const patronTelefono = /^\(\d{3}\)\s\d{3}-\d{4}$/;
        if (!telefonoInput || telefonoInput.value.trim() === '') {
            mostrarErrorCampo(telefonoInput, 'El teléfono es obligatorio.');
            esValido = false;
        } else if (!patronTelefono.test(telefonoInput.value.trim())) {
            mostrarErrorCampo(telefonoInput, 'El formato correcto es (809) 000-0000.');
            esValido = false;
        }

        if (!empresaInput || empresaInput.value.trim() === '') {
            mostrarErrorCampo(empresaInput, 'El nombre de la empresa es obligatorio.');
            esValido = false;
        }

        if (!sectorInput || sectorInput.value === '') {
            mostrarErrorCampo(sectorInput, 'Selecciona un sector.');
            esValido = false;
        }

        if (!tamanoInput || tamanoInput.value === '') {
            mostrarErrorCampo(tamanoInput, 'Selecciona el tamaño de la empresa.');
            esValido = false;
        }

        // 4. Mostrar respuesta visual en el DOM
        if (!esValido) {
            if (mensajeErrorGeneral) {
                mensajeErrorGeneral.style.color = '#e74c3c';
                mensajeErrorGeneral.textContent = 'Por favor, corrige los errores señalados en el formulario.';
            }
        } else {
            if (mensajeErrorGeneral) {
                mensajeErrorGeneral.style.color = '#2ecc71';
                mensajeErrorGeneral.textContent = '¡Formulario enviado correctamente!';
            }
            formulario.reset();
        }
    });

    // 5. Escuchar cambios para limpiar mensajes de error cuando el usuario corrija los datos
    const inputs = formulario.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            limpiarErrorCampo(input);
            if (mensajeErrorGeneral) mensajeErrorGeneral.textContent = '';
        });
    });
});

// Funciones auxiliares para manipulación del DOM
function mostrarErrorCampo(element, mensaje) {
    if (!element) return;
    limpiarErrorCampo(element);

    element.style.borderColor = '#e74c3c';
    const spanError = document.createElement('span');
    spanError.className = 'mensaje-error-campo';
    spanError.style.color = '#e74c3c';
    spanError.style.fontSize = '0.85rem';
    spanError.style.display = 'block';
    spanError.style.marginTop = '4px';
    spanError.textContent = mensaje;

    element.parentNode.appendChild(spanError);
}

function limpiarErrorCampo(element) {
    if (!element) return;
    element.style.borderColor = '';
    const errorPrevio = element.parentNode.querySelector('.mensaje-error-campo');
    if (errorPrevio) {
        errorPrevio.remove();
    }
}

function limpiarTodosLosErrores() {
    document.querySelectorAll('.mensaje-error-campo').forEach(el => el.remove());
    document.querySelectorAll('input, select, textarea').forEach(el => el.style.borderColor = '');
}

// Buscador dinámico de sectores
const sectores = ["Comercio", "Servicios", "Tecnología", "Manufactura", "Agricultura", "Otro"];

function buscarSector() {
    const filtroInput = document.getElementById("buscadorSector");
    const listaResultados = document.getElementById("resultadosSector");
    
    if (!filtroInput || !listaResultados) return;

    const filtro = filtroInput.value.toLowerCase();
    const resultados = sectores.filter(sector => sector.toLowerCase().includes(filtro));

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

