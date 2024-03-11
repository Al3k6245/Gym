<?php
require('gestioneSegreteria.php');

if(!isset($_SESSION['sezioneAttuale']))
    $_SESSION['sezioneAttuale'] = 'Clienti';


function writeSection(){
    return "'".$_SESSION['sezioneAttuale']."'";
}

function writeLoggedUserType(){
    return "'".$_SESSION['loggedUserType']."'";
}

function onLoadSection(){
    return "'".$_SESSION['sezioneAttuale']."', '".$_SESSION['loggedUserType']."'";
}
    

?>

<!DOCTYPE html>
<!-- This site was created in Webflow. https://www.webflow.com --><!-- Last Published: Thu Feb 29 2024 17:18:46 GMT+0000 (Coordinated Universal Time) -->

<head>
    <meta charset="utf-8" />
    <title>GymWebSite</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Webflow" name="generator" />
    <link href="../css/segreteriaStyle.css" rel="stylesheet" type="text/css" />
    <script src="../javascript/gestioneAjaxSegreteria.js"></script>
</head>

<body class="body" onload="changeSection(<?php echo onLoadSection() ?>)">  
    <section id="Home" class="content">
        <div class="container-dashboard">
            <div class="container-titolo">
                <h1 class="h1">Dashboard</h1>
            </div>
            <div class="navigazione">
            <a id="clientiSection" class="container-sezioni clienti w-button" onclick="changeSection('Clienti', <?php echo writeLoggedUserType() ?>)">Clienti</a>
                    <a id="allenatoriSection" class="container-sezioni allenatori w-button" onclick="changeSection('Allenatori', <?php echo writeLoggedUserType() ?>)">Allenatori</a>
                <div class="search allineato w-form"><input class="search-input w-input"
                        maxlength="256" name="query" placeholder="Search" type="search" id="Ricerca"
                        required="" onkeyup="AjaxResearch('Ricerca')"></div>
            </div>

                <!-- //PULSANTE CLIENTI -->
                    <div id="headerTable" class="tabella-preset intestazione">
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39f1-8abcad94" class="ordinamento"> 
                        <a id="firstCol" href="#" class="ordinamentoupdown w-button"></a>
                        </div>
                        <div id="secondCol" class="tabella-intestazioni"></div>
                        <div id="thirdCol" class="tabella-intestazioni"></div>
                        <div id="fourthCol" class="tabella-intestazioni"></div>
                        <div id="fifthCol" class="tabella-intestazioni"></div>
                        <div id="sixthCol" class="tabella-intestazioni"></div>
                    </div>

                    <div id="tabella-membri" class="tabella-preset tabella">
                        <!-- questa sezione viene riempita con php -->
                    </div>
        </div>


    </section>

        <div id="info">
            <!-- qua dentro viene creata la finestra tramite ajax -->
        </div>
        
    <!-- BARRA DI NAVIGAZIONE -->
        <div style="display:none" class="menu-descrizioni">
            <div class="descrizione">Home</div>
            <div class="descrizione">AddCliente</div>
        </div>
    </div>
</div>

<div class="hoversection small-abbonamento" id="rinnovaAbbonamento" style="display: none">
<div class="hoversection-container">
    <a data-w-id="68bb2142-7955-cadb-9b5d-899d6979142a" class="icon exit w-button" id="leaveButton" onclick="closeRinnovaAbbonamento()"></a>
    <div class="name tecnico">Aggiungi Abbonamento</div>
    <div class="aggiungi-abbonamento w-form">
    <form id="email-form-2" name="email-form-2" data-name="Email Form 2" method="get" action="gestioneSegreteria.php" class="form-3" data-wf-page-id="65db228c551539358abcad94" data-wf-element-id="caec41b9-4f34-3fcd-0de6-8da4dd580731" aria-label="Email Form 2">
        <select id="AbbonamentoType" name="AbbonamentoType" data-name="Abbonamento Type" class="select-field w-select">
            <option value="Basic">Basic</option>
            <option value="Silver">Silver</option>
            <option value="Gold">Gold</option>
            <option value="Platinum">Platinum</option>
        </select>
        <input type="submit" data-wait="Please wait..." class="addcertificazione w-button" value="Rinnova">
        <input type="hidden" id="customerId" name="index"> <!-- tramite javascript vado ad inserire come value il riferimento indice del cliente --> 
    </form>  
</div>  
</div>
</div>


<div class="hoversection small" id="nuovoAllenamento" style="display: none">
    <div class="hoversection-container">
        <a href="#" class="icon exit w-button" onclick="closeNuovoAllenamento()"></a>
        <div class="name tecnico">Aggiungi Allenamento</div>
    </div>
    <div class="aggiungi-abbonamento w-form">
        <form id="email-form-2" name="email-form-2" data-name="Email Form 2" method="get" action="gestioneSegreteria.php" class="form-3" data-wf-page-id="65db228c551539358abcad94" data-wf-element-id="ddb12b6a-512b-6e9c-2be4-00a9bf4969c1" aria-label="Email Form 2">
            <select id="Allenamento" name="Allenamento"  class="select-field w-select">
                <option value="Basic-A">Basic-A</option>
                <option value="Basic-B">Basic-B</option>
                <option value="Medium-A">Medium-A</option>
                <option value="Medium-B">Medium-B</option>
                <option value="Medium-C">Medium-C</option>
            </select>
            <input type="submit" data-wait="Please wait..." class="addcertificazione w-button" value="Aggiungi">
            <input type="hidden" id="customerIdForA" name="index"> <!-- tramite javascript vado ad inserire come value il riferimento indice del cliente --> 
        </form>
    </div>
</div> 


</div>
</div>

  <!------------------------------------------------------- MENU DI NAVIGAZIONE LATERALE ---------------------------------------------------------------->

    <div style="display: none;" class="menu-descrizioni"><div class="descrizione">Home</div><div class="descrizione">Users</div></div>
    <nav data-w-id="93085ae0-f7f2-eb6d-a80c-8ff237c72caf" class="menu-icone"><a href="segreteria.php" class="menu-sezioni _0 w-button w--current"></a><a href="AddUsers.php" class="menu-sezioni _3 w-button"></a><a href="SddUsers.php" class="menu-sezioni logout w-button"></a></nav>
    <!-- <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=65db228c551539358abcad8e" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://assets-global.website-files.com/65db228c551539358abcad8e/js/webflow.399e61ad1.js" type="text/javascript"></script> -->
</body>

</html>