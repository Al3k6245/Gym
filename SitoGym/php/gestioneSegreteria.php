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

    if(isset($_GET['azione'])){

        switch($_GET['azione']){

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
                        $_SESSION['sezioneAttuale'] = 'Clienti';
                        break;
                        
                    case 'Allenatori':
                        if($_SESSION['loggedUserType'] == 'Segreteria')
                            displayTrainers($conn);
                        else if($_SESSION['loggedUserType'] == 'Allenatore')
                            displayLoggedTrainer($_SESSION['loggedUsername'], $conn);
                        $_SESSION['sezioneAttuale'] = 'Allenatori';
                        break;
                    }
                

                break;
            
            case 'viewShifts':
                displayShifts($_GET['index'], $conn);
                break;
            
            case 'deleteShift':
                deleteShift($_GET['shiftDay'], $_GET['trainerIndex'], $conn);  //da sistemare (non funziona) :(
                break;

            case 'addShift':
                addShift($_GET['trainerIndex'], $conn);
                break;

            case 'search':
                Research($_GET['input'], $conn);
                break;
        }
    }
    else if(isset($_GET['GiornoSettimana']) && isset($_GET['Orario'])){
        //aggiungere il turno all'allenatore
        $giornoSettimana = $_GET['GiornoSettimana'];
        $oraInizio = substr($_GET['Orario'], 0, 5);
        $oraFine = substr($_GET['Orario'], 8, 5);
        $username = $_SESSION['allenatori'][$_GET['index']]; 

        $query = "SELECT codF FROM allenatori WHERE username = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
    
        $codF = $stmt->get_result()->fetch_assoc()['codF'];

        if(!addTurnoToTrainer($_GET['index'], $giornoSettimana, $oraInizio, $oraFine, $codF, $conn))
            echo "<script> window.location.href = 'segreteria.php';
                    alert('Esiste già un turno per il giorno selezionato');
                    </script>";
        else
            header('Location: segreteria.php');
    }
    else if(isset($_GET["AbbonamentoType"])){
        //rinnovo la data di scadenza dell'abbonamento al mese prossimo
        $username = $_SESSION['iscritto'][$_GET['index']];
        RinnovaAbbonamento($_GET['AbbonamentoType'], $username, $conn);
        header('Location: segreteria.php');
    }
    else if(isset($_GET['Allenamento'])){
        //dare l'abbonamento all'iscritto
        $idA = GetIdA($_GET['Allenamento'], $conn);
        $codF = GetCodF($_SESSION['iscritto'][$_GET['index']], $conn);
        
        if(!NuovoAllenamento($idA, $codF, $conn))
            echo "<script> window.location.href = 'segreteria.php';
                    alert('Questo allenamento è già stato assegnato a questo utente');
                    </script>";
        else
            header('Location: segreteria.php');
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
    $query = "SELECT nome, cognome, DataN, tipoAbbonamento, ScadenzaAbb, codF, mail, docIdentificativi, imgProfilo, username FROM iscritto";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();

    $counter = 1;   //ai vari pulsanti assegno un numero come id in modo da sapere che riga l'utente sta andando a scegliere

    if($result){
        while($row = $result->fetch_assoc()){

            //-------------------------------------------------------------- RIGA ISCRITTO ----------------------------------------------------------------------
            getMemberRecord($row, $counter);
          
            $counter++;
        }
    }

    $stmt->close();
}


function saveFiscalCodeOnSession($username, $counter, $userType){
    $_SESSION[$userType][$counter] = $username;
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
        }
        
        //-------------------    QUERY PER OTTENERE NOME E COGNOME UTENTE PER POTER SALVARE NELLA CARTELLA GIUSTA IL DOCUMENTO  -------------------------------------
        $query = "SELECT nome, cognome FROM $table WHERE username = ?";
        
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
        $query = "UPDATE $table SET docIdentificativi = '$filePath' WHERE username = ?";
        
        $stmt = $conn->prepare($query);
    
        if ($stmt === false) {
            //compare una finestra che dà errore
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            exit;
        }
        
        $stmt->bind_param("s", $_SESSION[$table][$index]);

        $stmt->execute();
        $stmt->close();

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

    $query = "SELECT nome, cognome, DataN, codF, mail, psw, imgProfilo, numTel FROM $userTable INNER JOIN utenti ON utenti.username = $userTable.username WHERE $userTable.username = ?";

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
        <div class="testowhite">+39 '.$row['numTel'].'<br></div>
        </div>
    </div>';

    $stmt->close();
}

