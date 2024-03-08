<?php

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


?>