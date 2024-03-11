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

<body class="body" onload="changeSection(<?php echo writeSection() ?>)">  
    <section id="Home" class="content">
        <div class="container-dashboard">
            <div class="container-titolo">
                <h1 class="h1">Dashboard</h1>
            </div>
            <div class="navigazione"><a href="#" class="container-sezioni w-button">Overview</a>
            <a id="clientiSection" class="container-sezioni clienti w-button" onclick="changeSection('Clienti', <?php echo writeLoggedUserType() ?>)">Clienti</a>
                    <a id="allenatoriSection" class="container-sezioni allenatori w-button" onclick="changeSection('Allenatori', <?php echo writeLoggedUserType() ?>)">Allenatori</a>
                <div class="search allineato w-form"><input class="search-input w-input"
                        maxlength="256" name="query" placeholder="Search" type="search" id="Ricerca"
                        required="" onkeyup="AjaxResearch('Ricerca')"></div>
            </div>

                <!-- //PULSANTE CLIENTI -->
                    <div id="headerTable" class="tabella-preset intestazione">
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39f1-8abcad94" class="ordinamento">
                        <a id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39f2-8abcad94"class="icon w-button">Button Text</a>
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


                    <!--
            <section class="sezione" id="Allenatori">
                <! //PULSANTE ALLENATORI->
                    <div class="tabella-preset intestazione">
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39f1-8abcad94" class="ordinamento"><a id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39f2-8abcad94" href="#" class="icon w-button">Button T\ext</a><a id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39f4-8abcad94" href="#" class="ordinamentoupdown w-button">Nome</a></div>
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39f6-8abcad94" class="tabella-intestazioni">Valutazione</div>
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39f8-8abcad94" class="tabella-intestazioni">Certificato Medico</div>
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39fa-8abcad94" class="tabella-intestazioni">Turni</div>
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39fc-8abcad94" class="tabella-intestazioni">Stato</div>
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39fe-8abcad94" class="tabella-intestazioni">Azioni</div>
                    </div>
                    <div class="tabella-preset tabella">
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a01-8abcad94" class="badge">
                            <div class="immagineprofilo"></div>
                            <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a03-8abcad94" class="datipersonali">
                                <div class="tabella-intestazioni cognomenome">Serpelloni Leonardo</div>
                                <div class="tabella-intestazioni abbonamento">Trainer</div>
                            </div>
                        </div>
                        <! //QUI SOTTO CI SONO LE VALUTAZIONI IN STELLE TUTTE E 5 SULLA STESSA RIGA->
                            <div id="w-node-_0e779d34-7823-49d5-40c4-5ffff40550ee-8abcad94" class="action stars"><img src="https://assets-global.website-files.com/65db228c551539358abcad8e/65e6d02cb1d41240f646949d_star.png" loading="lazy" alt="" class="star"><img src="https://assets-global.website-files.com/65db228c551539358abcad8e/65e6d02cb1d41240f646949d_star.png" loading="lazy" alt="" class="star"><img src="https://assets-global.website-files.com/65db228c551539358abcad8e/65e6d02cb1d41240f646949d_star.png" loading="lazy" alt="" class="star"><img src="https://assets-global.website-files.com/65db228c551539358abcad8e/65e6d02cb1d41240f646949d_star.png" loading="lazy" alt="" class="star"><img src="https://assets-global.website-files.com/65db228c551539358abcad8e/65e6d02cb1d41240f646949d_star.png" loading="lazy" alt="" class="star"></div>
                            <! //CERTIFICATO->
                                <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a0a-8abcad94" class="action"><a id="AddCertificato" href="#" class="icon add w-button">Button Text</a><a href="#" class="icon download w-button">Button Text</a></div>
                                <! //TURNI->
                                    <div id="w-node-e2dab09d-b38f-8e66-1aef-091b33b2299f-8abcad94" class="action"><a id="AddCertificato" href="#" class="icon turni w-button">Button Text</a><a href="#" class="icon addturni w-button">Button Text</a></div>
                                    <! //STATO->
                                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a11-8abcad94" class="action"><a href="#" class="icon allerta w-button">Button Text</a><a href="#" class="icon pericolo w-button">Button Text</a></div>
                                        <! //SOLITI BOTTONI->
                                            <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a16-8abcad94" class="action"><a data-w-id="c6f7797d-88a6-66c5-3210-b528f2cf3a17" href="#" class="icon userdescrizioni w-button">Button Text</a><a href="#" class="icon useremail w-button">Button Text</a><a href="#" class="icon userremove w-button">Button Text</a></div>
                    </div>
            </section>
    -->

 <!--
            <section class="sezione" id="Tecnici">
                <! //PULSANTE TECNICI->
                    <div class="tabella-preset intestazione">
 
                    </div>
                    <div class="tabella-preset tabella">
                        <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186766-8abcad94" class="badge">
                            <div class="immagineprofilo"></div>
                            <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186768-8abcad94" class="datipersonali">
                                <div class="tabella-intestazioni cognomenome">Serpelloni Leonardo</div>
                                <div class="tabella-intestazioni abbonamento">Tecnogym</div>
                            </div>
                        </div>
                        <! //RIMANGONO PER CREARE GLI SPAZZI NELLA TABELLA->
                            <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a18676d-8abcad94" class="action"></div>
                            <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186773-8abcad94" class="action"></div>
                            <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186778-8abcad94" class="action"></div>
                            <! //=============->
                                <! //VISUALIZZA INTEVENTI VA CONNESSO ALL'HOVER SELECTION INFONDO QUELLO GIUSTO OBV->
                                    <div id="w-node-_111048e3-30a4-1baf-272f-ec6dc7bca0ea-8abcad94" class="action"><a id="Interventi" href="#" class="icon interventi w-button">Button Text</a></div>
                                    <! //SOLITI BOTTONI->
                                        <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186782-8abcad94" class="action"><a data-w-id="ed621fd0-2ab0-9e83-5b52-f24c8a186783" href="#" class="icon userdescrizioni w-button">Button Text</a><a href="#" class="icon useremail w-button">Button Text</a><a href="#" class="icon userremove w-button">Button Text</a></div>
                    </div>
            </section> -->
        </div>


    </section>

    <!-- //MOSTRA INTERVENTI-->
    <!--
    <div class="hoversection big">
        <div class="hoversection-container"><a data-w-id="719c2e5e-7bf0-9feb-7db1-81abd048c4fa" href="#" class="icon exit w-button"></a>
        Descrizione Interventi
            <div class="descrizione-interveti"><a data-w-id="635d1423-b80a-96ca-e31e-cb140af1169a" href="#" class="icon exit w-button"></a>
                <div class="name intesta descrizione">Descrizione</div>
                <p class="paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.</p>
            </div>
       ==================
            <div class="name intesta">Interventi di </div>
            <div class="name tecnico">Serpelloni Leonardo</div>
            <div class="tabella-interventi">
                <div class="interventi">
                    <div id="w-node-c7e6837f-7a95-b237-21f6-54d26221d846-8abcad94" class="tabella-intestazioni minore">Data</div>
                    <div id="w-node-e12b8708-9b95-3906-6e38-ca730dad28bb-8abcad94" class="tabella-intestazioni minore">Nome Macchinario</div>
                    <div id="w-node-a514b3bb-cfd0-6fb3-fddf-6d29a7782c59-8abcad94" class="tabella-intestazioni minore">Marca</div>
                    <div id="w-node-bb7b5282-8931-1bd8-3e8c-095c21447dd0-8abcad94" class="tabella-intestazioni minore">Descrizione</div>
                </div>
                <div class="interventi righe">
                    <div id="w-node-_2d0bdefd-89a6-a043-2285-ceab9d119dfa-8abcad94" class="tabella-testo">26/12/2023</div>
                    <div id="w-node-_7540a0cb-0461-bcda-e8e0-bdf317e75018-8abcad94" class="tabella-testo">Panca A</div>
                    <div id="w-node-fad7ae6d-ec01-1eb5-5327-b54c141faa3b-8abcad94" class="tabella-testo">Tecnogym</div><a id="w-node-_964ec2b4-ac3a-134a-2e87-78228df2a022-8abcad94" href="#" class="icon descrizione w-button"></a>
                </div>
            </div>
        </div>
    </div>

    -->

    <! //MOSTRA UTENTE->

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

