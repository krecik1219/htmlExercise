<?php

    require_once("../php_src/User.php");
    require_once("../php_src/Cart.php");
    require_once("../php_src/CartItem.php");
    require_once("../php_src/connection/StockConnection.php");

    use cart\CartItem;
    use connection\StockConnection;

    session_start();

    if(isset($_SESSION["user"]) and $_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(!isset($_GET["id"]) or empty($_GET["id"]) or !isset($_GET["q"]) or empty($_GET["q"]))
            exit("Error: invalid GET request");
        if (!filter_var($_GET["id"], FILTER_VALIDATE_INT) or !filter_var($_GET["q"], FILTER_VALIDATE_INT))
        {
            exit("Error: invalid GET request. 'id' and 'q' are supposed to be positive integers");
        }
        $id = (int)$_GET["id"];
        $quantity = (int)$_GET["q"];
        if($quantity <= 0)
            exit("Error: invalid GET request. 'id' and 'q' are supposed to be positive integers");

        try
        {
            $stockConnection = new StockConnection();
            $item = $stockConnection->fetchItemById($id);
            $cartItem = new CartItem($item, $quantity);
            $shoppingCart = $_SESSION["user"]->getShoppingCart();
            $shoppingCart->addToCart($cartItem);
            exit("Success");
        } catch(Exception $e)
        {
            exit("Error: ".$e->getMessage());
        }

    }
    else
    {
        header('Location: ../webstore.php');
        exit();
    }

?>
