<?php 

if(!isset($conn)){
    $conn = mysqli_connect('localhost','segreteria','password','gym');
    
    if(!$conn){
        die("Connessione fallita: " . mysqli_connect_error());
    }
}

if(isset($_GET['azione']) && isset($_GET['index'])){   
    //è stata fatta una richiesta GET dall'ajax
        session_start();
        deleteMember($_GET['index'], $conn);
        showMembers($conn);
        aaaa
    }




function showMembers($conn){
    $query = "SELECT nome, cognome, DataN, tipoAbbonamento, ScadenzaAbb, codF FROM iscritto";

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
    <a id='AddCertificato' href='#' class='icon add w-button'>Button Text</a>
    <a href='#' class='icon download w-button'>Button Text</a></div>
    <div class='tabella-testo'>".$row['DataN']."</div>
    <div class='action'>
    <a href='#' class='icon allerta w-button'>Button Text</a>
    <a href='#' class='icon pericolo w-button'>Button Text</a>
    </div>
    <div class='action'>
    <a href='#' class='icon userdescrizioni w-button'>Button Text</a>
    <a href='#' class='icon useremail w-button'>Button Text</a>
    <a id='$counter' class='icon userremove w-button' onclick='AjaxRequest(".$counter.")'>Button Text</a>
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
    }
}

?>