function displayTrainers($conn){
    $query = "SELECT codF, nome, cognome, mail, docIdentificativi, username, imgProfilo FROM allenatori";
    $stmt = $conn->prepare($query);

    $stmt->execute();

    $result = $stmt->get_result();

    $counter = 1;

    while($row = $result->fetch_assoc()){

        getTrainerRecord($row, $counter);
        $counter++;
    }   
        
    $stmt->close();
}

function displayLoggedTrainer($username, $conn){
    $query = "SELECT codF, nome, cognome, mail, imgProfilo, username FROM allenatori WHERE username = ?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();

    $counter = 1;

    $row = $result->fetch_assoc();

    getTrainerRecord($row, $counter);
        
    $stmt->close();
}


function loadDownloadButton($docPath){  //carica il pulsante download del file solamente se per lo specifico utente è stato caricato un documento
    if($docPath != NULL)
        return '<a href="'.$docPath.'" class="icon download w-button" download>Button Text</a>';

    return "";
}

function displayShifts($index, $conn){  //mostra i turni di lavoro
    $query = "SELECT nome, cognome, giornoSettimana, oraInizio, oraFine FROM allenatori
              LEFT JOIN turno ON turno.codF = allenatori.codF
              WHERE username = ?";

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

    if($row['giornoSettimana'] != NULL && $row['oraInizio'] != NULL && $row['oraFine'] != NULL)
        while($row){
            array_push($queryRows, array($row['giornoSettimana'], $row['oraInizio'], $row['oraFine']));
            $i++;
            $row = $result->fetch_assoc();
        }
    
    // ----------------------------------------------- VISTA PER TURNI ALLENATORE ------------------------------------------------------------------
    if($_SESSION['loggedUserType'] == 'Segreteria'){
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
        <div class="aggiungiturno">
                   <div class="addturnoform w-form">
                        <form id="email-form" name="email-form" data-name="Email Form" method="get" action="segreteria.php" class="addturnoformcontainer" data-wf-page-id="65db228c551539358abcad94" data-wf-element-id="dae9bfdd-ed37-0bac-d5e4-b5ad2583b806" aria-label="Email Form">
                            <div class="giorno"><label for="Giorno-della-Settimana" class="field-label">Giorno</label><select id="Giorno-della-Settimana" name="GiornoSettimana" data-name="Giorno della Settimana" required="" class="select-giorno w-select">
                                    <option value="Lunedì">Lunedì</option>
                                    <option value="Martedì">Martedì</option>
                                    <option value="Mercoledì">Mercoledì</option>
                                    <option value="Giovedì">Giovedì</option>
                                    <option value="Venerdì">Venerdì</option>
                                    <option value="Sabato">Sabato</option>
                                    <option value="Domenica">Domenica</option>
                                </select></div>
                            <div class="orario"><label for="Orario" class="field-label-2">Orario</label><select id="Orario" name="Orario" data-name="Orario" required="" class="select-orario w-select">
                                    <option value="07:00 - 12:00">07:00 - 12:00</option>
                                    <option value="12:00 - 17:00">12:00 - 17:00</option>
                                    <option value="17:00 - 22:00">17:00 - 22:00</option>
                                </select></div><input type="submit" data-wait="Please wait..." class="aggiungiturnoformsubmit w-button" value="Aggiungi">
                                <input type="hidden" name="index" value="'.$index.'">
                        </form>
                    </div> 
                </div> 
        </div> ';
    }
    else if($_SESSION['loggedUserType'] == 'Allenatore'){
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
        </div>';
    }
  

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
    $query = "DELETE FROM turno JOIN allenatori WHERE username = ? AND giornoSettimana = ?";  // da risolvere questa query che non funziona
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss",$_SESSION['allenatori'][$trainerIndex], $day);

    $stmt->execute(); 
    $stmt->close();
}