<div class="hoversection small" id="rinnovaAbbonamento" style="display : none"><div class="hoversection-container">
    <a data-w-id="68bb2142-7955-cadb-9b5d-899d6979142a" class="icon exit w-button" id="leaveButton" onclick="closeRinnovaAbbonamento()"></a>
    <div class="name tecnico">Aggiungi Abbonamento</div>
</div>
<div class="aggiungi-abbonamento w-form">
    <form id="email-form-2" name="email-form-2" data-name="Email Form 2" method="get" action="gestioneSegreteria.php" class="form-3" data-wf-page-id="65db228c551539358abcad94" data-wf-element-id="caec41b9-4f34-3fcd-0de6-8da4dd580731" aria-label="Email Form 2">
        <select id="AbbonamentoType" name="AbbonamentoType" data-name="Abbonamento Type" class="select-field w-select">
            <option value="Basic">Basic</option>
            <option value="Silver">Silver</option>
            <option value="Gold">Gold</option>
            <option value="Platinum">Platinum</option>
        </select>
        <input type="submit" data-wait="Please wait..." class="addcertificazione w-button" value="Rinnova">
        <input type="hidden" id="customerId" name="index">  <!-- tramite javascript vado ad inserire come value il riferimento indice del cliente -->
    </form><div class="w-form-done" tabindex="-1">

    </div>
    <div class="w-form-fail" tabindex="-1"></div>
