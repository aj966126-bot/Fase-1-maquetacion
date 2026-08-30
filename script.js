// =============================================================
// PYMEGEST - script.js
// =============================================================

// -------------------------------
// Validación del formulario (Formulario.html)
// -------------------------------
function validarFormulario() {
    const nombre = document.getElementById("nombre").value.trim();
    const correo = document.getElementById("correo").value.trim();
    const telefono = document.getElementById("telefono").value.trim();
    const empresa = document.getElementById("empresa").value.trim();
    const sector = document.getElementById("sector").value;
    const tamano = document.getElementById("tamano").value;

    let mensajeError = "";

    if (nombre === "" || correo === "" || telefono === "" || empresa === "" || sector === "" || tamano === "") {
        mensajeError = "Por favor, completa todos los campos obligatorios.";
    } else {
        const patronCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!patronCorreo.test(correo)) {
            mensajeError = "El correo electrónico no es válido.";
        }

        const patronTelefono = /^\(\d{3}\)\s\d{3}-\d{4}$/;
        if (!patronTelefono.test(telefono)) {
            mensajeError = "El teléfono debe tener el formato (809) 000-0000.";
        }
    }

    if (mensajeError !== "") {
        document.getElementById("mensajeError").textContent = mensajeError;
        return false;
    }

    document.getElementById("mensajeError").textContent = "";
    alert("Formulario enviado correctamente");
    return true;
}


// =============================================================
// COMPONENTE DINÁMICO - FASE 2
// Buscador / filtro de funcionalidades de PymeGest
// =============================================================

// 1. Arreglo de datos de PymeGest (funcionalidades del sistema)
const funcionalidadesPymeGest = [
    {
        id: 1,
        titulo: "Gestión de ventas e inventario",
        descripcion: "Organización de las operaciones de ventas y control de las existencias."
    },
    {
        id: 2,
        titulo: "Clientes y proveedores",
        descripcion: "Centralización de información relacionada con clientes y proveedores."
    },
    {
        id: 3,
        titulo: "Reportes visuales",
        descripcion: "Presentación organizada de información para facilitar el análisis empresarial."
    },
    {
        id: 4,
        titulo: "Interfaz intuitiva",
        descripcion: "Diseño pensado para facilitar la interacción de los usuarios con la plataforma."
    },
    {
        id: 5,
        titulo: "Facturación",
        descripcion: "Organización de cotizaciones y facturas de manera sencilla."
    },
    {
        id: 6,
        titulo: "Usuarios y roles",
        descripcion: "Organización de usuarios y permisos dentro de la empresa."
    }
];

// 2. Función que pinta (renderiza) las tarjetas en el DOM
function renderizarFuncionalidades(lista) {
    const contenedor = document.getElementById("listaFuncionalidades");
    const mensajeSinResultados = document.getElementById("sinResultados");

    if (!contenedor) return; // por si esta página no tiene el componente

    // Limpiar el contenedor antes de volver a pintar
    contenedor.innerHTML = "";

    // Mostrar u ocultar el mensaje de "sin resultados"
    if (lista.length === 0) {
        mensajeSinResultados.hidden = false;
        return;
    }
    mensajeSinResultados.hidden = true;

    // Crear una tarjeta por cada funcionalidad usando el DOM
    lista.forEach(function (funcionalidad, indice) {
        const articulo = document.createElement("article");
        articulo.className = "tarjeta";

        const icono = document.createElement("div");
        icono.className = "icono";
        icono.textContent = String(indice + 1).padStart(2, "0");

        const titulo = document.createElement("h3");
        titulo.textContent = funcionalidad.titulo;

        const descripcion = document.createElement("p");
        descripcion.textContent = funcionalidad.descripcion;

        articulo.appendChild(icono);
        articulo.appendChild(titulo);
        articulo.appendChild(descripcion);

        contenedor.appendChild(articulo);
    });
}

// 3. Función que detecta lo escrito por el usuario y filtra el arreglo
function buscarFuncionalidad() {
    const campoBusqueda = document.getElementById("buscadorFuncionalidad");
    const texto = campoBusqueda.value.toLowerCase().trim();

    const resultados = funcionalidadesPymeGest.filter(function (funcionalidad) {
        return funcionalidad.titulo.toLowerCase().includes(texto) ||
               funcionalidad.descripcion.toLowerCase().includes(texto);
    });

    renderizarFuncionalidades(resultados);
}

// 4. Al cargar la página, pintar todas las funcionalidades y activar el evento
document.addEventListener("DOMContentLoaded", function () {
    const campoBusqueda = document.getElementById("buscadorFuncionalidad");

    if (campoBusqueda) {
        // Pintar el listado completo al iniciar
        renderizarFuncionalidades(funcionalidadesPymeGest);

        // Detectar lo que el usuario escribe (sin recargar la página)
        campoBusqueda.addEventListener("input", buscarFuncionalidad);
    }
});
