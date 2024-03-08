<?php 
session_start();

if(!isset($conn)){
    $conn = mysqli_connect('localhost','segreteria','password','gym');
    
    if(!$conn){
        die("Connessione fallita: " . mysqli_connect_error());
    }
}

// ------------------------------------------------------- GESTIONE DELLE RICHIESTE AJAX ----------------------------------------------------------------------------

if($_SERVER["REQUEST_METHOD"] == "GET"){   

    if(isset($_GET['azione'])){

        switch($_GET['azione']){

            case 'delMem':
                deleteMember($_GET['index'], $conn);
                showMembers($conn);
                break;

            case 'downloadFile':
                downloadFile(getFromDbFilePath($_GET['index'],$conn));
                break;

            case 'viewUserInfo':
                displayInfo($_GET['userType'], $_GET['index'], $conn);
                break;

            case 'closeUserInfo':
                echo '';
                break;
                
            case 'changeSection':
                
                switch($_GET['section']){
                    
                    case 'Clienti':
                        showMembers($conn);
                        break;
                        
                    case 'Allenatori':
                        displayTrainers($conn);
                        break;

                    case 'Personale':
                        
                        break;
                    }
                break;
        }
    }
}  

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file']) && isset($_POST['index'])){
    addDocument($_POST['userType'],$_POST['index'], $conn);
}
else{
    //implementare codice per far capire che il caricamento non è andato a buon fine
}

// ----------------------------------------------------------------- FINE GESTIONE RICHIESTE AJAX --------------------------------------------------------------------


function showMembers($conn){
    $query = "SELECT nome, cognome, DataN, tipoAbbonamento, ScadenzaAbb, codF, mail, docIdentificativi FROM iscritto";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();

    $counter = 1;   //ai vari pulsanti assegno un numero come id in modo da sapere che riga l'utente sta andando a scegliere

    $userType = 0;   //0 => Cliente   1 => Allenatore    2 => Personale

    if($result){
        while($row = $result->fetch_assoc()){

            //-------------------------------------------------------------- RIGA ISCRITTO ----------------------------------------------------------------------

            print "
            <div class='badge'>
            <div class='immagineprofilo'></div>
            <div class='datipersonali'>
                <div class='tabella-intestazioni cognomenome'>" .$row['nome']. " " .$row['cognome']. "</div>
                <div class='tabella-intestazioni abbonamento'>" .$row['tipoAbbonamento']."</div>
            </div>
        </div>
        <div  class='tabella-testo'>".$row['ScadenzaAbb']."</div>
        <div class='action'>
        <a id='AddCertificato' class='icon add w-button' onclick='addFile(".$userType.",".$counter.")'>Button Text</a>".loadDownloadButton($row['docIdentificativi'])."
        </div>
        <div class='tabella-testo'>".$row['DataN']."</div>
        <div class='action'>
        <a class='icon allerta w-button'>Button Text</a>
        <a class='icon pericolo w-button'>Button Text</a>
        </div>
        <div class='action'>
        <a class='icon userdescrizioni w-button' onclick='AjaxViewDescription(0,".$counter.")'>Button Text</a>
        <a href='mailto:".$row['mail']."' class='icon useremail w-button'>Button Text</a>
        <a id='$counter' class='icon userremove w-button' onclick='AjaxDeleteMember(".$counter.")'>Button Text</a>
        </div>
        ";
            saveFiscalCodeOnSession($row['codF'], $counter, 'iscritto');  //salvare il codice fiscale permette di gestire più facilmente l'eliminazione dell'user e altre features
            $counter++;
        }
    }

    $stmt->close();
}


function saveFiscalCodeOnSession($fiscalCode, $counter, $userType){
    $_SESSION[$userType][$counter] = $fiscalCode;
}

function deleteMember($index, $conn){
    $query = "DELETE FROM iscritto WHERE codF = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_SESSION['iscritto'][$index]);

    $stmt->execute(); 
    $stmt->close();

    //eliminazione dalla sessione
    unset($_SESSION['iscritto'][$index]);
    $counter = 1;
    foreach ($_SESSION['iscritto'] as $key => $value) {
        $key = $counter;
        $counter++;
    }

    //eliminazione della cartella dell'utente all'interno della cartella /uploads/iscritto 
}

