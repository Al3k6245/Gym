<?php

if($_SERVER["REQUEST_METHOD"] == "GET"){

    if(isset($_GET['error']) && $_GET['error'] = 'invalid'){
        echo '<script type="text/javascript">alert("Username o password errati");</script>';
    }

}


?>