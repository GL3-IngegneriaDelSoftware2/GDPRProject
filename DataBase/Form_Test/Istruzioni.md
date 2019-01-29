## Installazione XAMPP:

* Installare XAMPP (possibilmente ultima versione disponibile).

## Se hai già installato XAMPP:

* Andare sulla cartella xampp/htdocs e creare una nuova cartella: "test";
* All'interno di questa creare una nuova cartella: "document_manager";
* Inserire in questa cartella i file: insert.php, form.html, form.css;
* Avviare xampp-control-panel (si trova nella cartella xampp, nome del file: "xampp-control.exe") e cliccare Start su "Apache" e "MySQL";
* Aprire un browser (tassativamente CHROME) e nella barra di ricerca digitare "localhost";
* Cliccare in alto a destra su phpMyAdmin.

## Se non hai ancora inserito le tabelle:

* In alto c'è un elenco di funzionalità: "Database", "SQL", "Stato",...: cliccare su "Importa";
* Inserire il file in formato .sql presente su GitHub che contiene la costruzione del database e delle tabelle finora create per il progetto GDPR e cliccare "Esegui" in fondo alla pagina;
* Seguire la procedura (forse non sono necessari altri passi) e il db con le tabelle dovrebbe essere inserito.

## Se hai già inserito le tabelle:

* Apri una nuova scheda nel browser, digita "localhost/test/document_manager" e premi Invio;
* Clicca sul file denominato "form.html";
* Inserisci dei dati qualsiasi nel form e premi "Submit";
* Se non ci sono errori dovrebbe apparire la scritta "New record inserted succesfully";
* Per verificare il risultato digitare "localhost" sulla barra di ricerca;
* Cliccare in alto a destra su phpMyAdmin;
* Sulla sinistra è presente l'elenco dei database, cliccare su "gdpr_database" e cliccare sulla tabella "document_manager";
* Dovremmo vedere inseriti i dati che abbiamo inserito tramite il form (altrimenti provare a fare un refresh della pagina).








## Materiale utile (?)

User registration system con PHP e mysql database: https://www.youtube.com/watch?v=C--mu07uhQw

Displaying records from a MySQL Database with PHP: https://www.youtube.com/watch?v=IHdd02IK2Jg