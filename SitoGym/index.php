<?php
session_start();

require('php/gestioneSegreteria.php');


if(!isset($_SESSION['Utenti']))   //conterrà i codici fiscali degli utenti
    $_SESSION['Utenti'];

?>

<!DOCTYPE html>
<!-- This site was created in Webflow. https://www.webflow.com --><!-- Last Published: Thu Feb 29 2024 17:18:46 GMT+0000 (Coordinated Universal Time) -->


<head>
    <meta charset="utf-8" />
    <title>GymWebSite</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Webflow" name="generator" />
    <link href="css/segreteriaStyle.css"
        rel="stylesheet" type="text/css" />
        <script src="javascript/gestioneAjaxSegreteria.js"></script>
    <script>
        type="text/javascript">!function (o, c) { var n = c.documentElement, t = " w-mod-"; n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch") }(window, document);</script>
    <link href="https://assets-global.website-files.com/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link href="https://assets-global.website-files.com/img/webclip.png" rel="apple-touch-icon" />
</head>

<body class="body">
    <section id="Home" class="content">
        <div class="container-dashboard">
            <div class="container-titolo">
                <h1 class="h1">Dashboard</h1>
            </div>
            <div class="navigazione"><a href="#" class="container-sezioni w-button">Overview</a><a href="#Clienti"
                    class="container-sezioni clienti w-button">Clienti</a><a href="#"
                    class="container-sezioni allenatori w-button">Allenatori</a><a href="#"
                    class="container-sezioni personale w-button">Personale</a>
                <form action="/search" class="search allineato w-form"><input class="search-input w-input"
                        maxlength="256" name="query" placeholder="Search…" type="search" id="Ricerca"
                        required="" /><input type="submit" class="search-button w-button" value="Search" /></form>
            </div>
            <section id="Clienti" class="sezione">
                <div class="tabella-preset intestazione">
                    <div id="w-node-_7a4c6629-342e-5245-d2aa-78ab28c0b1a4-8abcad94" class="ordinamento"><a
                            id="w-node-b93641eb-4e20-97e4-b67a-f8a3cfa75ef0-8abcad94" href="#"
                            class="icon w-button">Button T\ext</a><a
                            id="w-node-_8ff9f816-7a02-1223-d680-7b0a78005161-8abcad94" href="#"
                            class="ordinamentoupdown w-button">Nome</a></div>
                    <div id="w-node-f9085910-da57-6f33-8ef5-d7a036b922fd-8abcad94" class="tabella-intestazioni">Data di
                               Prossimo Pagamento</div>
                    <div id="w-node-_331035c0-2673-7786-554c-b0f5cbfe67ed-8abcad94" class="tabella-intestazioni">Stato
                    </div>
                    <div id="w-node-_331035c0-2673-7786-554c-b0f5cbfe67ed-8abcad94" class="tabella-intestazioni">Nascita
                    </div>
                    <div id="w-node-_77fa6106-1215-cab2-2c21-f097827640c5-8abcad94" class="tabella-intestazioni">
                        Certificato Medico</div>
                    <div id="w-node-_7c636b47-6c3b-9ba5-456d-9587c9010c02-8abcad94" class="tabella-intestazioni">
                    <div id="w-node-f67c4198-9cf5-4fb6-08c0-04b32d7fe8f7-8abcad94" class="tabella-intestazioni">Azioni
                    </div>
                </div>
                 </div>
                    
                <div id="tabella-membri" class="tabella-preset tabella">
                    <!-- questa sezione viene riempita con php -->
                    <?php showMembers($conn); ?>
                </div>
            </section>
        </div>
    </section>
    <div style="display:none" class="menu-descrizioni">
        <div class="descrizione">Home</div>
        <div class="descrizione">AddCliente</div>
    </div>
    <nav data-w-id="93085ae0-f7f2-eb6d-a80c-8ff237c72caf" class="menu-icone">
        <div class="notifications-3"><img
                src="https://assets-global.website-files.com/65db228c551539358abcad8e/65db2680c536bfa0459743bc_Vectors-Wrapper.svg"
                loading="lazy" width="24" height="24" alt="" class="vectors-wrapper-2" />
            <div class="badge-4">
                <div class="text-21">9</div>
            </div>
        </div><a href="#" class="menu-sezioni _0 w-button"></a><a href="#" class="menu-sezioni _1 w-button"></a>
    </nav>
    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=65db228c551539358abcad8e"
        type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script src="https://assets-global.website-files.com/65db228c551539358abcad8e/js/webflow.399e61ad1.js"
        type="text/javascript"></script>


<div class="hoversection-container"><img src="https://assets-global.website-files.com/65db228c551539358abcad8e/65e62ac5c95d93ef05800b38_Rectangle.png" loading="lazy" width="Auto" alt="" class="fotoprofilo"><a data-w-id="859845ff-4b55-b293-93ca-957b1f255837" href="#" class="icon exit w-button"></a><div class="name">Serpelloni Leonardo</div><div class="intestazioneblack">Codice Fiscale </div><div class="testowhite">SRPLRD05TL250W<br></div><div class="intestazioneblack">Data di Nascita</div><div class="testowhite">26/12/2005<br></div><div class="intestazioneblack">Contatti</div><div class="testowhite">youremail@gmail.com<br></div><div class="intestazioneblack">Password Account</div><div class="password"><div data-w-id="78352fc8-7684-5c14-63af-2a5582d1e910" style="filter: blur(0px);" class="testowhite password">as5s - sdf3 - ad2f<br></div></div></div>

</body>

</html>