function addDocument($userType ,$index, $conn){

    if($_FILES['file']['error'] == 0){  //il file è stato caricato correttamente

        switch($userType){

            case 0:
                $table = 'iscritto';
                $userTypeFolder = 'Iscritti';
                break;

            case 1:
                $table = 'allenatori';
                $userTypeFolder = 'Allenatori';
                break;

            case 2:
                $table = 'tecnici';
                $userTypeFolder = 'Tecnici';
                break;
        }
        
        //-------------------    QUERY PER OTTENERE NOME E COGNOME UTENTE PER POTER SALVARE NELLA CARTELLA GIUSTA IL DOCUMENTO  -------------------------------------
        $query = "SELECT nome, cognome FROM $table WHERE codF = ?";
        
        $stmt = $conn->prepare($query);
    
        if ($stmt === false) {
            //compare una finestra che dà errore
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            exit;
        }
        
        $stmt->bind_param("s", $_SESSION[$table][$index]);

        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        $userFolderName = strtoupper($row['cognome'])."_".strtoupper($row['nome']); //PER ORA FACCIO FINTA CHE CI SIA GIA' LA CARTELLA MA VERREBBE CREATA QUANDO SI AGGIUNGE L'UTENTE

        $filePath = "uploads/".$userTypeFolder."/".$userFolderName."/".$_FILES['file']['name'];
         
        $stmt->close();

        move_uploaded_file($_FILES['file']['tmp_name'], '../'.$filePath);
    
        // ---------------------------- QUERY PER CARICARE IL PERCORSO DEL DOCUMENTO NEL DATABASE ----------------------------------------------
        $query = "UPDATE $table SET docIdentificativi = '$filePath' WHERE codF = ?";
        
        $stmt = $conn->prepare($query);
    
        if ($stmt === false) {
            //compare una finestra che dà errore
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            exit;
        }
        
        $stmt->bind_param("s", $_SESSION[$table][$index]);

        $stmt->execute();
        $stmt->close();

        //aggiungo il pulsante download se non è già stato caricato prima
        
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

function displayInfo($user, $index, $conn){
    $userTable;

    switch($user){
        case 0:
            $userTable = 'iscritto';
            break;
        case 1:
            $userTable = 'allenatori';
            break;
        case 2:
            $userTable = 'tecnici';
            break;
    }

    $query = "SELECT nome, cognome, DataN, codF, mail, psw, imgProfilo FROM $userTable WHERE codF = ?";

    $stmt = $conn->prepare($query);

    
    if ($stmt === false) {
        //compare una finestra che dà errore
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit;
    }
    
    $stmt->bind_param("s", $_SESSION[$userTable][$index]);

    $stmt->execute();

    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    
    // ------------------------------------------------ SCHEDA INFORMAZIONI  --------------------------------------------------------------------------

    print '<div data-w-id="1ead45e8-3280-9d48-6405-e79982937b5c" class="hoversection">
    <div class="hoversection-container"><img src="'.$row['imgProfilo'].'" loading="lazy" width="Auto" alt="" class="fotoprofilo">
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

function displayTrainers($conn){
    $query = "SELECT codF, nome, cognome, mail, docIdentificativi, valutazione FROM allenatori";
    $stmt = $conn->prepare($query);

    $stmt->execute();

    $result = $stmt->get_result();

    $counter = 1;
    $userType = 1;

    while($row = $result->fetch_assoc()){

        // ---------------------------------------------------------------- RIGA ALLENATORE  -------------------------------------------------------------

        print ' <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a01-8abcad94" class="badge">
        <div class="immagineprofilo"></div>
        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a03-8abcad94" class="datipersonali">
            <div class="tabella-intestazioni cognomenome">'.$row['cognome'].' '.$row['nome'].'</div>
            <div class="tabella-intestazioni abbonamento">Trainer</div>
        </div>
    </div>
        <div id="w-node-_0e779d34-7823-49d5-40c4-5ffff40550ee-8abcad94" class="action stars">'.loadStars($row['valutazione']).'</div>
            <div id="certificatoMedico" class="action"><a id="AddCertificato" class="icon add w-button" onclick="addFile('.$userType.', '.$counter.')">Button Text</a>'.loadDownloadButton($row['docIdentificativi']).'</div>
            <! //TURNI->
                <div id="w-node-e2dab09d-b38f-8e66-1aef-091b33b2299f-8abcad94" class="action"><a id="AddCertificato" href="#" class="icon turni w-button">Button Text</a><a href="#" class="icon addturni w-button">Button Text</a></div>
                <! //STATO->
                    <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a11-8abcad94" class="action"><a href="#" class="icon allerta w-button">Button Text</a><a href="#" class="icon pericolo w-button">Button Text</a></div>
                    <! //SOLITI BOTTONI->
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a16-8abcad94" class="action"><a data-w-id="c6f7797d-88a6-66c5-3210-b528f2cf3a17" href="#" class="icon userdescrizioni w-button" onclick="AjaxViewDescription('.$userType.','.$counter.')">Button Text</a><a href="mailto:'.$row['mail'].'" class="icon useremail w-button">Button Text</a><a href="" class="icon userremove w-button">Button Text</a></div>';

        saveFiscalCodeOnSession($row['codF'], $counter, 'allenatori');

        $counter++;
    }   
        
    $stmt->close();
}

function loadStars($valutazione){
    $stars = '';

    for($i=0;$i<$valutazione;$i++){
        $stars = $stars.'<img src="https://assets-global.website-files.com/65db228c551539358abcad8e/65e6d02cb1d41240f646949d_star.png" loading="lazy" alt="" class="star">';
    }

    return $stars;
}

function loadDownloadButton($docPath){  //carica il pulsante download del file solamente se per lo specifico utente è stato caricato un documento
    if($docPath != NULL)
        return '<a href="'.$docPath.'" class="icon download w-button" download>Button Text</a>';

    return "";
}

?>