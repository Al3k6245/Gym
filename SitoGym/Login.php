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

    <div class="container-allpage">
        <div class="login-container">
            <div class="login-titolo">Welcome Back</div>
            <div class="login-sottotitolo">Please log in to continue</div>
            <div class="login-form w-form">
                <form id="email-form-2" name="email-form-2" data-name="Email Form 2" method="get" class="login-form-container" data-wf-page-id="65e6e5aa5619ced63ab2bb7d" data-wf-element-id="6eeda59b-3bee-dba7-e719-e8787d460deb" aria-label="Email Form 2">
                    <div class="login-sezioneform">
                        <div class="login-input">
                            <div class="login-intestazioni">Email Address</div><input class="login-email w-input" maxlength="256" name="Email" data-name="Email" placeholder="" type="email" id="Email" required="">
                            <div class="error">Errore Errore Errore Errore Errore Errore Errore Errore Errore </div>
                        </div>
                        <div class="login-input">
                            <div class="login-intestazioni">Password</div><input class="login-email w-input" maxlength="256" name="Password" data-name="Password" placeholder="" type="password" id="Password" required="">
                            <div class="error">Errore Errore Errore Errore Errore Errore Errore Errore Errore </div>
                        </div><label class="w-checkbox checkbox-field"><input type="checkbox" name="RememberMe" id="RememberMe" data-name="RememberMe" class="w-checkbox-input checkbox"><span class="checkbox-label w-form-label" for="RememberMe">Remember me</span></label><input type="submit" data-wait="Please wait..." class="submit-button-2 w-button" value="Log In">
                    </div>
                </form>
                <div class="w-form-done" tabindex="-1" role="region" aria-label="Email Form 2 success">
                    <div>Thank you! Your submission has been received!</div>
                </div>
                <div class="w-form-fail" tabindex="-1" role="region" aria-label="Email Form 2 failure">
                    <div>Oops! Something went wrong while submitting the form.</div>
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