<!-- Il seguente script php, riceve i dati da un form html e dopo aver testato la connessione con un db esegue una query
per inserire i dati in una tabella del db -->
<?php
// Salviamo i dati che ci arrivano dal form html in variabili php
$name = $_POST['name']; // va passato il valore dell'attributo "name" del file html che contiene quel dato
$linkToFile = $_POST['linkToFile'];
$section = $_POST['section'];
$tags = $_POST['tags'];
$version = $_POST['version'];
if (!empty($name) || !empty($linkToFile) || !empty($section) || !empty($version)) { // $tags puo essere vuoto
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "gdpr_database";
    // create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) { // connessione fallita
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }else{ // connessione ha successo
     $INSERT = "INSERT Into document_manager (dm_name, dm_link_to_file, dm_section, dm_tags, dm_version) values(?, ?, ?, ?, ?)";
     // Prepare statement
      $stmt = $conn->prepare($INSERT); // Prepariamo per INSERT
      $stmt->bind_param("sssss", $name, $linkToFile, $section, $tags, $version); // passo 5 stringhe (s)
      $stmt->execute();
      echo "New record inserted sucessfully";
      $stmt->close();
      $conn->close();
    }
}else{ // se le variabili sono vuote
 echo "All field are required";
 die();
}
?>