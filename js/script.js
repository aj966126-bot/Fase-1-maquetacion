// PymeGest - Fase 2
// Interactividad del lado cliente con JavaScript

// Datos generales del proyecto
const NOMBRE_PLATAFORMA = "PymeGest";
const DESCRIPCION_CORTA =
    "Plataforma web para la gestión de pequeñas y medianas empresas";
const VERSION = "1.0.0";
const ANIO_CREACION = 2026;
const TIENE_PANEL_GRAFICO = true;

// Variables del proyecto
let empresaActiva = "Mi Empresa";
let totalEmpleados = 12;
let planPremium = false;
let socioFundador = null;
let inversionInicial;

// Tipos de datos utilizados
let tipoCadena = NOMBRE_PLATAFORMA;
let tipoNumero = 25000;
let tipoBooleano = TIENE_PANEL_GRAFICO;
let tipoNulo = null;
let tipoIndefinido;

let empresaDemo = {
    nombre: "Ferretería El Constructor",
    sector: "Comercio",
    empleados: 8,
    activa: true,
    contacto: {
        correo: "contacto@elconstructor.com",
        telefono: "(809) 555-0000"
    }
};

let idUnico = Symbol("pymegest");

// Datos utilizados por PymeGest
const tiposEmpresa = [
    "Microempresa",
    "Pequeña empresa",
    "Mediana empresa"
];

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

const empresasRegistradas = [
    {
        nombre: "Ferretería El Constructor",
        sector: "Comercio",
        empleados: 8,
        plan: "Gratis"
    },
    {
        nombre: "Estudio Jurídico Valdez",
        sector: "Servicios",
        empleados: 15,
        plan: "Profesional"
    },
    {
        nombre: "TechSoluciones DR",
        sector: "Tecnología",
        empleados: 22,
        plan: "Profesional"
    }
];

// Funciones reutilizables
function estaVacio(valor) {
    return valor.trim() === "";
}

function validarCorreo(correo) {
    const patronCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return patronCorreo.test(correo);
}

function validarTelefono(telefono) {
    const patronTelefono = /^\((809|829|849)\)\s\d{3}-\d{4}$/;
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

function contarElementos(lista) {
    return lista.length;
}

function listarEmpresas(lista) {
    return lista
        .map(empresa => empresa.nombre)
        .join(", ");
}

// Mensajes del formulario
function obtenerContenedorMensaje() {
    return document.getElementById("mensajeError");
}

function mostrarError(mensaje) {
    const contenedor = obtenerContenedorMensaje();

    if (!contenedor) {
        return;
    }

    contenedor.textContent = mensaje;
    contenedor.classList.add("error");
    contenedor.classList.remove("exito");
}

function mostrarConfirmacion(mensaje) {
    const contenedor = obtenerContenedorMensaje();

    if (!contenedor) {
        return;
    }

    contenedor.textContent = mensaje;
    contenedor.classList.add("exito");
    contenedor.classList.remove("error");
}

function limpiarMensaje() {
    const contenedor = obtenerContenedorMensaje();

    if (!contenedor) {
        return;
    }

    contenedor.textContent = "";
    contenedor.classList.remove("error", "exito");
}

// Validación del formulario
function validarFormulario() {
    limpiarMensaje();

    const nombre = document.getElementById("nombre").value.trim();
    const correo = document.getElementById("correo").value.trim();
    const telefono = document.getElementById("telefono").value.trim();
    const empresa = document.getElementById("empresa").value.trim();
    const sector = document.getElementById("sector").value;
    const tamano = document.getElementById("tamano").value;

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

    if (!validarCorreo(correo)) {
        mostrarError(
            "Por favor, introduce un correo electrónico válido."
        );
        return false;
    }

    if (!validarTelefono(telefono)) {
        mostrarError(
            "El teléfono debe tener el formato (809) 000-0000, " +
            "(829) 000-0000 o (849) 000-0000."
        );
        return false;
    }

    mostrarConfirmacion(
        "Formulario validado correctamente. " +
        "Gracias por completar la información."
    );

    return false;
}

// Buscador dinámico de sectores
function buscarSector() {
    const buscador = document.getElementById("buscadorSector");
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

    const resultados = filtrarSectores(
        filtro,
        sectoresEmpresariales
    );

    if (resultados.length === 0) {
        const elemento = document.createElement("li");
        elemento.textContent =
            "No se encontraron resultados.";

        listaResultados.appendChild(elemento);
        return;
    }

    resultados.forEach(sector => {
        const elemento = document.createElement("li");
        elemento.textContent = sector;
        listaResultados.appendChild(elemento);
    });
}

// Buscador dinámico de funcionalidades
function crearTarjetaFuncionalidad(funcionalidad, indice) {
    const tarjeta = document.createElement("article");
    tarjeta.classList.add("tarjeta");

    const icono = document.createElement("div");
    icono.classList.add("icono");
    icono.textContent =
        String(indice + 1).padStart(2, "0");

    const titulo = document.createElement("h3");
    titulo.textContent = funcionalidad.nombre;

    const descripcion = document.createElement("p");
    descripcion.textContent = funcionalidad.descripcion;

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

    funcionalidades.forEach((funcionalidad, indice) => {
        const tarjeta = crearTarjetaFuncionalidad(
            funcionalidad,
            indice
        );

        contenedor.appendChild(tarjeta);
    });
}

function buscarFuncionalidad() {
    const buscador =
        document.getElementById("buscadorFuncionalidad");

    if (!buscador) {
        return;
    }

    const resultados = filtrarFuncionalidades(
        buscador.value.trim(),
        funcionalidadesPymeGest
    );

    renderizarFuncionalidades(resultados);
}

// Inicialización
function inicializarPymeGest() {
    const buscadorFuncionalidad =
        document.getElementById("buscadorFuncionalidad");

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

    console.log(
        "Funcionalidades disponibles:",
        contarElementos(funcionalidadesPymeGest)
    );

    console.log(
        "Empresas registradas:",
        listarEmpresas(empresasRegistradas)
    );
}

document.addEventListener(
    "DOMContentLoaded",
    inicializarPymeGest
);