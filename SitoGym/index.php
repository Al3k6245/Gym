<?php
session_start();

require('php/gestioneSegreteria.php');


    $_SESSION['Utenti'];

?>

<!DOCTYPE html>
<!-- This site was created in Webflow. https://www.webflow.com --><!-- Last Published: Thu Feb 29 2024 17:18:46 GMT+0000 (Coordinated Universal Time) -->


<head>
    <meta charset="utf-8" />
    <title>GymWebSite</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Webflow" name="generator" />
    <script>
    <link href="https://assets-global.website-files.com/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link href="https://assets-global.website-files.com/img/webclip.png" rel="apple-touch-icon" />
</head>

<body class="body">
    <section id="Home" class="content">
        <div class="container-dashboard">
            <div class="container-titolo">
                <h1 class="h1">Dashboard</h1>
            </div>
            </div>

            <section id="Clienti" class="sezione"> //PULSANTE CLIENTI
                <div class="tabella-preset intestazione">
                    <div id="w-node-_7a4c6629-342e-5245-d2aa-78ab28c0b1a4-8abcad94" class="ordinamento"><a id="w-node-b93641eb-4e20-97e4-b67a-f8a3cfa75ef0-8abcad94" href="#" class="icon w-button">Button T\ext</a><a id="w-node-_8ff9f816-7a02-1223-d680-7b0a78005161-8abcad94" href="#" class="ordinamentoupdown w-button">Nome</a></div>
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



            <section class="sezione" id="Allenatori"> //PULSANTE ALLENATORI
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
                    <div id="w-node-_0e779d34-7823-49d5-40c4-5ffff40550ee-8abcad94" class="action stars"><img src="https://assets-global.website-files.com/65db228c551539358abcad8e/65e6d02cb1d41240f646949d_star.png" loading="lazy" alt="" class="star"><img src="https://assets-global.website-files.com/65db228c551539358abcad8e/65e6d02cb1d41240f646949d_star.png" loading="lazy" alt="" class="star"><img src="https://assets-global.website-files.com/65db228c551539358abcad8e/65e6d02cb1d41240f646949d_star.png" loading="lazy" alt="" class="star"><img src="https://assets-global.website-files.com/65db228c551539358abcad8e/65e6d02cb1d41240f646949d_star.png" loading="lazy" alt="" class="star"><img src="https://assets-global.website-files.com/65db228c551539358abcad8e/65e6d02cb1d41240f646949d_star.png" loading="lazy" alt="" class="star"></div>
                    <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a0a-8abcad94" class="action"><a id="AddCertificato" href="#" class="icon add w-button">Button Text</a><a href="#" class="icon download w-button">Button Text</a></div>
                    <div id="w-node-e2dab09d-b38f-8e66-1aef-091b33b2299f-8abcad94" class="action"><a id="AddCertificato" href="#" class="icon turni w-button">Button Text</a><a href="#" class="icon addturni w-button">Button Text</a></div>
                    <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a11-8abcad94" class="action"><a href="#" class="icon allerta w-button">Button Text</a><a href="#" class="icon pericolo w-button">Button Text</a></div>
                    <div id="w-node-c6f7797d-88a6-66c5-3210-b528f2cf3a16-8abcad94" class="action"><a data-w-id="c6f7797d-88a6-66c5-3210-b528f2cf3a17" href="#" class="icon userdescrizioni w-button">Button Text</a><a href="#" class="icon useremail w-button">Button Text</a><a href="#" class="icon userremove w-button">Button Text</a></div>
                </div>
            </section>



            <section class="sezione" id="Tecnici"> //PULSANTE TECNICI
                <div class="tabella-preset intestazione">
                    <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186756-8abcad94" class="ordinamento"><a id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186757-8abcad94" href="#" class="icon w-button">Button T\ext</a><a id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186759-8abcad94" href="#" class="ordinamentoupdown w-button">Nome</a></div>
                    <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a18675b-8abcad94" class="tabella-intestazioni"></div>
                    <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a18675d-8abcad94" class="tabella-intestazioni"></div>
                    <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a18675f-8abcad94" class="tabella-intestazioni"></div>
                    <div id="w-node-_35828d87-f20d-a151-91a1-b8bd56674064-8abcad94" class="tabella-intestazioni">Interventi</div>
                    <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186763-8abcad94" class="tabella-intestazioni">Azioni</div>
                </div>
                <div class="tabella-preset tabella">
                    <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186766-8abcad94" class="badge">
                        <div class="immagineprofilo"></div>
                        <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186768-8abcad94" class="datipersonali">
                            <div class="tabella-intestazioni cognomenome">Serpelloni Leonardo</div>
                            <div class="tabella-intestazioni abbonamento">Tecnogym</div>
                        </div>
                    </div>
                    <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a18676d-8abcad94" class="action stars"></div>
                    <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186773-8abcad94" class="action"></div>
                    <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186778-8abcad94" class="action"></div>
                    <div id="w-node-_111048e3-30a4-1baf-272f-ec6dc7bca0ea-8abcad94" class="action"><a id="Interventi" href="#" class="icon interventi w-button">Button Text</a></div>
                    <div id="w-node-ed621fd0-2ab0-9e83-5b52-f24c8a186782-8abcad94" class="action"><a data-w-id="ed621fd0-2ab0-9e83-5b52-f24c8a186783" href="#" class="icon userdescrizioni w-button">Button Text</a><a href="#" class="icon useremail w-button">Button Text</a><a href="#" class="icon userremove w-button">Button Text</a></div>
                </div>
            </section>
        </div>
    </section>
    <div style="display:none" class="menu-descrizioni">
        <div class="descrizione">Home</div>
        <div class="descrizione">AddCliente</div>
    </div>
    <nav data-w-id="93085ae0-f7f2-eb6d-a80c-8ff237c72caf" class="menu-icone">
            <div class="badge-4">
                <div class="text-21">9</div>
            </div>
        </div><a href="#" class="menu-sezioni _0 w-button"></a><a href="#" class="menu-sezioni _1 w-button"></a>
    </nav>
</body>

</html>