</div>
</div>

    <!--Mostra Turni-->
    
    <!-- 
      <div id="hoversection" class="hoversection">
        -----------
      <div id="hoversection-container" class="hoversection-container">
           -------------------------------------------------------- SEZIONE AGGIUNGI TURNO ---------------------------------------------- 
           <div class="aggiungiturno"><a data-w-id="635d1423-b80a-96ca-e31e-cb140af1169a" href="#" class="icon exit w-button"></a>
               <div class="addturnoform w-form">
                    <form id="email-form" name="email-form" data-name="Email Form" method="get" class="addturnoformcontainer" data-wf-page-id="65db228c551539358abcad94" data-wf-element-id="dae9bfdd-ed37-0bac-d5e4-b5ad2583b806" aria-label="Email Form">
                        <div class="giorno"><label for="Giorno-della-Settimana" class="field-label">Giorno</label><select id="Giorno-della-Settimana" name="Giorno-della-Settimana" data-name="Giorno della Settimana" required="" class="select-giorno w-select">
                                <option value="Lunedì">Lunedì</option>
                                <option value="Martedì">Martedì</option>
                                <option value="Mercoledì">Mercoledì</option>
                                <option value="Giovedì">Giovedì</option>
                                <option value="Venerdì">Venerdì</option>
                                <option value="Sabato">Sabato</option>
                                <option value="Domenica">Domenica</option>
                            </select></div>
                        <div class="orario"><label for="Orario" class="field-label-2">Orario</label><select id="Orario" name="Orario" data-name="Orario" required="" class="select-orario w-select">
                                <option value="7:00 - 12:00">7:00 - 12:00</option>
                                <option value="12:00 - 17:00">12:00 - 17:00</option>
                                <option value="17:00 - 22:00">17:00 - 22:00</option>
                            </select></div><input type="submit" data-wait="Please wait..." class="aggiungiturnoformsubmit w-button" value="Aggiungi">
                    </form>
                    <div class="w-form-done" tabindex="-1" role="region" aria-label="Email Form success"></div>
                    <div class="w-form-fail" tabindex="-1" role="region" aria-label="Email Form failure"></div>
                </div> 
            </div> 
                ------------------------------------------------------- FINE SEZIONE AGGIUNGI TURNO ------------------------------------------------>

            <!------------------------------------------ SEZIONE VISTA DEI TURNI -----------------------------------------------------------------
            <a data-w-id="719c2e5e-7bf0-9feb-7db1-81abd048c4fa" href="#" class="icon exit w-button"></a>
            <div class="name intesta">Tuni di </div>
            <div class="name tecnico">Serpelloni Leonardo</div>
            <div class="tabella-interventi">
                <div class="turni">
                    <div id="w-node-c7e6837f-7a95-b237-21f6-54d26221d846-8abcad94" class="tabella-intestazioni minore">Giorno</div>
                    <div id="w-node-e12b8708-9b95-3906-6e38-ca730dad28bb-8abcad94" class="tabella-intestazioni minore">Orario</div>
                </div>
                <div class="turni righe">
                    <div id="w-node-_2d0bdefd-89a6-a043-2285-ceab9d119dfa-8abcad94" class="tabella-testo">Lunedì</div>
                    <div id="w-node-fad7ae6d-ec01-1eb5-5327-b54c141faa3b-8abcad94" class="tabella-testo">8:00 - 12:00</div><a id="w-node-_964ec2b4-ac3a-134a-2e87-78228df2a022-8abcad94" href="#" class="icon deleteturno w-button"></a>
                </div>
            </div>
            <a href="#" class="addturno w-button">Aggiungi Turno</a>
            ------------------------------------------- FINE SEZIONE DI VISTA DEI TURNI --------------------------------------------------
        </div>  
    </div> -->

  <!------------------------------------------------------- MENU DI NAVIGAZIONE LATERALE ---------------------------------------------------------------->
    <div style="display:none" class="menu-descrizioni">
        <div class="descrizione">Home</div>
        <div class="descrizione">AddCliente</div>
    </div>
    <nav data-w-id="93085ae0-f7f2-eb6d-a80c-8ff237c72caf" class="menu-icone">
        <div class="notifications-3"><img src="https://assets-global.website-files.com/65db228c551539358abcad8e/65db2680c536bfa0459743bc_Vectors-Wrapper.svg" loading="lazy" width="24" height="24" alt="" class="vectors-wrapper-2" />
            <div class="badge-4">
                <div class="text-21">9</div>
            </div>
        </div><a href="#" class="menu-sezioni _0 w-button"></a><a href="#" class="menu-sezioni _1 w-button"></a>
    </nav>
    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=65db228c551539358abcad8e" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://assets-global.website-files.com/65db228c551539358abcad8e/js/webflow.399e61ad1.js" type="text/javascript"></script>
</body>

</html>