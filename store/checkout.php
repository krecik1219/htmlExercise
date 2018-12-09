<?php
    require_once ("php_src/User.php");
    require_once ("php_src/connection/StockConnection.php");
    require_once ("php_src/Cart.php");
    session_start();

    if(!isset($_SESSION["user"]))
    {
        header('Location: webstore.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="programming, languages, store, webstore, e-commerce,
        programming languages, c++, python, c, java, computer science, computing, shop,
        online, buy, payment, developers, IT, books, courses, video, audio">
    <meta name="description" content="This is polyglot webstore site">
    <title>Developers Webstore</title>

    <link rel="stylesheet" type="text/css" href="css/webstoreCommon.css">
    <script src="js/webstore.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
    <div class="userPanel">
        <?php
            echo('<span class="userName">'.$_SESSION["user"]->getName().' '.$_SESSION["user"]->getSurname().'</span>');
            echo('<a href="checkout.php"><img id="cartImg" src="img/cart.png" alt="Shopping cart"></a>[<span id="cartQuantity">'.
                $_SESSION["user"]->getShoppingCart()->getTotalQuantity().'</span>]');
            echo('<button class="logoutBtn" onclick="window.location.href=\'logout.php\'">logout</button>');
        ?>

    </div>
    <header class="titleBar">
        Checkout
    </header>
    <div class="contentContainer">
        <div class="cartContent">
            <?php
                $shoppingCart = $_SESSION["user"]->getShoppingCart();
                $cartItems = $shoppingCart->getCartItems();
                foreach($cartItems as $cartItem)
                {
                    $item = $cartItem->getItem();
                    $quantity = $cartItem->getQuantity();
                    $totalPrice = $cartItem->getTotalPrice();
                    echo('<div class="item">'.
                            '<div class="itemImgBlock">'.
                                '<img class="itemImg" src="'.$item->getPhotoUrl().'" alt="item" width="110" height="110">'.
                            '</div>'.
                            '<div class="itemDescr">'.
                                '<p class="itemName">'.$item->getName().'</p>'.
                                '<p class="itemDetails">'.$item->getDescription().'</p>'.
                            '</div>'.
                            '<div class="itemCartTools">'.
                                '<form class="addToCartForm" method="get" action="#">'.
                                    '<div class="priceBlock">'.
                                        '<p class="price">'.$item->getPrice().' $</p>'.
                                    '</div>'.
                                    '<div class="quantityBlock">'.
                                        '<button class="increaseBtn" type="button" onclick="addOneToCart(this, '.$item->getId().')">+</button>'.
                                        '<input class="quantity" type="number" title="quantity" value="'.$quantity.'">'.
                                        '<button class="decreaseBtn" type="button" onclick="removeFromCart(this, '.$item->getId().')">-</button>'.
                                    '</div>'.
                                    '<div class="priceBlock">'.
                                        '<p class="price">'.$totalPrice.' $</p>'.
                                    '</div>'.
                                    '<div class="floatClearDiv"></div>'.
                                '</form>'.
                            '</div>'.
                            '<div class="floatClearDiv"></div>'.
                        '</div>');
            }
            ?>
        </div>
    </div>
    <footer class="footer">
        <a href="webstore.php">Webstore main page</a> | <del>&copy;</del> Przemysław Szeliński, no rights at all.
    </footer>
</div>
</body>
</html>