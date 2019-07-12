// This file handles every function of SweetAlert used in the application
// 
// Author: Baradel Luca

// This function is a sample for a notification of priority 3.
function midHighNotif(name, description, notes, color, event_id) {
    Swal.fire({
        title: "<p style='color: " + color + "'>" + name + "</p>",
        text: description,
        type: "info",
        footer: notes,
        confirmButtonText: "Risolvi evento",
        confirmButtonColor: color
    }).then((result) => {
      if(result.value){
          $.ajax({url: "notif/close_important/" + event_id, type: "POST"});
      }
    })
}

// This function is a sample for a notification of priority 4.
function highNotif(name, description, notes, color, event_id) {
    Swal.fire({
        title: "<p style='color: " + color + "'>" + name + "</p>",
        text: description,
        allowOutsideClick: true,
        type: "warning",
        footer: notes,
        confirmButtonText: "Risolvi evento",
        confirmButtonColor: color
    }).then((result) => {
        if(result.value){
            $.ajax({url: "notif/close_important/" + event_id, type: "POST"});
        }
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

