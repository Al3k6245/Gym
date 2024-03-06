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
        case 'viewUserInfo':
            displayInfo($_GET['index'], $conn);
            break;
        case 'closeUserInfo':
            echo '';
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
    </div>
    <div class='tabella-testo'>".$row['DataN']."</div>
    <div class='action'>
    <a href='#' class='icon allerta w-button'>Button Text</a>
    <a href='#' class='icon pericolo w-button'>Button Text</a>
    </div>
    <div class='action'>
    <a class='icon userdescrizioni w-button' onclick='AjaxViewDescription(".$counter.")'>Button Text</a>
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

function displayInfo($index, $conn){
    $query = "SELECT nome, cognome, DataN, tipoAbbonamento, ScadenzaAbb, codF, mail, docIdentificativi, psw FROM iscritto WHERE codF = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_SESSION['Utenti'][$index]);

    $stmt->execute();

    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    print '<div data-w-id="1ead45e8-3280-9d48-6405-e79982937b5c" class="hoversection">
    <div class="hoversection-container"><img src="uploads/fotoProva.jpg" loading="lazy" width="Auto" alt="" class="fotoprofilo">
    <a data-w-id="859845ff-4b55-b293-93ca-957b1f255837" class="icon exit w-button" onclick="AjaxCloseDescription()"></a>
        <div class="name">'.$row['cognome'].' '.$row['nome'].'</div>
        <div class="intestazioneblack">Codice Fiscale </div>
        <div class="testowhite">'.$row['codF'].'<br></div>
        <div class="intestazioneblack">Data di Nascita</div>
        <div class="testowhite">'.$row['DataN'].'<br></div>
        <div class="intestazioneblack">Contatti</div>
        <div class="testowhite">'.$row['mail'].'<br></div>
        <div class="intestazioneblack">Password Account</div>
        <div class="password">
            <div data-w-id="78352fc8-7684-5c14-63af-2a5582d1e910" style="filter: blur(0px);" class="testowhite password">'.$row['psw'].'<br></div>
        </div>
        </div>
    </div>';

    $stmt->close();
}

?>