// This files contains any function that handles the notification logic
// in the application
//
// Author: Baradel Luca

// Closes a notification through an asynchornous request and then showing a toast notification
function close_notification(object, id) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "lib/PHP/notif_manager.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("operation=close&notifToHideId=" + id);

    var msg = "Non verrà più visualizzato.";
    toastNotif("close", msg);
    $(object.parentElement).slideUp();
}

// Hides a notification through an asynchornous request and then showing a toast notification
function hide_notification(object, id) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "lib/PHP/notif_manager.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("operation=hide&notifToHideId=" + id);

    var msg = "Verrà visualizzata in seguito.";
    toastNotif("hide", msg);
    $(object.parentElement).slideUp();
}