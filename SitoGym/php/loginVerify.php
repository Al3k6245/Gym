<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "gym");

// Controllo del nome utente
$username = $_POST["Username"];
$password = $_POST['Password'];

$query = "SELECT * FROM utenti WHERE username = ? AND psw = SHA2('".$password."', 256)";
$stmt = $conn->prepare($query);

$stmt->bind_param("s", $username);

$stmt->execute();
$result = $stmt->get_result();
$num_rows = $result->num_rows;

// Controllo della password
if ($num_rows > 0) {
    $tipoUt = $result->fetch_assoc()['tipo'];

    $_SESSION['loggedUserType'] = $tipoUt;
    $_SESSION['loggedUsername'] = $username;


    echo $tipoUt;

    if($tipoUt != 'Iscritto'){
        header('Location: ../php/segreteria.php');
    }   
    else
        header('Location: ../php/Clienti-Allenamenti.php');

}
else
    header('Location: ../index.php?error=invalid');

$stmt->close();
$conn->close();

?>