<?php 
session_start();

if(!isset($conn)){
    $conn = mysqli_connect('localhost','root','','gym');
    
    if(!$conn){
        die("Connessione fallita: " . mysqli_connect_error());
    }
}

// ------------------------------------------------------- GESTIONE DELLE RICHIESTE AJAX ----------------------------------------------------------------------------

if($_SERVER["REQUEST_METHOD"] == "GET"){   
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
            displayInfo($_GET['index'], $conn);
            break;
        case 'closeUserInfo':
            echo '';
            break;
    }
        
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file']) && isset($_POST['index'])){
    addDocument($_POST['userType'],$_POST['index'], $conn);
    addDocument($_POST['userType'],$_POST['index'], $conn);
}
else{
    //implementare codice per far capire che il caricamento non è andato a buon fine
}

// ----------------------------------------------------------------- FINE GESTIONE RICHIESTE AJAX --------------------------------------------------------------------

// ----------------------------------------------------------------- FINE GESTIONE RICHIESTE AJAX --------------------------------------------------------------------


function showMembers($conn){
    $query = "SELECT nome, cognome, DataN, tipoAbbonamento, ScadenzaAbb, codF, mail, docIdentificativi FROM iscritto";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();

    $counter = 1;   //ai vari pulsanti assegno un numero come id in modo da sapere che riga l'utente sta andando a scegliere

    $userType = 0;   //0 => Cliente   1 => Allenatore    

    if($result){
        while($row = $result->fetch_assoc()){

            //-------------------------------------------------------------- RIGA ISCRITTO ----------------------------------------------------------------------
            //-------------------------------------------------------------- RIGA ISCRITTO ----------------------------------------------------------------------

            print "
            <div class='badge'>
            <img src='"."'  alt='ImmagineProfilo' class='immagineprofilo'>
            <div class='datipersonali'>
                <div class='tabella-intestazioni-dashboard cognomenome'>" .$row['nome']. " " .$row['cognome']. "</div>
                <div class='tabella-intestazioni abbonamento'>" .$row['tipoAbbonamento']."</div>
            </div>
        </div>
        <div  class='tabella-testo'>".$row['ScadenzaAbb']."</div>
        <div class='action'>
        <a id='AddCertificato' class='icon add w-button' onclick='addFile(".$userType.",".$counter.")'></a>".loadDownloadButton($row['docIdentificativi'])."
        </div>
        <div class='tabella-testo'>".$row['DataN']."</div>
        <div class='action'>
        <a class='icon allerta w-button'></a>
        <a class='icon pericolo w-button'></a>
        </div>
        <div class='action'>
        <a class='icon userdescrizioni w-button' onclick='AjaxViewDescription(0,".$counter.")'></a>
        <a href='mailto:".$row['mail']."' class='icon useremail w-button'></a>
        <a id='$counter' class='icon userremove w-button' onclick='AjaxDeleteMember(".$counter.")'></a>
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
function saveFiscalCodeOnSession($fiscalCode, $counter, $userType){
    $_SESSION[$userType][$counter] = $fiscalCode;
}

function deleteMember($index, $conn){
    $query = "DELETE FROM iscritto WHERE codF = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_SESSION['iscritto'][$index]);
    $stmt->bind_param("s", $_SESSION['iscritto'][$index]);

    $stmt->execute(); 
    $stmt->close();

    //eliminazione dalla sessione
    unset($_SESSION['iscritto'][$index]);
    unset($_SESSION['iscritto'][$index]);
    $counter = 1;
    foreach ($_SESSION['iscritto'] as $key => $value) {
    foreach ($_SESSION['iscritto'] as $key => $value) {
        $key = $counter;
        $counter++;
    }

    //eliminazione della cartella dell'utente all'interno della cartella /uploads/iscritto 

    //eliminazione della cartella dell'utente all'interno della cartella /uploads/iscritto 
}

function addDocument($userType ,$index, $conn){
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

        echo $filePath;
        echo $_SESSION['Utenti'][$index];
    
        // ---------------------------- QUERY PER CARICARE IL PERCORSO DEL DOCUMENTO NEL DATABASE ----------------------------------------------
        $query = "UPDATE $table SET docIdentificativi = '$filePath' WHERE codF = ?";
        
        $stmt = $conn->prepare($query);
    
        if ($stmt === false) {
            //compare una finestra che dà errore
            //compare una finestra che dà errore
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            exit;
        }
        
        $stmt->bind_param("s", $_SESSION[$table][$index]);
        
        $stmt->bind_param("s", $_SESSION[$table][$index]);

        $stmt->execute();
        $stmt->close();

        //aggiungo il pulsante download se non è già stato caricato prima
        

        //aggiungo il pulsante download se non è già stato caricato prima
        
    }
   
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
    
    // ------------------------------------------------ SCHEDA INFORMAZIONI  --------------------------------------------------------------------------

    print '<div data-w-id="1ead45e8-3280-9d48-6405-e79982937b5c" class="hoversection">
    <div class="hoversection-container"><img src="'.$row['imgProfilo'].'" loading="lazy" width="Auto" alt="" class="fotoprofilo">
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
    $query = "SELECT codF, nome, cognome, mail, docIdentificativi FROM allenatori";
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
            <div class="tabella-intestazioni-dashboard cognomenome">'.$row['cognome'].' '.$row['nome'].'</div>
            <div class="tabella-intestazioni abbonamento">Trainer</div>
        </div>
    </div>
        <div id="w-node-_0e779d34-7823-49d5-40c4-5ffff40550ee-8abcad94" class="action stars"></div>
            <div id="certificatoMedico" class="action"><a id="AddCertificato" class="icon add w-button" onclick="addFile('.$userType.', '.$counter.')"></a>'.loadDownloadButton($row['docIdentificativi']).'</div>
                <div id="w-node-e2dab09d-b38f-8e66-1aef-091b33b2299f-8abcad94" class="action"><a id="viewTurni" class="icon turni w-button" onclick="AjaxViewTrainerShifts('.$counter.')"></a></div>
                <! //STATO->
                    <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a11-8abcad94" class="action"></div>
                    <! //SOLITI BOTTONI->
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a16-8abcad94" class="action"><a data-w-id="c6f7797d-88a6-66c5-3210-b528f2cf3a17" href="#" class="icon userdescrizioni w-button" onclick="AjaxViewDescription('.$userType.','.$counter.')"></a><a href="mailto:'.$row['mail'].'" class="icon useremail w-button"></a><a href="" class="icon userremove w-button"></a></div>';

        saveFiscalCodeOnSession($row['codF'], $counter, 'allenatori');

        $counter++;
    }   
        
    $stmt->close();
}


function loadDownloadButton($docPath){  //carica il pulsante download del file solamente se per lo specifico utente è stato caricato un documento
    if($docPath != NULL)
        return '<a href="'.$docPath.'" class="icon download w-button" download>Button Text</a>';

    return "";
}

function displayShifts($index, $conn){  //mostra i turni di lavoro
    $query = "SELECT nome, cognome, giornoSettimana, oraInizio, oraFine FROM allenatori
              INNER JOIN turno ON turno.codF = allenatori.codF
              WHERE allenatori.codF = ?";

    $stmt = $conn->prepare($query);
    
    $stmt->bind_param("s", $_SESSION['allenatori'][$index]);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($stmt === false) {
        //compare una finestra che dà errore
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit;
    }

    $queryRows = [];
    $i = 0;

    $row = $result->fetch_assoc();

    $nome = $row['nome'];
    $cognome = $row['cognome'];

    while($row){
        array_push($queryRows, array($row['giornoSettimana'], $row['oraInizio'], $row['oraFine']));
        $i++;
        $row = $result->fetch_assoc();
    }
    
    
    
    // ----------------------------------------------- VISTA PER TURNI ALLENATORE ------------------------------------------------------------------
    print '<div id="hoversection" class="hoversection">
    <div id="hoversection-container" class="hoversection-container">
    <a data-w-id="719c2e5e-7bf0-9feb-7db1-81abd048c4fa" href="#" class="icon exit w-button" onclick="AjaxCloseDescription()"></a>
    <div class="name intesta">Turni di </div>
    <div class="name tecnico">'.$cognome.' '.$nome.'</div>
    <div class="tabella-interventi">
        <div class="turni">
            <div id="w-node-c7e6837f-7a95-b237-21f6-54d26221d846-8abcad94" class="tabella-intestazioni minore">Giorno</div>
            <div id="w-node-e12b8708-9b95-3906-6e38-ca730dad28bb-8abcad94" class="tabella-intestazioni minore">Orario</div>
        </div>
        <div class="turni righe">
        '.getShifts($queryRows, $index).'
        </div>
    </div>
    </div>
    </div>';

    $stmt->close();
}

function getShifts($queryResult, $trainerIndex){

    $shifts = "";

    foreach ($queryResult as $key => $value) {
        $shifts = $shifts. '
        <div id="w-node-_2d0bdefd-89a6-a043-2285-ceab9d119dfa-8abcad94" class="tabella-testo">'.$value[0].'</div>
        <div id="w-node-fad7ae6d-ec01-1eb5-5327-b54c141faa3b-8abcad94" class="tabella-testo">'.$value[1].' - '.$value[2].'</div><a id="w-node-_964ec2b4-ac3a-134a-2e87-78228df2a022-8abcad94" href="#" class="icon deleteturno w-button" onclick=AjaxDeleteShift("'.$value[0].'",'.$trainerIndex.')></a>';
      }

      return $shifts;
}

function deleteShift($day, $trainerIndex, $conn){
    $query = "DELETE FROM turno JOIN allenatori WHERE codF = ? AND giornoSettimana = ?";  // da risolvere questa query che non funziona
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss",$_SESSION['allenatori'][$trainerIndex], $day);

    $stmt->execute(); 
    $stmt->close();
}

function displayAddShifts($trainerIndex, $conn){

}

function Research($input, $conn){

    if($_SESSION['sezioneAttuale'] == 'Clienti')
        $query = "SELECT nome, cognome, DataN, tipoAbbonamento, ScadenzaAbb, codF, mail, docIdentificativi FROM iscritto WHERE nome LIKE ? OR cognome LIKE ?";
    else
        $query = "SELECT codF, nome, cognome, mail, docIdentificativi FROM allenatori WHERE nome LIKE ? OR cognome LIKE ?";

    $bindParameter = $input.'%';

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $bindParameter, $bindParameter);

    $stmt->execute();

    $result = $stmt->get_result();

    $counter = 1;   //ai vari pulsanti assegno un numero come id in modo da sapere che riga l'utente sta andando a scegliere

    $userType = 0;   //0 => Cliente   1 => Allenatore    

    if($result){
        while($row = $result->fetch_assoc()){

            //-------------------------------------------------------------- RIGA ISCRITTO ----------------------------------------------------------------------
        if($_SESSION['sezioneAttuale'] == 'Clienti'){
                print "
                <div class='badge'>
                <div class='immagineprofilo'></div>
                <div class='datipersonali'>
                    <div class='tabella-intestazioni-dashboard cognomenome'>" .$row['nome']. " " .$row['cognome']. "</div>
                    <div class='tabella-intestazioni abbonamento'>" .$row['tipoAbbonamento']."</div>
                </div>
            </div>
            <div  class='tabella-testo'>".$row['ScadenzaAbb']."</div>
            <div class='action'>
            <a id='AddCertificato' class='icon add w-button' onclick='addFile(".$userType.",".$counter.")'></a>".loadDownloadButton($row['docIdentificativi'])."
            </div>
            <div class='tabella-testo'>".$row['DataN']."</div>
            <div class='action'>
            <a class='icon allerta w-button'></a>
            <a class='icon pericolo w-button'></a>
            </div>
            <div class='action'>
            <a class='icon userdescrizioni w-button' onclick='AjaxViewDescription(0,".$counter.")'></a>
            <a href='mailto:".$row['mail']."' class='icon useremail w-button'></a>
            <a id='$counter' class='icon userremove w-button' onclick='AjaxDeleteMember(".$counter.")'></a>
            </div>
            ";
                saveFiscalCodeOnSession($row['codF'], $counter, 'iscritto');  //salvare il codice fiscale permette di gestire più facilmente l'eliminazione dell'user e     altre features
            }
            else{
                print ' <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a01-8abcad94" class="badge">
                <div class="immagineprofilo"></div>
                <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a03-8abcad94" class="datipersonali">
                    <div class="tabella-intestazioni-dashboard cognomenome">'.$row['cognome'].' '.$row['nome'].'</div>
                    <div class="tabella-intestazioni abbonamento">Trainer</div>
                </div>
            </div>
                <div id="w-node-_0e779d34-7823-49d5-40c4-5ffff40550ee-8abcad94" class="action stars"></div>
                    <div id="certificatoMedico" class="action"><a id="AddCertificato" class="icon add w-button" onclick="addFile('.$userType.', '.$counter.')"></a>'.loadDownloadButton($row['docIdentificativi']).'</div>
                        <div id="w-node-e2dab09d-b38f-8e66-1aef-091b33b2299f-8abcad94" class="action"><a id="viewTurni" class="icon turni w-button"     onclick="AjaxViewTrainerShifts('.$counter.')"></a></div>
                        <! //STATO->
                            <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a11-8abcad94" class="action"></div>
                            <! //SOLITI BOTTONI->
                                <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a16-8abcad94" class="action"><a data-w-id="c6f7797d-88a6-66c5-3210-b528f2cf3a17" href="#"  class="icon userdescrizioni w-button" onclick="AjaxViewDescription('.$userType.','.$counter.')"></a><a href="mailto:'.$row['mail'].'" class="icon useremail w-button"></a><a href="" class="icon userremove w-button"></a></div>';
            
                saveFiscalCodeOnSession($row['codF'], $counter, 'allenatori');
            }
            $counter++;
        }
    }

    $stmt->close();
}


?>