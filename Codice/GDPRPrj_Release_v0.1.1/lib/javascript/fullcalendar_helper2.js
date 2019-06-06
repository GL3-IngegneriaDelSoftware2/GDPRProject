// COSTRUTTORE dell'oggetto Event
function Event(title, start, end, color, flagRepetition, repetitionDay){
	var endArray = end.split('-');  // divido la data in anno mese giorno
	var endDate = new Date(endArray[0], endArray[1] - 1, endArray[2]); // js conta i mesi a partire da zero
	endDate.setDate(endDate.getDate() + 1); // sposto la data fine di un giorno perche fullcalendar ragiona in modo diverso
	// Campi che ci saranno in tutti gli eventi
	this.id = 4; // TODO passare
	this.title = title;
	this.color = color;
	this.url = 'http://localhost/dashboard/GDPRPrj_Release_v0.1/events/events_form.php'; // vado al form per l'update dell'evento su cui ho cliccato
	// Gestione campi che dipendono dalla ripetizione
	if(flagRepetition){ // se l'evento si ripete uso startRecur e endRecur invece di start e end
		this.startRecur = start; // con startRecur il campo this.start non serve
		this.endRecur = endDate; // con endRecur il campo this.end non serve
		this.daysOfWeek = repetitionDay; // un array di interi con 0 = Sunday, 1 = Monday,..., se non presente l'evento si ripete ogni giorno
	}else{ // se l'evento non si ripete uso il costruttore normale
		this.start = start;
		this.end = endDate;
	}
}

// Da "eventsTemp" che contiene gli eventi presi dal db costruisco un nuovo vettore js "events" con i dati che servono affinche gli eventi siano
// visualizzati nel calendario
var events = new Array();
			
for(var i = 0; i < eventsTemp.length; i+=5){
	var eventRepetition = eventsTemp[i+4]; // campo et_event_repeat della tabella event_typologies
	switch(eventRepetition) {
	  case "daily":
		events.push(new Event(eventsTemp[i], eventsTemp[i+1], eventsTemp[i+2], eventsTemp[i+3], true));
		break;
	  case "weekly":
		var d = new Date(eventsTemp[i+1]); // data di inizio dell'evento
		var a = new Array();
		a.push(d.getDay()); // a = array con all'interno il numero (0-6) del giorno della settimana in cui si ripete l'evento
		events.push(new Event(eventsTemp[i], eventsTemp[i+1], eventsTemp[i+2], eventsTemp[i+3], true, a));
		break;
	  case "monthly":
		events.push(new Event(eventsTemp[i], eventsTemp[i+1], eventsTemp[i+2], eventsTemp[i+3], false, [])); // TEMP come se fosse don't repeat
		break;
	  case "yearly":
		events.push(new Event(eventsTemp[i], eventsTemp[i+1], eventsTemp[i+2], eventsTemp[i+3], false, [])); // TEMP come se fosse don't repeat
		break;
	  default: // "don't repeat"
		events.push(new Event(eventsTemp[i], eventsTemp[i+1], eventsTemp[i+2], eventsTemp[i+3], false, []));
		break;
	} // switch
} // for

// FullCalendar configuration options
document.addEventListener('DOMContentLoaded', function() {
var calendarEl = document.getElementById('calendar');

var calendar = new FullCalendar.Calendar(calendarEl, {
	
	eventClick: function(event) {
		if (event.id) {
			//$.post(event.url, { fieldname : event.id});
			$.ajax({
			  url: event.url,
			  type: 'POST',
			  data: { user : 'Tommy' }
			});
			//return false;
		}
	},
  header: {
	left: 'prev,next today',
	center: 'title',
	right: 'month,agendaWeek,agendaDay,listWeek' // per la lista degli eventi della settimana
  },
  defaultDate: Date.now(),
  navLinks: true, // can click day/week names to navigate views
  editable: false,
  eventLimit: true, // allow "more" link when too many events
  events
});

calendar.render();

});