function getMemberRecord($row, $counter){
    
    $userType = 0;   //0 => Cliente   1 => Allenatore

            //-------------------------------------------------------------- RIGA ISCRITTO ----------------------------------------------------------------------
    if($_SESSION['loggedUserType'] == 'Segreteria'){ 
        print "
        <div class='badge'>
        <img src='".$row['imgProfilo']."'  alt='ImmagineProfilo'  class='immagineprofilo'>
        <div class='datipersonali'>
            <div class='tabella-intestazioni-dashboard cognomenome'>" .$row['nome']. " " .$row['cognome']. "</div>
            <div class='tabella-intestazioni abbonamento'>" .$row['tipoAbbonamento']."</div>
        </div>
        </div>
        <div id='w-node-_475e6141-6056-4ad2-4100-243a3b8210c1-8abcad94' class='action'><div id='w-node-_82679a38-0fb2-5742-f9ad-975f4748a56f-8abcad94' class='tabella-testo'>".$row['ScadenzaAbb']."</div><a id='AddCertificato' class='icon add w-button' onclick='displayRinnovaAbbonamento(".$counter.")'></a></div>
        <div class='action'>
        <a id='AddCertificato' class='icon add w-button' onclick='addFile(".$userType.",".$counter.")'></a>".loadDownloadButton($row['docIdentificativi'])."
        </div>
        <div class='tabella-testo'>".$row['DataN']."</div>
        <div class='action'>
        <a class='icon allerta w-button'></a>
        <a class='icon pericolo w-button'></a>
        </div>
        <div class='action'>
        <a class='icon userdescrizioni w-button' onclick='AjaxViewDescription(".$userType.",".$counter.")'></a>
        <a href='mailto:".$row['mail']."' class='icon useremail w-button'></a>
        </div>
        ";
    }
    else if($_SESSION['loggedUserType'] == 'Allenatore'){  //per l'allenatore c'è una vista diversa rispetto alla segreteria
        print "
        <div class='badge'>
        <img src='".$row['imgProfilo']."'  alt='ImmagineProfilo'  class='immagineprofilo'>
        <div class='datipersonali'>
            <div class='tabella-intestazioni-dashboard cognomenome'>" .$row['nome']. " " .$row['cognome']. "</div>
            <div class='tabella-intestazioni abbonamento'>" .$row['tipoAbbonamento']."</div>
        </div>
        </div>
        <div id='w-node-_475e6141-6056-4ad2-4100-243a3b8210c1-8abcad94' class='action'><div id='w-node-_82679a38-0fb2-5742-f9ad-975f4748a56f-8abcad94' class='tabella-testo'>".$row['ScadenzaAbb']."</div></div>
        <div class='action'>
        
        </div>
        <div class='tabella-testo'>".$row['DataN']."</div>
        <div class='action'>
        <a class='icon allerta w-button'></a>
        <a class='icon pericolo w-button'></a>
        </div>
        <div class='action'>
        <a class='icon userdescrizioni w-button' onclick='AjaxViewDescription(".$userType.",".$counter.")'></a>
        <a href='mailto:".$row['mail']."' class='icon useremail w-button'></a>
        <a class='icon addallenamento-button w-button' onclick='displayNuovoAllenamento(".$counter.")'>Button Text</a>
        </div>
        ";
    }
    
    saveFiscalCodeOnSession($row['username'], $counter, 'iscritto');  //salvare il codice fiscale permette di gestire più facilmente l'eliminazione dell'user e altre features
}

function getTrainerRecord($row, $counter){
    $userType = 1;

 // ---------------------------------------------------------------- RIGA ALLENATORE  -------------------------------------------------------------

 if($_SESSION['loggedUserType'] == 'Segreteria'){
    print ' <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a01-8abcad94" class="badge">
    <img src="'.$row['imgProfilo'].'"  alt="ImmagineProfilo"  class="immagineprofilo">
    <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a03-8abcad94" class="datipersonali">
        <div class="tabella-intestazioni-dashboard cognomenome">'.$row['cognome'].' '.$row['nome'].'</div>
        <div class="tabella-intestazioni abbonamento">Trainer</div>
    </div>
   </div>
    <div id="w-node-_0e779d34-7823-49d5-40c4-5ffff40550ee-8abcad94" class="action stars"></div>
        <div id="certificatoMedico" class="action"><a id="AddCertificato" class="icon add w-button" onclick="addFile('.$userType.', '.$counter.')"></a>'.loadDownloadButton    ($row['docIdentificativi']).'</div>
            <div id="w-node-e2dab09d-b38f-8e66-1aef-091b33b2299f-8abcad94" class="action"><a id="viewTurni" class="icon turni-button w-button" onclick="AjaxViewTrainerShifts('.  $counter.')"></a></div>
            <! //STATO->
                <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a11-8abcad94" class="action"></div>
                <! //SOLITI BOTTONI->
                    <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a16-8abcad94" class="action"><a data-w-id="c6f7797d-88a6-66c5-3210-b528f2cf3a17" href="#" class="icon     userdescrizioni w-button" onclick="AjaxViewDescription('.$userType.','.$counter.')"></a><a href="mailto:'.$row['mail'].'" class="icon useremail     w-button"></a></div>';

 }
 else if($_SESSION['loggedUserType'] == 'Allenatore'){
    print ' <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a01-8abcad94" class="badge">
    <img src="'.$row['imgProfilo'].'"  alt="ImmagineProfilo"  class="immagineprofilo">
    <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a03-8abcad94" class="datipersonali">
        <div class="tabella-intestazioni-dashboard cognomenome">'.$row['cognome'].' '.$row['nome'].'</div>
        <div class="tabella-intestazioni abbonamento">Trainer</div>
    </div>
   </div>
    <div id="w-node-_0e779d34-7823-49d5-40c4-5ffff40550ee-8abcad94" class="action stars"></div>
        <div id="certificatoMedico" class="action"></div>
            <div id="w-node-e2dab09d-b38f-8e66-1aef-091b33b2299f-8abcad94" class="action"><a id="viewTurni" class="icon turni-button w-button" onclick="AjaxViewTrainerShifts('.  $counter.')"></a></div>
            <! //STATO->
                <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a11-8abcad94" class="action"></div>
                <! //SOLITI BOTTONI->
                    <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a16-8abcad94" class="action"><a data-w-id="c6f7797d-88a6-66c5-3210-b528f2cf3a17" href="#" class="icon     userdescrizioni w-button" onclick="AjaxViewDescription('.$userType.','.$counter.')"></a></div>';
 }
    
     saveFiscalCodeOnSession($row['username'], $counter, 'allenatori');

}

