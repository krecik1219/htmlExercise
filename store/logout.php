<?php

    session_start();

    // guard against accessing logout script as not logged in user
    if(!isset($_SESSION["user"]))
    {
        header("Location: webstore.php");
        exit();
    }

    session_unset();
    header('Location: webstore.php');
?>