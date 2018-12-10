<?php
    require_once ("php_src/User.php");
    require_once ("php_src/connection/StockConnection.php");
    require_once ("php_src/Cart.php");
    session_start();

    use connection\StockConnection;

    try
    {
        $connection = new StockConnection();
        $subcategory = 2;  // default subcategory
        if(isset($_GET["sc"]))  // subcategory is set - display appropriate items
            $subcategory = $_GET["sc"];
        $items = $connection->fetchItemsBySubcategory($subcategory);
    } catch (Exception $e)
    {
        die("Sorry, we had an error: ".$e->getMessage());
    }

    $bgColor = "#daa0b8";
    if(isset($_COOKIE["websiteBGColor"]))
        $bgColor = $_COOKIE["websiteBGColor"];
    $fontFamily = "Arial";
    if(isset($_COOKIE["userFontFamily"]))
        $fontFamily = $_COOKIE["userFontFamily"];
    $fontColor = "#000000";
    if(isset($_COOKIE["userFontColor"]))
        $fontColor = $_COOKIE["userFontColor"];
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
    <link rel="stylesheet" type="text/css" href="css/webstoreMain.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/webstore.js" type="text/javascript"></script>
</head>
<?php
    echo('<body style="color: '.$fontColor.'; background-color: '.$bgColor.'; font-family: '.$fontFamily.'">');
?>
    <div class="container">
        <div class="userPanel">
            <?php
                if(!isset($_SESSION["user"]))
                {
                    echo('<button class="signInBtn" onclick="window.location.href=\'login.php\'">sign in</button>');
                    echo('<button class="signUpBtn" onclick="window.location.href=\'registration.php\'">sign up</button>');
                }
                else
                {
                    echo('<span class="userName"><a href = "preferences.php">'.$_SESSION["user"]->getName().' '.$_SESSION["user"]->getSurname().'</a></span>');
                    echo('<a href="checkout.php"><img id="cartImg" src="img/cart.png" alt="Shopping cart"></a>[<span id="cartQuantity">'.
                            $_SESSION["user"]->getShoppingCart()->getTotalQuantity().'</span>]');
                    echo('<button class="logoutBtn" onclick="window.location.href=\'scripts/logout.php\'">logout</button>');
                }
            ?>

        </div>
        <header class="titleBar">
            Developers Webstore
        </header>
        <div class="contentContainer">
            <div class="categories">
                <ul>
                    <li>Books
                        <ul>
                            <li><a href="?sc=2">C++</a></li>
                            <li><a href="?sc=3">C</a></li>
                            <li>Java</li>
                            <li>Python</li>
                        </ul>
                    </li>
                    <li>Videos
                        <ul>
                            <li>C++</li>
                            <li>C</li>
                            <li>Java</li>
                            <li>Python</li>
                        </ul>
                    </li>
                    <li>Accessories
                        <ul>
                            <li>T-shirts</li>
                            <li>Caps/hats</li>
                            <li>Mugs</li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="mainContent">
                <div class="category">
                    Recommended for you
                </div>
                <div class="items">
                    <?php
                        if(isset($items))
                        {
                            foreach($items as $item)
                            {
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
                                                '<button class="increaseBtn" type="button" onclick="increaseItemQuantity(this)">+</button>'.
                                                '<input class="quantity" type="number" title="quantity" value="0">'.
                                                '<button class="decreaseBtn" type="button" onclick="decreaseItemQuantity(this)">-</button>'.
                                            '</div>'.
                                            '<div class="addToCartBlock">'.
                                                '<input class="addToCartBtn" type="submit" title="addToCart" Value="Cart++" onclick="addMultipleToCart(this, '.$item->getId().')">'.
                                            '</div>'.
                                            '<div class="floatClearDiv"></div>'.
                                        '</form>'.
                                    '</div>'.
                                    '<div class="floatClearDiv"></div>'.
                                '</div>');
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="bookmarks">
                <ul>
                    <li>Programming polyglot</li>
                    <li>C++ section</li>
                    <li>C section</li>
                    <li>Java section</li>
                    <li>Python section</li>
                </ul>
            </div>
            <div class="floatClearDiv"></div>
        </div>
        <footer class="footer">
            <del>&copy;</del> Przemysław Szeliński, no rights at all.
        </footer>
    </div>
</body>
</html>