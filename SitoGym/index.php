<?php
require "php/gestioneLogin.php";
?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <title>GymWebSite</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Webflow" name="generator" />
    <link href="css/segreteriaStyle.css" rel="stylesheet" type="text/css" />
</head>

<body class="body"">

    <div class="container-allpage">
        <form class="login-container" action="php/loginVerify.php" method="post">
            <div class="login-titolo">Benvenuto</div>
            <div class="login-sottotitolo">Fai il login per accedere</div>
            <div class="login-form w-form">
                <form id="email-form-2" name="email-form-2" data-name="Email Form 2" method="get" class="login-form-container" data-wf-page-id="65e6e5aa5619ced63ab2bb7d" data-wf-element-id="6eeda59b-3bee-dba7-e719-e8787d460deb" aria-label="Email Form 2">
                    <div class="login-sezioneform">
                        <div class="login-input">
                            <div class="login-intestazioni">Nome Utente o Indirizzo Email</div><input class="login-email w-input" maxlength="256" name="Username" data-name="Email" placeholder="" type="text" id="Email" required="" onchange="AjaxCompilationFormError(this, 'mailError')">
                            <div class="error" id="mailError"></div>
                        </div>
                        <div class="login-input">
                            <div class="login-intestazioni">Password</div><input class="login-email w-input" maxlength="256" name="Password" data-name="Password" placeholder="" type="password" id="Password" required="">
                        </div><label class="w-checkbox checkbox-field"><input type="checkbox" name="RememberMe" id="RememberMe" data-name="RememberMe" class="w-checkbox-input checkbox"><span class="checkbox-label w-form-label" for="RememberMe">Remember me</span></label><input type="submit" data-wait="Please wait..." class="submit-button-2 w-button" value="Log In">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
