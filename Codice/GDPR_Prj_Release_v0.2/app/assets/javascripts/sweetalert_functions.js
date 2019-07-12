// This file handles every function of SweetAlert used in the application
// 
// Author: Baradel Luca

// This function is a sample for a notification of priority 3.
function midHighNotif() {
    Swal.fire({
        titleText: 'Evento con priorità Medio-alta !',
        text: "Questo evento ha priorità media. Va risolto al più presto!",
        type: "info",
        footer: "Uscire dall'evento lo riproporrà al prossimo accesso o visita",
        confirmButtonText: "Risolvi evento",
        showCancelButton: true,
        cancelButtonText: 'Posponi notifica',
        confirmButtonColor: '#1abc9c'
    })
}

// This function is a sample for a notification of priority 4.
function highNotif() {
    Swal.fire({
        titleText: 'Evento Alta Priorità!',
        text: "Evento ad alta priorità, va risolto istantaneamente!",
        confirmButtonText: 'Solve Event Now',
        allowOutsideClick: false,
        type: "warning",
        footer: "Uscire dalla pagina o ricaricare non fa evitare questa notifica.",
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

