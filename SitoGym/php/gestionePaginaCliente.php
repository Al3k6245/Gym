<?php
session_start();

if(!isset($conn)){
    $conn = mysqli_connect('localhost','root','','gym');
    
    if(!$conn){
        die("Connessione fallita: " . mysqli_connect_error());
    }
}

$username = $_SESSION['loggedUsername'];

/* $query = 'SELECT allenamenti.nome AS nomeA, comporre.peso, comporre.ripetizioni, esercizi.* FROM iscritto
INNER JOIN eseguire ON iscritto.codF = eseguire.codF
INNER JOIN allenamenti ON eseguire.idA = allenamenti.idA
INNER JOIN comporre ON allenamenti.idA = comporre.idA
INNER JOIN esercizi ON comporre.idEs = esercizi.idEs
WHERE username = ?'; */

$query = 'SELECT nomeA FROM nomiAllenamenti WHERE username = ?';

$stmt = $conn->prepare($query);

$stmt->bind_param("s", $username);

$stmt->execute();

$result = $stmt->get_result(); 

while($row = $result->fetch_assoc()){
    print ' <div class="container-add">
    <div class="container-titolo">
        <h1 class="h1">'.$row['nomeA'].'</h1>
    </div>
    <div class="grindesercizi">';

        $queryEsercizi = 'SELECT nomeEs, musPrimario, musSecondari, tipoAttrezzatura FROM nomiEsercizi WHERE username = ? AND nomeA = ? GROUP BY (nomeEs)';

        $stmtEs = $conn->prepare($queryEsercizi);

        $stmtEs->bind_param("ss", $username, $row['nomeA']);
        
        $stmtEs->execute();

        $resultEs = $stmtEs->get_result();

   
       
    for($i = 0; $i < 4; $i++ ){

        $rowEs = $resultEs->fetch_assoc();

        print '<div class="esercizio">
        <div class="titoloesercizio">'.$rowEs['nomeEs'].'</div>
        <div class="muscolicontent">
            <div class="muscoli">Primario : '.$rowEs['musPrimario'].'</div>
            <div class="muscoli">Secondario : '.$rowEs['musSecondari'].'</div>
        </div>
        <div class="attrezzaturacontent">
            <div class="attrezzatura-titolo">Attrezzatura :</div>
            <div class="attrezzatura">'.$rowEs['tipoAttrezzatura'].'</div>
        </div>
        <div class="tabella-esercizio-intestazioni">
            <div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1efd-3ab2bb7d" class="intestazionetabellaesercizio">SERIE</div>
            <div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1eff-3ab2bb7d" class="intestazionetabellaesercizio">KG</div>
            <div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1f01-3ab2bb7d" class="intestazionetabellaesercizio">RIPETIZIONI</div>
        </div>
         <div class="tabella-esercizio-record">';

        $querySerie = 'SELECT peso, ripetizioni FROM iscritto
        INNER JOIN eseguire ON iscritto.codF = eseguire.codF
        INNER JOIN allenamenti ON eseguire.idA = allenamenti.idA
        INNER JOIN comporre ON allenamenti.idA = comporre.idA
        INNER JOIN esercizi ON comporre.idEs = esercizi.idEs 
        WHERE username = ? AND allenamenti.nome = ? AND esercizi.nome = ?';

        $stmtSerie = $conn->prepare($querySerie);

        $stmtSerie->bind_param("sss", $username, $row['nomeA'], $rowEs['nomeEs']);
        
        $stmtSerie->execute();

        $resultSerie = $stmtSerie->get_result();

         for($k = 0; $k < 3; $k++){

            $rowSerie = $resultSerie->fetch_assoc();

            print '<div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1f04-3ab2bb7d" class="recordtabellaesercizio serie">'.($k+1).'</div>
            <div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1f06-3ab2bb7d" class="recordtabellaesercizio">'.$rowSerie['peso'].'</div>
            <div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1f08-3ab2bb7d" class="recordtabellaesercizio">'.$rowSerie['ripetizioni'].'</div>';
         }

         $stmtSerie->close();
           
         print '</div>'; 
         print '</div>';
    }

    $stmtEs->close();

    print '</div>
    </div>';
    
}

$stmt->close();

?>