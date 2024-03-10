<?php
session_start();

if(!isset($conn)){
    $conn = mysqli_connect('localhost','segreteria','password','gym');
    
    if(!$conn){
        die("Connessione fallita: " . mysqli_connect_error());
    }
}

if(!isset($_SESSION['errori'])){   //questa variabile di sessione serve per vedere se ci sono errori DURANTE la compilazione del form
    $_SESSION['errori'] = 0;
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

                if($_GET['isValid'] == 'false'){
                    echo "Campo non valido";
                }
                else{
                    echo "";
                }
                
                echo $_SESSION['errori'];
                
                break;
        }
    }
}

//-------------------------------------------------------------- FINE GESTIONE RICHIESTE AJAX -------------------------------------------------------------------------



function SaveDocumentTemp($file, $type){
    $_SESSION['documenti'][$type] = $file['name'];   //devo salvare anche nella cartella temp nel server se no poi quando compilo il form non ce l'ho più
    move_uploaded_file($file['tmp_name'], '../temp/'.$file['name']);
}

?>