// ============================================================
// PymeGest - JavaScript principal
// Interactividad, validaciones y componentes dinámicos
// ============================================================


// ------------------------------------------------------------
// Datos generales del proyecto
// ------------------------------------------------------------

const NOMBRE_PLATAFORMA = "PymeGest";
const VERSION = "1.0.0";

const sectoresEmpresariales = [
    "Comercio",
    "Servicios",
    "Tecnología",
    "Manufactura",
    "Agricultura",
    "Otro"
];

const funcionalidadesPymeGest = [
    {
        nombre: "Gestión de inventario",
        descripcion:
            "Control de productos, existencias y movimientos de inventario."
    },
    {
        nombre: "Facturación",
        descripcion:
            "Organización de cotizaciones y facturas de manera sencilla."
    },
    {
        nombre: "Control de ventas",
        descripcion:
            "Registro y seguimiento de las operaciones comerciales."
    },
    {
        nombre: "Gestión de clientes",
        descripcion:
            "Organización de información y seguimiento de clientes."
    },
    {
        nombre: "Reportes y estadísticas",
        descripcion:
            "Información organizada para facilitar el análisis empresarial."
    },
    {
        nombre: "Usuarios y roles",
        descripcion:
            "Organización de usuarios y permisos dentro de la empresa."
    }
];


// ------------------------------------------------------------
// Funciones reutilizables
// ------------------------------------------------------------

function estaVacio(valor) {
    return valor.trim() === "";
}

function validarCorreo(correo) {
    const patronCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return patronCorreo.test(correo);
}

function validarTelefono(telefono) {
    const patronTelefono =
        /^\((809|829|849)\)\s\d{3}-\d{4}$/;

    return patronTelefono.test(telefono);
}

function filtrarSectores(filtro, sectores) {
    const texto = filtro.toLowerCase();

    return sectores.filter(sector =>
        sector.toLowerCase().includes(texto)
    );
}

function filtrarFuncionalidades(filtro, funcionalidades) {
    const texto = filtro.toLowerCase();

    return funcionalidades.filter(funcionalidad =>
        funcionalidad.nombre.toLowerCase().includes(texto) ||
        funcionalidad.descripcion.toLowerCase().includes(texto)
    );
}


// ------------------------------------------------------------
// Mensajes generales
// ------------------------------------------------------------

function obtenerContenedorMensaje() {
    return document.getElementById("mensajeError");
}

function mostrarMensaje(mensaje, tipo) {
    const contenedor = obtenerContenedorMensaje();

    if (!contenedor) {
        return;
    }

    contenedor.textContent = mensaje;
    contenedor.classList.remove("error", "exito");
    contenedor.classList.add(tipo);
}

function limpiarMensaje() {
    const contenedor = obtenerContenedorMensaje();

    if (!contenedor) {
        return;
    }

    contenedor.textContent = "";
    contenedor.classList.remove("error", "exito");
}


// ------------------------------------------------------------
// Validación individual de campos
// ------------------------------------------------------------

function mostrarErrorCampo(campo, mensaje) {
    campo.classList.add("campo-invalido");
    campo.setAttribute("aria-invalid", "true");

    const contenedorError =
        document.getElementById(`error-${campo.id}`);

    if (contenedorError) {
        contenedorError.textContent = mensaje;
    }
}

function limpiarErrorCampo(campo) {
    campo.classList.remove("campo-invalido");
    campo.removeAttribute("aria-invalid");

    const contenedorError =
        document.getElementById(`error-${campo.id}`);

    if (contenedorError) {
        contenedorError.textContent = "";
    }
}

function validarCampo(campo) {
    if (!campo) {
        return true;
    }

    limpiarErrorCampo(campo);

    const valor = campo.value.trim();

    switch (campo.id) {
        case "nombre":
            if (estaVacio(valor)) {
                mostrarErrorCampo(
                    campo,
                    "Escribe tu nombre completo."
                );
                return false;
            }
            break;

        case "correo":
            if (!validarCorreo(valor)) {
                mostrarErrorCampo(
                    campo,
                    "Introduce un correo electrónico válido."
                );
                return false;
            }
            break;

        case "telefono":
            if (!validarTelefono(valor)) {
                mostrarErrorCampo(
                    campo,
                    "Formato: (809) 000-0000, (829) 000-0000 o (849) 000-0000."
                );
                return false;
            }
            break;

        case "empresa":
            if (estaVacio(valor)) {
                mostrarErrorCampo(
                    campo,
                    "Escribe el nombre de tu empresa."
                );
                return false;
            }
            break;

        case "sector":
            if (valor === "") {
                mostrarErrorCampo(
                    campo,
                    "Selecciona el sector de la empresa."
                );
                return false;
            }
            break;

        case "tamano":
            if (valor === "") {
                mostrarErrorCampo(
                    campo,
                    "Selecciona el tamaño de la empresa."
                );
                return false;
            }
            break;
    }

    return true;
}


// ------------------------------------------------------------
// Validación completa del formulario
// ------------------------------------------------------------

