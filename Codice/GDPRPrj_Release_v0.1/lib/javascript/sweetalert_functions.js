function midHighNotif() {
    Swal.fire({
        titleText: 'Evento con Medio-alta Priorità!',
        text: "Questo evento ha priorità media. Va risolto al più presto!",
        type: "info",
        footer: "Uscire dall'evento lo riproporrà al prossimo accesso o visita",
        confirmButtonText: "Risolvi evento",
        showCancelButton: true,
        cancelButtonText: 'Posponi notifica',
        confirmButtonColor: '#1abc9c'
    })
}

function highNotif() {
    Swal.fire({
        titleText: 'Evento Alta Priorità!',
        text: "Evento ad alta priorità, va risolto istantaneamente!",
        confirmButtonText: 'Solve Event Now',
        allowOutsideClick: false,
        type: "warning",
        footer: "Uscire dalla pagina o ricaricare non fa eveitare questa notifica.",
        confirmButtonText: "Risolvi evento ora",
        confirmButtonColor: '#1abc9c'
    })
}

// General function for toast notifications, more types can be added through the switch.
function toastNotif(type, msg) {
    switch (type) {
        case "hide":
            Swal.fire({
                toast: true,
                showConfirmButton: false,
                timer: 2000,
                title: "Evento nascosto!",
                html: "<p>" + msg + "</p>",
                type: "warning",
                position: "top-end"
            })
            break;

        case "close":
            Swal.fire({
                toast: true,
                showConfirmButton: false,
                timer: 2000,
                title: "Evento chiuso!",
                html: "<p>" + msg + "</p>",
                type: "success",
                position: "top-end"
            })
            break;

        case "test":
            Swal.fire({
                toast: true,
                showConfirmButton: false,
                timer: 2000,
                title: "Toast Test!",
                html: "<p>" + msg + "</p>",
                type: "success",
                position: "top-end"
            })
            break;

        default:
            break;
    }
}

function hiddenNotifs() {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "lib/PHP/notif_manager.php", true);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var msg = "Eventi nascosti = " + this.responseText;
            toastNotif("test", msg);
        }
    };
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("notifToHideId=3");

}

