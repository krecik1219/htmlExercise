<?php

    require_once("../php_src/User.php");
    require_once("../php_src/Cart.php");
    session_start();

    if(isset($_SESSION["user"]) and $_SERVER["REQUEST_METHOD"] == "GET")
    {
        $shoppingCart = $_SESSION["user"]->getShoppingCart();
        $shoppingCart->resetCart();
        exit("Successful reset!");
    }
    else
    {
        header('Location: ../webstore.php');
        exit();
    }

?>