function validarFormulario(evento) {
    const formulario =
        document.getElementById("formularioPymeGest");

    if (!formulario) {
        return;
    }

    limpiarMensaje();

    const campos = [
        document.getElementById("nombre"),
        document.getElementById("correo"),
        document.getElementById("telefono"),
        document.getElementById("empresa"),
        document.getElementById("sector"),
        document.getElementById("tamano")
    ];

    let formularioValido = true;

    campos.forEach(campo => {
        if (!validarCampo(campo)) {
            formularioValido = false;
        }
    });

    if (!formularioValido) {
        evento.preventDefault();

        mostrarMensaje(
            "Revisa los campos marcados antes de enviar el formulario.",
            "error"
        );

        const primerCampoInvalido =
            formulario.querySelector(".campo-invalido");

        if (primerCampoInvalido) {
            primerCampoInvalido.focus();
        }
    }
}


// ------------------------------------------------------------
// Buscador dinámico de sectores
// ------------------------------------------------------------

function buscarSector() {
    const buscador =
        document.getElementById("buscadorSector");

    const listaResultados =
        document.getElementById("resultadosSector");

    if (!buscador || !listaResultados) {
        return;
    }

    const filtro = buscador.value.trim();

    listaResultados.innerHTML = "";

    if (estaVacio(filtro)) {
        return;
    }

    const resultados =
        filtrarSectores(
            filtro,
            sectoresEmpresariales
        );

    if (resultados.length === 0) {
        const elemento =
            document.createElement("li");

        elemento.textContent =
            "No se encontraron resultados.";

        listaResultados.appendChild(elemento);

        return;
    }

    resultados.forEach(sector => {
        const elemento =
            document.createElement("li");

        elemento.textContent = sector;

        listaResultados.appendChild(elemento);
    });
}


// ------------------------------------------------------------
// Buscador dinámico de funcionalidades
// ------------------------------------------------------------

function crearTarjetaFuncionalidad(funcionalidad, indice) {
    const tarjeta =
        document.createElement("article");

    tarjeta.classList.add("tarjeta");

    const icono =
        document.createElement("div");

    icono.classList.add("icono");

    icono.textContent =
        String(indice + 1).padStart(2, "0");

    const titulo =
        document.createElement("h3");

    titulo.textContent =
        funcionalidad.nombre;

    const descripcion =
        document.createElement("p");

    descripcion.textContent =
        funcionalidad.descripcion;

    tarjeta.appendChild(icono);
    tarjeta.appendChild(titulo);
    tarjeta.appendChild(descripcion);

    return tarjeta;
}

function renderizarFuncionalidades(funcionalidades) {
    const contenedor =
        document.getElementById("listaFuncionalidades");

    const mensaje =
        document.getElementById("sinResultados");

    if (!contenedor || !mensaje) {
        return;
    }

    contenedor.innerHTML = "";

    if (funcionalidades.length === 0) {
        mensaje.hidden = false;
        return;
    }

    mensaje.hidden = true;

    funcionalidades.forEach(
        (funcionalidad, indice) => {
            const tarjeta =
                crearTarjetaFuncionalidad(
                    funcionalidad,
                    indice
                );

            contenedor.appendChild(tarjeta);
        }
    );
}

function buscarFuncionalidad() {
    const buscador =
        document.getElementById(
            "buscadorFuncionalidad"
        );

    if (!buscador) {
        return;
    }

    const resultados =
        filtrarFuncionalidades(
            buscador.value.trim(),
            funcionalidadesPymeGest
        );

    renderizarFuncionalidades(resultados);
}


// ------------------------------------------------------------
// Inicialización de PymeGest
// ------------------------------------------------------------

function inicializarPymeGest() {
    const formulario =
        document.getElementById(
            "formularioPymeGest"
        );

    if (formulario) {
        formulario.addEventListener(
            "submit",
            validarFormulario
        );

        const camposFormulario =
            formulario.querySelectorAll(
                "input[required], select[required]"
            );

        camposFormulario.forEach(campo => {
            campo.addEventListener(
                "blur",
                () => validarCampo(campo)
            );

            campo.addEventListener(
                "input",
                () => {
                    if (
                        campo.classList.contains(
                            "campo-invalido"
                        )
                    ) {
                        validarCampo(campo);
                    }
                }
            );

            campo.addEventListener(
                "change",
                () => {
                    if (
                        campo.classList.contains(
                            "campo-invalido"
                        )
                    ) {
                        validarCampo(campo);
                    }
                }
            );
        });

        formulario.addEventListener(
            "reset",
            () => {
                window.setTimeout(() => {
                    limpiarMensaje();

                    camposFormulario.forEach(
                        limpiarErrorCampo
                    );
                }, 0);
            }
        );
    }


    const buscadorSector =
        document.getElementById(
            "buscadorSector"
        );

    if (buscadorSector) {
        buscadorSector.addEventListener(
            "input",
            buscarSector
        );
    }


    const buscadorFuncionalidad =
        document.getElementById(
            "buscadorFuncionalidad"
        );

    if (buscadorFuncionalidad) {
        renderizarFuncionalidades(
            funcionalidadesPymeGest
        );

        buscadorFuncionalidad.addEventListener(
            "input",
            buscarFuncionalidad
        );
    }


    console.log(
        `${NOMBRE_PLATAFORMA} v${VERSION} cargado correctamente.`
    );
}


document.addEventListener(
    "DOMContentLoaded",
    inicializarPymeGest
);