<?php
session_start();

if(!isset($conn)){
    $conn = mysqli_connect('localhost','segreteria','password','gym');
    
    if(!$conn){
        die("Connessione fallita: " . mysqli_connect_error());
    }
}

//----------------------------------------------------------------- GESTIONE RICHIESTE AJAX -----------------------------------------------------------------------------

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_FILES['file']) && isset($_POST['type'])){
        SaveDocumentTemp($_FILES['file'], $_POST['type']);
    }
}

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['azione'])){

        switch($_GET['azione']){

            case 'displayError':
                echo CheckErrors($_GET['field'], $_GET['fieldValue']);
                break;
        }
    }
}

//-------------------------------------------------------------- FINE GESTIONE RICHIESTE AJAX -------------------------------------------------------------------------



function SaveDocumentTemp($file, $type){
    $_SESSION['documenti'][$type] = $file['name'];   //devo salvare anche nella cartella temp nel server se no poi quando compilo il form non ce l'ho più
    move_uploaded_file($file['tmp_name'], '../temp/'.$file['name']);
}

function CheckErrors($fieldName, $fieldValue){

    if($fieldName == "Nome" || $fieldName == "Cognome"){
        if(ctype_alpha($fieldValue) || empty($fieldValue))
            return "";

        return "Campo non valido";
    }
    else if($fieldName == "NumeroTel" ){
        if(ctype_digit($fieldValue) || empty($fieldValue))
            return "";

        return "Campo non valido";
    }
    else if($fieldName = "Mail"){
        if(strpos($fieldValue, "@") || empty($fieldValue))  //funzione che restituisce true o false in base all'esistenza del carattere specificato come secondo parametro nella stringa
            return "";

        return "Campo non valido";
    }   
}

?>