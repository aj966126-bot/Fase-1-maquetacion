const formulario = document.querySelector("form");

formulario.addEventListener("submit", function (evento) {
    evento.preventDefault();

    const nombre = document.querySelector("#nombre").value.trim();
    const apellido = document.querySelector("#apellido").value.trim();
    const correo = document.querySelector("#correo").value.trim();
    const telefono = document.querySelector("#telefono").value.trim();
    const mensaje = document.querySelector("#mensaje").value.trim();

    if (nombre === "") {
        alert("Por favor, ingresa tu nombre.");
        return;
    }

    if (apellido === "") {
        alert("Por favor, ingresa tu apellido.");
        return;
    }

    if (correo === "") {
        alert("Por favor, ingresa tu correo electrónico.");
        return;
    }

    if (!correo.includes("@")) {
        alert("Por favor, ingresa un correo electrónico válido.");
        return;
    }

    if (telefono === "") {
        alert("Por favor, ingresa tu teléfono.");
        return;
    }

    if (mensaje === "") {
        alert("Por favor, escribe un mensaje.");
        return;
    }

    alert("Formulario enviado correctamente.");
});