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

        <div class="container-add">
            <div class="container-titolo">
                <h1 class="h1">Allenamento </h1>
            </div>
            <div class="grindesercizi">
                <div class="esercizio">
                    <div class="titoloesercizio">Lento Avanti</div>
                    <div class="muscolicontent">
                        <div class="muscoli">Primario : Spalle</div>
                        <div class="muscoli">Secondario : </div>
                    </div>
                    <div class="attrezzaturacontent">
                        <div class="attrezzatura-titolo">Attrezzatura :</div>
                        <div class="attrezzatura">Manubrio</div>
                    </div>
                    <div class="tabella-esercizio-intestazioni">
                        <div id="w-node-_0d2f7ea7-7340-30ef-3183-e26b9baf5485-3ab2bb7d" class="intestazionetabellaesercizio">SERIE</div>
                        <div id="w-node-_6533e957-45c4-825d-61e1-b9b8c432c410-3ab2bb7d" class="intestazionetabellaesercizio">KG</div>
                        <div id="w-node-fcd2c055-390a-9682-a17d-92d2a3448a71-3ab2bb7d" class="intestazionetabellaesercizio">RIPETIZIONI</div>
                    </div>
                    <div class="tabella-esercizio-record">
                        <div id="w-node-fc832516-7366-2c6b-16ac-e34ce02c93e0-3ab2bb7d" class="recordtabellaesercizio serie">1</div>
                        <div id="w-node-fc832516-7366-2c6b-16ac-e34ce02c93e2-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-fc832516-7366-2c6b-16ac-e34ce02c93e4-3ab2bb7d" class="recordtabellaesercizio">13</div>
                        <div id="w-node-cbead8d0-c85a-9f92-33f0-ac28ffce585d-3ab2bb7d" class="recordtabellaesercizio serie">2</div>
                        <div id="w-node-_80dd30e7-3882-6266-35d3-04110f01c391-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-_3dd09f1a-5a5c-629e-e282-371192357fa9-3ab2bb7d" class="recordtabellaesercizio">13</div>
                    </div>
                </div>
                <div class="esercizio">
                    <div class="titoloesercizio">Lento Avanti</div>
                    <div class="muscolicontent">
                        <div class="muscoli">Primario : Spalle</div>
                        <div class="muscoli">Secondario : </div>
                    </div>
                    <div class="attrezzaturacontent">
                        <div class="attrezzatura-titolo">Attrezzatura :</div>
                        <div class="attrezzatura">Manubrio</div>
                    </div>
                    <div class="tabella-esercizio-intestazioni">
                        <div id="w-node-_97d4c80f-453d-dfcd-46eb-b59e76732d1d-3ab2bb7d" class="intestazionetabellaesercizio">SERIE</div>
                        <div id="w-node-_97d4c80f-453d-dfcd-46eb-b59e76732d1f-3ab2bb7d" class="intestazionetabellaesercizio">KG</div>
                        <div id="w-node-_97d4c80f-453d-dfcd-46eb-b59e76732d21-3ab2bb7d" class="intestazionetabellaesercizio">RIPETIZIONI</div>
                    </div>
                    <div class="tabella-esercizio-record">
                        <div id="w-node-_97d4c80f-453d-dfcd-46eb-b59e76732d24-3ab2bb7d" class="recordtabellaesercizio serie">1</div>
                        <div id="w-node-_97d4c80f-453d-dfcd-46eb-b59e76732d26-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-_97d4c80f-453d-dfcd-46eb-b59e76732d28-3ab2bb7d" class="recordtabellaesercizio">13</div>
                        <div id="w-node-_97d4c80f-453d-dfcd-46eb-b59e76732d2a-3ab2bb7d" class="recordtabellaesercizio serie">2</div>
                        <div id="w-node-_97d4c80f-453d-dfcd-46eb-b59e76732d2c-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-_97d4c80f-453d-dfcd-46eb-b59e76732d2e-3ab2bb7d" class="recordtabellaesercizio">13</div>
                    </div>
                </div>
                <div class="esercizio">
                    <div class="titoloesercizio">Lento Avanti</div>
                    <div class="muscolicontent">
                        <div class="muscoli">Primario : Spalle</div>
                        <div class="muscoli">Secondario : </div>
                    </div>
                    <div class="attrezzaturacontent">
                        <div class="attrezzatura-titolo">Attrezzatura :</div>
                        <div class="attrezzatura">Manubrio</div>
                    </div>
                    <div class="tabella-esercizio-intestazioni">
                        <div id="w-node-_2424041a-aaab-56b8-2b6e-edc97f64bc30-3ab2bb7d" class="intestazionetabellaesercizio">SERIE</div>
                        <div id="w-node-_2424041a-aaab-56b8-2b6e-edc97f64bc32-3ab2bb7d" class="intestazionetabellaesercizio">KG</div>
                        <div id="w-node-_2424041a-aaab-56b8-2b6e-edc97f64bc34-3ab2bb7d" class="intestazionetabellaesercizio">RIPETIZIONI</div>
                    </div>
                    <div class="tabella-esercizio-record">
                        <div id="w-node-_2424041a-aaab-56b8-2b6e-edc97f64bc37-3ab2bb7d" class="recordtabellaesercizio serie">1</div>
                        <div id="w-node-_2424041a-aaab-56b8-2b6e-edc97f64bc39-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-_2424041a-aaab-56b8-2b6e-edc97f64bc3b-3ab2bb7d" class="recordtabellaesercizio">13</div>
                        <div id="w-node-_2424041a-aaab-56b8-2b6e-edc97f64bc3d-3ab2bb7d" class="recordtabellaesercizio serie">2</div>
                        <div id="w-node-_2424041a-aaab-56b8-2b6e-edc97f64bc3f-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-_2424041a-aaab-56b8-2b6e-edc97f64bc41-3ab2bb7d" class="recordtabellaesercizio">13</div>
                    </div>
                </div>
                <div class="esercizio">
                    <div class="titoloesercizio">Lento Avanti</div>
                    <div class="muscolicontent">
                        <div class="muscoli">Primario : Spalle</div>
                        <div class="muscoli">Secondario : </div>
                    </div>
                    <div class="attrezzaturacontent">
                        <div class="attrezzatura-titolo">Attrezzatura :</div>
                        <div class="attrezzatura">Manubrio</div>
                    </div>
                    <div class="tabella-esercizio-intestazioni">
                        <div id="w-node-_3169a467-614b-ff0c-cf9c-3823945b0bb3-3ab2bb7d" class="intestazionetabellaesercizio">SERIE</div>
                        <div id="w-node-_3169a467-614b-ff0c-cf9c-3823945b0bb5-3ab2bb7d" class="intestazionetabellaesercizio">KG</div>
                        <div id="w-node-_3169a467-614b-ff0c-cf9c-3823945b0bb7-3ab2bb7d" class="intestazionetabellaesercizio">RIPETIZIONI</div>
                    </div>
                    <div class="tabella-esercizio-record">
                        <div id="w-node-_3169a467-614b-ff0c-cf9c-3823945b0bba-3ab2bb7d" class="recordtabellaesercizio serie">1</div>
                        <div id="w-node-_3169a467-614b-ff0c-cf9c-3823945b0bbc-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-_3169a467-614b-ff0c-cf9c-3823945b0bbe-3ab2bb7d" class="recordtabellaesercizio">13</div>
                        <div id="w-node-_3169a467-614b-ff0c-cf9c-3823945b0bc0-3ab2bb7d" class="recordtabellaesercizio serie">2</div>
                        <div id="w-node-_3169a467-614b-ff0c-cf9c-3823945b0bc2-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-_3169a467-614b-ff0c-cf9c-3823945b0bc4-3ab2bb7d" class="recordtabellaesercizio">13</div>
                    </div>
                </div>
                <div class="esercizio">
                    <div class="titoloesercizio">Lento Avanti</div>
                    <div class="muscolicontent">
                        <div class="muscoli">Primario : Spalle</div>
                        <div class="muscoli">Secondario : </div>
                    </div>
                    <div class="attrezzaturacontent">
                        <div class="attrezzatura-titolo">Attrezzatura :</div>
                        <div class="attrezzatura">Manubrio</div>
                    </div>
                    <div class="tabella-esercizio-intestazioni">
                        <div id="w-node-_667a6a01-b49e-385f-a47d-de84861ef27a-3ab2bb7d" class="intestazionetabellaesercizio">SERIE</div>
                        <div id="w-node-_667a6a01-b49e-385f-a47d-de84861ef27c-3ab2bb7d" class="intestazionetabellaesercizio">KG</div>
                        <div id="w-node-_667a6a01-b49e-385f-a47d-de84861ef27e-3ab2bb7d" class="intestazionetabellaesercizio">RIPETIZIONI</div>
                    </div>
                    <div class="tabella-esercizio-record">
                        <div id="w-node-_667a6a01-b49e-385f-a47d-de84861ef281-3ab2bb7d" class="recordtabellaesercizio serie">1</div>
                        <div id="w-node-_667a6a01-b49e-385f-a47d-de84861ef283-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-_667a6a01-b49e-385f-a47d-de84861ef285-3ab2bb7d" class="recordtabellaesercizio">13</div>
                        <div id="w-node-_667a6a01-b49e-385f-a47d-de84861ef287-3ab2bb7d" class="recordtabellaesercizio serie">2</div>
                        <div id="w-node-_667a6a01-b49e-385f-a47d-de84861ef289-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-_667a6a01-b49e-385f-a47d-de84861ef28b-3ab2bb7d" class="recordtabellaesercizio">13</div>
                    </div>
                </div>
                <div class="esercizio">
                    <div class="titoloesercizio">Lento Avanti</div>
                    <div class="muscolicontent">
                        <div class="muscoli">Primario : Spalle</div>
                        <div class="muscoli">Secondario : </div>
                    </div>
                    <div class="attrezzaturacontent">
                        <div class="attrezzatura-titolo">Attrezzatura :</div>
                        <div class="attrezzatura">Manubrio</div>
                    </div>
                    <div class="tabella-esercizio-intestazioni">
                        <div id="w-node-_07aebbb4-c4c6-1f8f-7192-d215d978260c-3ab2bb7d" class="intestazionetabellaesercizio">SERIE</div>
                        <div id="w-node-_07aebbb4-c4c6-1f8f-7192-d215d978260e-3ab2bb7d" class="intestazionetabellaesercizio">KG</div>
                        <div id="w-node-_07aebbb4-c4c6-1f8f-7192-d215d9782610-3ab2bb7d" class="intestazionetabellaesercizio">RIPETIZIONI</div>
                    </div>
                    <div class="tabella-esercizio-record">
                        <div id="w-node-_07aebbb4-c4c6-1f8f-7192-d215d9782613-3ab2bb7d" class="recordtabellaesercizio serie">1</div>
                        <div id="w-node-_07aebbb4-c4c6-1f8f-7192-d215d9782615-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-_07aebbb4-c4c6-1f8f-7192-d215d9782617-3ab2bb7d" class="recordtabellaesercizio">13</div>
                        <div id="w-node-_07aebbb4-c4c6-1f8f-7192-d215d9782619-3ab2bb7d" class="recordtabellaesercizio serie">2</div>
                        <div id="w-node-_07aebbb4-c4c6-1f8f-7192-d215d978261b-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-_07aebbb4-c4c6-1f8f-7192-d215d978261d-3ab2bb7d" class="recordtabellaesercizio">13</div>
                    </div>
                </div>
                <div class="esercizio">
                    <div class="titoloesercizio">Lento Avanti</div>
                    <div class="muscolicontent">
                        <div class="muscoli">Primario : Spalle</div>
                        <div class="muscoli">Secondario : </div>
                    </div>
                    <div class="attrezzaturacontent">
                        <div class="attrezzatura-titolo">Attrezzatura :</div>
                        <div class="attrezzatura">Manubrio</div>
                    </div>
                    <div class="tabella-esercizio-intestazioni">
                        <div id="w-node-_8cf09b97-8192-1bcc-1ebc-68f524822207-3ab2bb7d" class="intestazionetabellaesercizio">SERIE</div>
                        <div id="w-node-_8cf09b97-8192-1bcc-1ebc-68f524822209-3ab2bb7d" class="intestazionetabellaesercizio">KG</div>
                        <div id="w-node-_8cf09b97-8192-1bcc-1ebc-68f52482220b-3ab2bb7d" class="intestazionetabellaesercizio">RIPETIZIONI</div>
                    </div>
                    <div class="tabella-esercizio-record">
                        <div id="w-node-_8cf09b97-8192-1bcc-1ebc-68f52482220e-3ab2bb7d" class="recordtabellaesercizio serie">1</div>
                        <div id="w-node-_8cf09b97-8192-1bcc-1ebc-68f524822210-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-_8cf09b97-8192-1bcc-1ebc-68f524822212-3ab2bb7d" class="recordtabellaesercizio">13</div>
                        <div id="w-node-_8cf09b97-8192-1bcc-1ebc-68f524822214-3ab2bb7d" class="recordtabellaesercizio serie">2</div>
                        <div id="w-node-_8cf09b97-8192-1bcc-1ebc-68f524822216-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-_8cf09b97-8192-1bcc-1ebc-68f524822218-3ab2bb7d" class="recordtabellaesercizio">13</div>
                    </div>
                </div>
                <div class="esercizio">
                    <div class="titoloesercizio">Lento Avanti</div>
                    <div class="muscolicontent">
                        <div class="muscoli">Primario : Spalle</div>
                        <div class="muscoli">Secondario : </div>
                    </div>
                    <div class="attrezzaturacontent">
                        <div class="attrezzatura-titolo">Attrezzatura :</div>
                        <div class="attrezzatura">Manubrio</div>
                    </div>
                    <div class="tabella-esercizio-intestazioni">
                        <div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1efd-3ab2bb7d" class="intestazionetabellaesercizio">SERIE</div>
                        <div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1eff-3ab2bb7d" class="intestazionetabellaesercizio">KG</div>
                        <div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1f01-3ab2bb7d" class="intestazionetabellaesercizio">RIPETIZIONI</div>
                    </div>
                    <div class="tabella-esercizio-record">
                        <div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1f04-3ab2bb7d" class="recordtabellaesercizio serie">1</div>
                        <div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1f06-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1f08-3ab2bb7d" class="recordtabellaesercizio">13</div>
                        <div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1f0a-3ab2bb7d" class="recordtabellaesercizio serie">2</div>
                        <div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1f0c-3ab2bb7d" class="recordtabellaesercizio">30</div>
                        <div id="w-node-beed0947-4e5f-c98f-c6cb-75e9ddbe1f0e-3ab2bb7d" class="recordtabellaesercizio">13</div>
                    </div>
                </div>
            </div>
        </div>


    </section>

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