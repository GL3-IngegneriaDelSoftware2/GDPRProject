
function close_notification(object, id) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "lib/PHP/notif_manager.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("operation=close&notifToHideId=" + id);

    var msg = "Non verrà più visualizzato.";
    toastNotif("close", msg);
    $(object.parentElement).slideUp();
}

function hide_notification(object, id) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "lib/PHP/notif_manager.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("operation=hide&notifToHideId=" + id);

    var msg = "Verrà visualizzata in seguito.";
    toastNotif("hide", msg);
    $(object.parentElement).slideUp();
}

$(document).ready(function () {
    $(".footer").click(function () {
        $("#spoiler").toggle();
    });
});