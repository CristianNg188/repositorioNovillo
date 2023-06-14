function eligeOpcion() {
    var opcion = this.id;
    switch (opcion) {
        case "opcionUsers":
            window.location.href = "index.php?action=listarUsuarios";
            break;
        case "opcionPistas":
            window.location.href = "index.php?action=listarPistas";
            break;
        case "opcionReservas":
            window.location.href = "index.php?action=listarReservas";
            break;
    }
}

document.getElementById("opcionUsers").addEventListener("click", eligeOpcion, false);
document.getElementById("opcionPistas").addEventListener("click", eligeOpcion, false);
document.getElementById("opcionReservas").addEventListener("click", eligeOpcion, false);