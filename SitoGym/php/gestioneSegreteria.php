<?php 

function showMembers($conn){

    $query = "SELECT nome, cognome, DataN, tipoAbbonamento, ScadenzaAbb FROM iscritto";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result){
        printToScreen($result);  
    }

    $stmt->close();
    $conn->close(); 
}

function printToScreen($result){
    $i = 1;   //ai vari pulsanti assegno un numero come id in modo da sapere che riga l'utente sta andando a scegliere

    while($row = $result->fetch_assoc()){
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
    <a href='#' id='$i' class='icon userremove w-button'>Button Text</a>
    </div>
    ";

    $i++;  
    }
}

function deleteMember(){
    
}

?>