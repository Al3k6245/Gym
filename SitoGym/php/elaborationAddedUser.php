<?php
session_start();
/*
$data_stringa = getDataDiNascita("SCHLSN05B41L840W");
$timestamp = strtotime($data_stringa);
$data_convertita = DateTime::createFromFormat('Y-m-d', $timestamp);

$nuova_data = date_add($data_convertita, new DateInterval('P1M'));

echo "Data prima: ".$data_convertita;
echo "----------- Data dopo 1 mese: ".$nuova_data;
*/
//echo date_add(getDataDiNascita("SCHLSN05B41L840W"), new DateInterval('P1M'));


if(isset($_POST['Nome']) && isset($_POST['Cognome']) /* etc...*/){
    $nome = $_POST['Nome'];
    $cognome = $_POST['Cognome'];
    $codiceFiscale = $_POST['CodiceFiscale'];
    $numeroTelefono = $_POST['NumeroTel'];
    $mail = $_POST['Mail'];
    $iban = $_POST['Iban'];

    $imgProfilo = NULL;
    $docIdentificativo = NULL;
    $certificazione = NULL;

    switch($_POST['Type']){

        case 'Cliente':
            createFolder('Iscritti', $_POST['Nome'], $_POST['Cognome']);
            mvFileFromTempToUserFolder($_POST['Nome'], $_POST['Cognome'], 'Cliente');        

            if(isset($_SESSION['documenti']['imgProfilo']))
                $imgProfilo = '../uploads/Iscritti/'.strtoupper($cognome)."_".strtoupper($nome).'/'.$_SESSION['documenti']['imgProfilo']; //session contiene nome file
            
            if(isset($_SESSION['documenti']['docIdentificativo']))
                $docIdentificativo = '../uploads/Iscritti/'.strtoupper($cognome)."_".strtoupper($nome).'/'.$_SESSION['documenti']['docIdentificativo'];

            $abbonamento = $_POST['AbbonamentoType'];

            insertIscrittoIntoDb($nome, $cognome, getDataDiNascita($codiceFiscale), $codiceFiscale, $numeroTelefono, $mail, $imgProfilo, $docIdentificativo, $abbonamento, $iban);
            break;

        case 'Allenatore':
            createFolder('Allenatori', $_POST['Nome'], $_POST['Cognome']);
            mvFileFromTempToUserFolder($_POST['Nome'], $_POST['Cognome'], 'Allenatore');

            if(isset($_SESSION['documenti']['imgProfilo']))
                $imgProfilo = '../uploads/Allenatori/'.strtoupper($cognome)."_".strtoupper($nome).'/'.$_SESSION['documenti']['imgProfilo']; //session contiene nome file
            
            if(isset($_SESSION['documenti']['docIdentificativo']))
                $docIdentificativo = '../uploads/Allenatori/'.strtoupper($cognome)."_".strtoupper($nome).'/'.$_SESSION['documenti']['docIdentificativo'];

            if(isset($_SESSION['documenti']['certificazione']))
                $certificazione = '../uploads/Allenatori/'.strtoupper($cognome)."_".strtoupper($nome).'/'.$_SESSION['documenti']['certificazione'];
            
            insertAllenatoreIntoDb($nome, $cognome, getDataDiNascita($codiceFiscale), $codiceFiscale, $numeroTelefono, $mail, $imgProfilo, $docIdentificativo, $certificazione, $iban);
            break;
    }

    foreach($_SESSION['documenti'] as $type => $nomeDoc){   //vado a liberare la sessione in modo che le prossime volte non mi prenda i file sbagliati
        unset($_SESSION['documenti'][$type]);  
    }

    header('Location: ../index.php');
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
        rename('../temp/'.$nomeDoc, '../uploads/'.$userTypeFolder.'/'.$userFolderName.'/'.$nomeDoc);  
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


function insertIscrittoIntoDb($nome, $cognome, $dataN, $codF, $numTel, $mail, $pathImgProfilo, $pathDocIdentificativo, $tipoAbbonamento, $iban){
    $conn = mysqli_connect('localhost','root','','gym');

    $query = "INSERT INTO iscritto (codF, nome, cognome, dataN, numTel, imgProfilo, mail, docIdentificativi, tipoAbbonamento, ScadenzaAbb, IBAN) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, DATE_ADD(CURRENT_DATE(), INTERVAL 1 MONTH), ?)";

    $stmt = $conn->prepare($query);
          
    if ($stmt === false) {
        //compare una finestra che dà errore
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit;
    }
    
    $stmt->bind_param("ssssssssss", $codF, $nome, $cognome, $dataN, $numTel, $pathImgProfilo, $mail, $pathDocIdentificativo, $tipoAbbonamento, $iban);

    $stmt->execute();
    $stmt->close();
    
    //$query = "INSERT INTO allenatori (codF, nome, cognome, dataN, numTel, imgProfilo, mail, docIdentificativi) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
}

function insertAllenatoreIntoDb($nome, $cognome, $dataN, $codF, $numTel, $mail, $pathImgProfilo, $pathDocIdentificativo, $certificazione, $iban){
    $conn = mysqli_connect('localhost','root','','gym');

    $query = "INSERT INTO allenatori (codF, nome, cognome, dataN, numTel, imgProfilo, mail, docIdentificativi, attCertificazione, IBAN) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
          
    if ($stmt === false) {
        //compare una finestra che dà errore
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit;
    }
    
    $stmt->bind_param("ssssssssss", $codF, $nome, $cognome, $dataN, $numTel, $pathImgProfilo, $mail, $pathDocIdentificativo, $certificazione, $iban);

    $stmt->execute();
    $stmt->close();
    
}
  


?>