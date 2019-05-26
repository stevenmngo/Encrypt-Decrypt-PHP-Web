<?php

    if(isset($_POST["SignOutSubmit"])) {
        $_SESSION = array();
        session_destroy();
    }
?>