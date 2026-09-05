// PymeGest - Fase 2
// Estructura de JavaScript y datos
// Archivo externo: variables, constantes, tipos de datos
// y arreglos utilizados por las funcionalidades dinámicas.


// CONSTANTES DEL PROYECTO

const NOMBRE_PLATAFORMA = "PymeGest";
const DESCRIPCION_CORTA = "Plataforma web para la gestión de pequeñas y medianas empresas";
const VERSION = "1.0.0";
const ANIO_CREACION = 2026;
const TIENE_PANEL_GRAFICO = true;


// VARIABLES DEL PROYECTO

// `let` se usa para valores que pueden cambiar
let empresaActiva = "Mi Empresa";
let totalEmpleados = 12;
let planPremium = false;

// Valores todavía sin asignar en la maquetación
let socioFundador = null;      // sin información registrada
let inversionInicial;          // undefined hasta asignar un valor


// TIPOS DE DATOS EN JAVASCRIPT

// Cadena de texto (string)
let tipoCadena = NOMBRE_PLATAFORMA;

// Número (number)
let tipoNumero = 25000;

// Booleano (boolean)
let tipoBooleano = TIENE_PANEL_GRAFICO;

// Null (valor vacío intencional)
let tipoNulo = null;

// Undefined (valor todavía no asignado)
let tipoIndefinido;

// Objeto (object): representa una empresa usuaria
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

// Símbolo (symbol): identificador único
let idUnico = Symbol("pymegest");


// ARREGLOS CON DATOS DE PYMEGEST

// Tipos de empresa que gestiona PymeGest
const tiposEmpresa = [
    "Microempresa",
    "Pequeña empresa",
    "Mediana empresa"
];

// Sectores empresariales atendidos
const sectoresEmpresariales = [
    "Comercio",
    "Servicios",
    "Tecnología",
    "Manufactura",
    "Agricultura",
    "Otro"
];

// Funcionalidades que ofrece la plataforma
const funcionalidadesPymeGest = [
    "Gestión de inventario",
    "Facturación",
    "Control de ventas",
    "Gestión de clientes",
    "Reportes y estadísticas",
    "Usuarios y roles"
];

// Arreglo de objetos: empresas registradas (datos de ejemplo)
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


// FUNCIONES UTILITARIAS (base para la Fase 2)

// Cuenta los elementos de un arreglo
function contarElementos(lista) {
    return lista.length;
}

// Convierte los nombres de las empresas en un solo texto
function listarEmpresas(lista) {
    return lista.map(empresa => empresa.nombre).join(", ");
}


// VERIFICACIÓN DE CARGA DEL ARCHIVO

console.log(NOMBRE_PLATAFORMA + " v" + VERSION + " cargado correctamente.");
console.log("Funcionalidades disponibles:", contarElementos(funcionalidadesPymeGest));
console.log("Empresas registradas:", listarEmpresas(empresasRegistradas));