function Research($input, $conn){

    if($_SESSION['sezioneAttuale'] == 'Clienti')
        $query = "SELECT nome, cognome, DataN, tipoAbbonamento, ScadenzaAbb, codF, mail, docIdentificativi, imgProfilo, username FROM iscritto WHERE nome LIKE ? OR cognome LIKE ?";
    else
        $query = "SELECT codF, nome, cognome, mail, docIdentificativi, imgProfilo, username FROM allenatori WHERE nome LIKE ? OR cognome LIKE ?";

    $bindParameter = $input.'%';

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $bindParameter, $bindParameter);

    $stmt->execute();

    $result = $stmt->get_result();

    $counter = 1;   //ai vari pulsanti assegno un numero come id in modo da sapere che riga l'utente sta andando a scegliere

    $userType = 0;   //0 => Cliente   1 => Allenatore    

    if($result){
        while($row = $result->fetch_assoc()){

        if($_SESSION['sezioneAttuale'] == 'Clienti'){
            getMemberRecord($row,$counter);    
        }
        else{
            getTrainerRecord($row, $counter);            
        }
            $counter++;
        }
    }

    $stmt->close();
}

function addTurnoToTrainer($index, $giorno, $oraInizio, $oraFine, $codF, $conn){
    $query = "INSERT INTO turno (giornoSettimana, oraInizio, oraFine, codF) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("ssss", $giorno, $oraInizio, $oraFine, $codF);

    $stmt->execute();

    if(mysqli_errno($conn) === 1062)  //questo errore indica chiave primaria duplicata, impossibile aggiungere
        return false;
    
    $stmt->close();
    
    return true;
}

function RinnovaAbbonamento($tipoAbbonamento, $username, $conn){
    $query = "UPDATE iscritto SET tipoAbbonamento = ?, ScadenzaAbb = DATE_ADD(CURDATE(), INTERVAL 1 MONTH) WHERE username = ?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("ss", $tipoAbbonamento, $username);

    $stmt->execute();
    
    $stmt->close();
    
    return true;
}

function NuovoAllenamento($idA, $codF, $conn){
    $query = "INSERT INTO eseguire (idA, codF) VALUES(?, ?)";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("ss", $idA, $codF);

    $stmt->execute();

    if(mysqli_errno($conn) === 1062)  //questo errore indica chiave primaria duplicata, impossibile aggiungere
        return false;
    
    $stmt->close();

    return true;
}

function GetIdA($allenamento, $conn){
    $query = "SELECT idA FROM allenamenti WHERE nome = ?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("s", $allenamento);

    $stmt->execute();

    $result = $stmt->get_result();

    $id = $result->fetch_assoc()['idA'];

    $stmt->close();

    return $id;
}

function GetCodF($username, $conn){
    $query = "SELECT codF FROM iscritto WHERE username = ?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();

    $codF = $result->fetch_assoc()['codF'];

    $stmt->close();

    return $codF;
}


?>