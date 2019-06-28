// This files contains any function that handles the notification logic
// in the application
//
// Author: Baradel Luca

// Closes a notification through an asynchornous request and then showing a toast notification
function close_notification(object, id) {

    // Asynchronous request to close the request, processed in home_controller.rb
    $.ajax({url: "notif/close/" + id, type: "POST"});

    var msg = "Non verrà più visualizzato.";
    toastNotif("close", msg);
    $(object.parentElement.parentElement).slideUp(); // object is the button, object.parent is the button div, object.parent.parent is the notif <li>
}

// Hides a notification through an asynchornous request and then showing a toast notification
function hide_notification(object, id) {

    // Asynchronous request to close the request, processed in home_controller.rb
    $.ajax({url: "notif/hide/" + id, type: "POST"})
    var msg = "Verrà visualizzata in seguito.";
    toastNotif("hide", msg);
    $(object.parentElement.parentElement).slideUp(); // object is the button, object.parent is the button div, object.parent.parent is the notif <li>
}