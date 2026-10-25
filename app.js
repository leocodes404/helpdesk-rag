document.addEventListener("DOMContentLoaded", () => {
    const enlaces = document.querySelectorAll(".menu-navegacion a");
    const vistas = document.querySelectorAll(".vista-modulo");

    const mostrarVista = (id) => {
        const vista = document.getElementById(id);
        if (!vista) return;

        vistas.forEach((elemento) => {
            elemento.classList.toggle("oculto", elemento !== vista);
        });

        enlaces.forEach((enlace) => {
            enlace.classList.toggle("activo", enlace.getAttribute("href") === "#" + id);
        });
    };

    enlaces.forEach((enlace) => {
        enlace.addEventListener("click", (evento) => {
            evento.preventDefault();
            const id = enlace.getAttribute("href").slice(1);
            mostrarVista(id);
            window.history.replaceState(null, "", "#" + id);
        });
    });

    if (vistas.length) {
        const idInicial = window.location.hash.slice(1);
        const vistaInicial = document.getElementById(idInicial);
        mostrarVista(vistaInicial ? idInicial : vistas[0].id);
    }

    const botonCopiar = document.getElementById("btn-copiar-solucion");
    const propuesta = document.getElementById("ia-propuesta-texto");
    const solucion = document.getElementById("solucion");

    if (botonCopiar && propuesta && solucion) {
        botonCopiar.addEventListener("click", async () => {
            const texto = propuesta.innerText.trim();
            solucion.value = texto;
            solucion.focus();

            try {
                await navigator.clipboard.writeText(texto);
            } catch {
                solucion.select();
                document.execCommand("copy");
                solucion.setSelectionRange(solucion.value.length, solucion.value.length);
            }
        });
    }
});
