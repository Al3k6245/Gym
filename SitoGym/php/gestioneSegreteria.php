<?php 
session_start();

if(!isset($conn)){
    $conn = mysqli_connect('localhost','segreteria','password','gym');
    
    if(!$conn){
        die("Connessione fallita: " . mysqli_connect_error());
    }
}


if(isset($_GET['index']) && isset($_GET['azione'])){   
    //è stata fatta una richiesta GET dall'ajax

    switch($_GET['azione']){
        case 'delMem':
            deleteMember($_GET['index'], $conn);
            showMembers($conn);
            break;
        case 'downloadFile':
            downloadFile(getFromDbFilePath($_GET['index'],$conn));
            break;
    }
        
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file']) && isset($_POST['index'])){
    addDocument($_POST['index'], $conn);
}
else{
    //implementare codice per far capire che il caricamento non è andato a buon fine
}


function showMembers($conn){
    $query = "SELECT nome, cognome, DataN, tipoAbbonamento, ScadenzaAbb, codF, mail, docIdentificativi FROM iscritto";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();

    $i = 1;   //ai vari pulsanti assegno un numero come id in modo da sapere che riga l'utente sta andando a scegliere

    if($result){
        while($row = $result->fetch_assoc()){
            printToScreen($row, $i);
            saveFiscalCodeOnSession($row['codF'], $i);  //salvare il codice fiscale permette di gestire più facilmente l'eliminazione dell'utente e altre features
            $i++;
        }
    }

    $stmt->close();
}

function printToScreen($row, $counter){

        print "
        <div class='badge'>
        <div class='immagineprofilo'></div>
        <div class='datipersonali'>
            <div class='tabella-intestazioni cognomenome'>" .$row['nome']. "" .$row['cognome']. "</div>
            <div class='tabella-intestazioni abbonamento'>" .$row['tipoAbbonamento']."</div>
        </div>
    </div>
    <div  class='tabella-testo'>".$row['ScadenzaAbb']."</div>
    <div class='action'>
    <a id='AddCertificato' class='icon add w-button' onclick='addFile(".$counter.")'>Button Text</a>
    <a href='".$row['docIdentificativi']."'class='icon download w-button' download>Button Text</a>
    <a href='uploads/GIT.pdf' class='icon download w-button' download>Button Text</a>
    </div>
    <div class='tabella-testo'>".$row['DataN']."</div>
    <div class='action'>
    <a href='#' class='icon allerta w-button'>Button Text</a>
    <a href='#' class='icon pericolo w-button'>Button Text</a>
    </div>
    <div class='action'>
    <a href='#' class='icon userdescrizioni w-button'>Button Text</a>
    <a href='mailto:".$row['mail']."' class='icon useremail w-button'>Button Text</a>
    <a id='$counter' class='icon userremove w-button' onclick='AjaxDeleteMember(".$counter.")'>Button Text</a>
    </div>
    ";
}

function saveFiscalCodeOnSession($fiscalCode, $counter){
    $_SESSION['Utenti'][$counter] = $fiscalCode;
}

function deleteMember($index, $conn){
    $query = "DELETE FROM iscritto WHERE codF = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_SESSION['Utenti'][$index]);

    $stmt->execute(); 
    $stmt->close();

    //eliminazione dalla sessione
    unset($_SESSION['Utenti'][$index]);
    $counter = 1;
    foreach ($_SESSION['Utenti'] as $key => $value) {
        $key = $counter;
        $counter++;
    }
}

function addDocument($index, $conn){

    if($_FILES['file']['error'] == 0){  //il file è stato caricato correttamente

        $filePath = 'uploads/'.$_FILES['file']['name'];  //al momento salvo tutti i file nella cartella uploads ma ci sarà da creare le cartelle per utente

        move_uploaded_file($_FILES['file']['tmp_name'], '../'.$filePath);

        echo $filePath;
        echo $_SESSION['Utenti'][$index];
    
        $query = "UPDATE iscritto SET docIdentificativi = '$filePath' WHERE codF = ?";
        
        $stmt = $conn->prepare($query);
    
        if ($stmt === false) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            exit;
        }
    
        $stmt->bind_param("s", $_SESSION['Utenti'][$index]);

        $stmt->execute();
        $stmt->close();
    }
   
}

function getFromDbFilePath($index, $conn){
    $query = "SELECT docIdentificativi FROM iscritto WHERE codF = ?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("s", $_SESSION['Utenti'][$index]);

    $stmt->execute();
    $result = $stmt->get_result();

    
    $stmt->close();

    $row = $result->fetch_assoc();

    return '../'.$row['docIdentificativi']; 
}

function downloadFile($file_path){
    $fileName = basename($file_path);
    echo $fileName;
    /*header('Content-Type: application/pdf');
    header("Content-Transfer-Encoding: binary");
    header("Content-disposition: attachment; filename=".basename($file_path));
    //readfile($file_path);*/

    echo "<a href=".$file_path." download></a>";
}

?>