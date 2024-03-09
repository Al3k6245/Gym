<?php
require('php/gestioneSegreteria.php');


if (!isset($_SESSION['Utenti'])) {
    //conterrà i codici fiscali degli utenti
    $_SESSION['Utenti'] = "";
    unset($_SESSION['Utenti']);
}



?>

<!DOCTYPE html>



<head>
    <meta charset="utf-8" />
    <title>GymWebSite</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Webflow" name="generator" />
    <link href="css/segreteriaStyle.css" rel="stylesheet" type="text/css" />
    <script src="javascript/gestioneAjaxSegreteria.js"></script>
    <script>
        type = "text/javascript" > ! function(o, c) {
            var n = c.documentElement,
                t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
        }(window, document);
    </script>

</head>

<body class="body">
    <section id="Home" class="content">
        <div class="container-dashboard">
            <div class="container-titolo">
                <h1 class="h1">Dashboard</h1>
            </div>
            <div class="navigazione"><a href="#" class="container-sezioni w-button">Overview</a>
                <a class="container-sezioni clienti w-button" onclick="AjaxChangeSection('Clienti')">Clienti</a>
                <a class="container-sezioni allenatori w-button" onclick="AjaxChangeSection('Allenatori')">Allenatori</a>
                <a href="#" class="container-sezioni personale w-button" onclick="AjaxChangeSection('Personale')">Personale</a>
                <form action="/search" class="search allineato w-form"><input class="search-input w-input" maxlength="256" name="query" placeholder="Search…" type="search" id="Ricerca" required="" /><input type="submit" class="search-button w-button" value="Search" /></form>
            </div>


            <!--SEZIONI TABELLE-->

            <section class="sezione" id="Clienti">

                <div id="headerTable" class="tabella-preset intestazione">

                    <?php // changeSectionHeader('Clienti'); 
                    ?>



                    <div id="w-node-fc24f30d-1aec-d2a5-d3ff-2037b8c12f21-8abcad94" class="ordinamento"><a id="w-node-fc24f30d-1aec-d2a5-d3ff-2037b8c12f22-8abcad94" href="#" class="icon w-button">Button T\ext</a>
                        <div id="w-node-_7a4c6629-342e-5245-d2aa-78ab28c0b1a4-8abcad94" class="ordinamentotype">
                            <a href="#" class="ordinamentotypeoptions w-button">Nome</a>
                            <a href="#" class="ordinamentotypeoptions w-button">Cognome</a>
                        </div>
                        <div class="tabella-intestazioni">Nome</div><a id="AddCertificato" href="#" class="icon down w-button">Button Text</a>
                    </div>

                    <div id="w-node-f9085910-da57-6f33-8ef5-d7a036b922fd-8abcad94" class="tabella-intestazioni">Data di Nascita</div>
                    <div id="w-node-_77fa6106-1215-cab2-2c21-f097827640c5-8abcad94" class="tabella-intestazioni">Certificato Medico</div>
                    <div id="w-node-_7c636b47-6c3b-9ba5-456d-9587c9010c02-8abcad94" class="tabella-intestazioni">Prossimo Pagamento</div>
                    <div id="w-node-_331035c0-2673-7786-554c-b0f5cbfe67ed-8abcad94" class="tabella-intestazioni">Stato</div>
                    <div id="w-node-f67c4198-9cf5-4fb6-08c0-04b32d7fe8f7-8abcad94" class="tabella-intestazioni">Azioni</div>

                </div>
                <div id="tabella-membri" class="tabella-preset tabella">
                    <!-- questa sezione viene riempita con php -->
                    <?php showMembers($conn); ?>
                </div>

            </section>



            <section class="sezione" id="Allenatori">
                <! //PULSANTE ALLENATORI->

                    <div class="tabella-preset intestazione">
                        <div id="w-node-fc24f30d-1aec-d2a5-d3ff-2037b8c12f21-8abcad94" class="ordinamento"><a id="w-node-fc24f30d-1aec-d2a5-d3ff-2037b8c12f22-8abcad94" href="#" class="icon w-button">Button T\ext</a>
                            <div id="w-node-_7a4c6629-342e-5245-d2aa-78ab28c0b1a4-8abcad94" class="ordinamentotype"><a href="#" class="ordinamentotypeoptions w-button">Nome</a><a href="#" class="ordinamentotypeoptions w-button">Cognome</a><a href="#" class="ordinamentotypeoptions w-button">Prossimo Pagamento</a></div>
                            <div class="tabella-intestazioni">Nome</div><a id="AddCertificato" href="#" class="icon down w-button">Button Text</a>
                        </div>

                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39f6-8abcad94" class="tabella-intestazioni">Valutazione</div>
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39f8-8abcad94" class="tabella-intestazioni">Certificato Medico</div>
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39fa-8abcad94" class="tabella-intestazioni">Turni</div>
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39fc-8abcad94" class="tabella-intestazioni">Stato</div>
                        <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf39fe-8abcad94" class="tabella-intestazioni">Azioni</div>

                    </div>
                    <div class="tabella-preset tabella">
                        <!--
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
                            -->
                    </div>
            </section>



            <section class="sezione" id="Tecnici">
                <! //PULSANTE TECNICI->
                    <div class="tabella-preset intestazione">

                        <div id="w-node-fc24f30d-1aec-d2a5-d3ff-2037b8c12f21-8abcad94" class="ordinamento"><a id="w-node-fc24f30d-1aec-d2a5-d3ff-2037b8c12f22-8abcad94" href="#" class="icon w-button">Button T\ext</a>
                            <div id="w-node-_7a4c6629-342e-5245-d2aa-78ab28c0b1a4-8abcad94" class="ordinamentotype"><a href="#" class="ordinamentotypeoptions w-button">Nome</a><a href="#" class="ordinamentotypeoptions w-button">Cognome</a><a href="#" class="ordinamentotypeoptions w-button">Prossimo Pagamento</a></div>
                            <div class="tabella-intestazioni">Nome</div><a id="AddCertificato" href="#" class="icon down w-button">Button Text</a>
                        </div>
                        <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a18675b-8abcad94" class="tabella-intestazioni"></div>
                        <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a18675d-8abcad94" class="tabella-intestazioni"></div>
                        <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a18675f-8abcad94" class="tabella-intestazioni"></div>
                        <div id="w-node-_35828d87-f20d-a151-91a1-b8bd56674064-8abcad94" class="tabella-intestazioni">Interventi</div>
                        <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186763-8abcad94" class="tabella-intestazioni">Azioni</div>

                    </div>
                    <div class="tabella-preset tabella">
                        <!--
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
                            -->
                    </div>
            </section>
        </div>


    </section>

    <!-- //MOSTRA INTERVENTI-->
    <!--
    <div class="hoversection big">
        <div class="hoversection-container"><a data-w-id="719c2e5e-7bf0-9feb-7db1-81abd048c4fa" href="#" class="icon exit w-button"></a>
           
            <div class="descrizione-interveti"><a data-w-id="635d1423-b80a-96ca-e31e-cb140af1169a" href="#" class="icon exit w-button"></a>
                <div class="name intesta descrizione">Descrizione</div>
                <p class="paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.</p>
            </div>
            
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
    <!-- //MOSTRA UTENTE-->
    <!--

    <div data-w-id="1ead45e8-3280-9d48-6405-e79982937b5c" class="hoversection">
        <div class="hoversection-container"><img src="https://assets-global.website-files.com/65db228c551539358abcad8e/65e62ac5c95d93ef05800b38_Rectangle.png" loading="lazy" width="Auto" alt="" class="fotoprofilo"><a data-w-id="859845ff-4b55-b293-93ca-957b1f255837" href="#" class="icon exit w-button"></a>
            <div class="name">Serpelloni Leonardo</div>
            <div class="intestazioneblack">Codice Fiscale </div>
            <div class="testowhite">SRPLRD05TL250W<br></div>
            <div class="intestazioneblack">Data di Nascita</div>
            <div class="testowhite">26/12/2005<br></div>
            <div class="intestazioneblack">Contatti</div>
            <div class="testowhite">youremail@gmail.com<br></div>
            <div class="intestazioneblack">Password Account</div>
            <div class="password">
                <div data-w-id="78352fc8-7684-5c14-63af-2a5582d1e910" style="filter: blur(0px);" class="testowhite password">as5s - sdf3 - ad2f<br></div>
            </div>
        </div>
    </div>
    -->

    <!--MOSTRA TURNI-->

    <div class="hoversection">
        <div class="hoversection-container">
            <div class="aggiungiturno">
                <div class="addturnoform w-form">
                    <div class="addturnoformcontainer">
                        <div class="giorno">
                            <label for="Giorno-della-Settimana" class="field-label">Giorno</label>
                            <select id="Giorno-della-Settimana" name="Giorno-della-Settimana" data-name="Giorno della Settimana" required class="select-giorno w-select">
                                <option value="Lunedì">Lunedì</option>
                                <option value="Martedì">Martedì</option>
                                <option value="Mercoledì">Mercoledì</option>
                                <option value="Giovedì">Giovedì</option>
                                <option value="Venerdì">Venerdì</option>
                                <option value="Sabato">Sabato</option>
                                <option value="Domenica">Domenica</option>
                            </select>
                        </div>
                        <div class="orario">
                            <label for="Orario" class="field-label-2">Orario</label>
                            <select id="Orario" name="Orario" data-name="Orario" required class="select-orario w-select">
                                <option value="7:00 - 12:00">7:00 - 12:00</option>
                                <option value="12:00 - 17:00">12:00 - 17:00</option>
                                <option value="17:00 - 22:00">17:00 - 22:00</option>
                            </select>
                        </div>
                        <input type="submit" class="aggiungiturnoformsubmit w-button" value="Aggiungi">
                    </div>

                </div>
            </div>
            <a data-w-id="719c2e5e-7bf0-9feb-7db1-81abd048c4fa" href="#" class="icon exit w-button"></a>
            <div class="name intesta">Turni di </div>
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
        </div>
    </div>


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