<?php
session_start();

if(isset($_POST['Nome']) && isset($_POST['Cognome']) /* etc...*/){

    switch($_POST['Type']){

        case 'Cliente':
            $tipoUtente = 'Iscritti';
            break;

        case 'Allenatore':
            $tipoUtente = 'Allenatori';
            break;
    }

    createFolder($tipoUtente, $_POST['Nome'], $_POST['Cognome']);
    mvFileFromTempToUserFolder($_POST['Nome'], $_POST['Cognome'], $_POST['Type']);
}


function createFolder($tipoUtente, $nome, $cognome){
    $nome = strtoupper($nome);
    $cognome = strtoupper($cognome);

    $userFolderName = $cognome."_".$nome;

    $path = "../uploads/".$tipoUtente."/".$userFolderName;

    if(!file_exists($path)){
        mkdir($path);
    }
}

function mvFileFromTempToUserFolder($nome, $cognome, $userType){
    
    switch($userType){
        case 'Cliente':
            $userTypeFolder = 'Iscritti';
            break;
        case 'Allenatore':
            $userTypeFolder = 'Allenatori';
            break;
    }
        
    $userFolderName = strtoupper($cognome)."_".strtoupper($nome); 
    
    $filePath = "uploads/";

    foreach($_SESSION['documenti'] as $type => $nomeDoc){
        rename('../temp/'.$nomeDoc, '../uploads/'.$userTypeFolder.'/'.$userFolderName.'/'.$nomeDoc);  //capire perchè non mi sposta il documento nella cartella
    }
    
    
}

function getDataDiNascita($codiceFiscale) {
    // Controllo la lunghezza del codice fiscale
    if (strlen($codiceFiscale) != 16) {
      return "Codice fiscale non valido";
    }
  
    // Estraggo le informazioni dalla stringa
    $anno = substr($codiceFiscale, 6, 2);
    $mese = substr($codiceFiscale, 8, 1);
    $giorno = substr($codiceFiscale, 9, 2);
  
    // Conversione del mese dalla lettera al numero
    $mesi = array(
      "A" => "01",
      "B" => "02",
      "C" => "03",
      "D" => "04",
      "E" => "05",
      "H" => "06",
      "L" => "07",
      "M" => "08",
      "P" => "09",
      "R" => "10",
      "S" => "11",
      "T" => "12",
    );

    if($giorno >= 40){
        $giorno -= 40;        
    }
  
    // Controllo validità giorno
    if ($giorno < 1 || $giorno > 31) {
      return "Giorno di nascita non valido: ". $giorno;
    }
  
    // Restituisco la data di nascita
    return "$anno-$mesi[$mese]-$giorno";
  }
  
function insertIscrittoIntoDb($nome, $cognome, $dataN, $codF, $numTel, $mail, $pathDocIdentificativo, $pathCertificazione, $tipoAbbonamento){

}
  


?>