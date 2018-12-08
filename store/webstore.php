<?php
    require_once ("php_src/User.php");
    session_start();
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

    <link rel="stylesheet" type="text/css" href="css/webstoreMain.css">
    <script src="js/webstore.js" type="text/javascript"></script>
</head>
<body>
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
                    echo($_SESSION["user"]->getName().' '.$_SESSION["user"]->getSurname().' ');
                    echo('<button class="logoutBtn" onclick="window.location.href=\'logout.php\'">logout</button>');
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
                            <li>C++</li>
                            <li>C</li>
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
                    <div class="item">
                        <div class="itemImgBlock">
                            <img class="itemImg" src="img/shop.png" alt="item" width="110" height="110">
                        </div>
                        <div class="itemDescr">
                            <p class="itemName">Item 1</p>
                            <p class="itemDetails">Detailed descr of item 1</p>
                        </div>
                        <div class="itemCartTools">
                            <form class="addToCartForm" method="get" action="#">
                                <div class="quantityBlock">
                                    <button class="increaseBtn" type="button">+</button>
                                    <input class="quantity" type="number" title="quantity">
                                    <button class="decreaseBtn" type="button">-</button>
                                </div>
                                <div class="addToCartBlock">
                                    <input class="addToCartBtn" type="submit" title="addToCart" Value="Cart++">
                                </div>
                                <div class="floatClearDiv"></div>
                            </form>
                        </div>
                        <div class="floatClearDiv"></div>
                    </div>
                    <div class="item">
                        <div class="itemImgBlock">
                            <img class="itemImg" src="img/shop.png" alt="item" width="110" height="110">
                        </div>
                        <div class="itemDescr">
                            <p class="itemName">Item 2</p>
                            <p class="itemDetails">Detailed descr of item 2</p>
                        </div>
                        <div class="itemCartTools">
                            <form class="addToCartForm" method="post" action="#">
                                <div class="quantityBlock">
                                    <button class="increaseBtn" type="button">+</button>
                                    <input class="quantity" type="number" title="quantity">
                                    <button class="decreaseBtn" type="button">-</button>
                                </div>
                                <div class="addToCartBlock">
                                    <input class="addToCartBtn" type="submit" title="addToCart" Value="Cart++">
                                </div>
                                <div class="floatClearDiv"></div>
                            </form>
                        </div>
                        <div class="floatClearDiv"></div>
                    </div>
                    <div class="item">
                        <div class="itemImgBlock">
                            <img class="itemImg" src="img/shop.png" alt="item" width="110" height="110">
                        </div>
                        <div class="itemDescr">
                            <p class="itemName">Item 3</p>
                            <p class="itemDetails">Detailed descr of item 3</p>
                        </div>
                        <div class="itemCartTools">
                            <form class="addToCartForm" method="post" action="#">
                                <div class="quantityBlock">
                                    <button class="increaseBtn" type="button">+</button>
                                    <input class="quantity" type="number" title="quantity">
                                    <button class="decreaseBtn" type="button">-</button>
                                </div>
                                <div class="addToCartBlock">
                                    <input class="addToCartBtn" type="submit" title="addToCart" Value="Cart++">
                                </div>
                                <div class="floatClearDiv"></div>
                            </form>
                        </div>
                        <div class="floatClearDiv"></div>
                    </div>
                    <div class="item">
                        <div class="itemImgBlock">
                            <img class="itemImg" src="img/shop.png" alt="item" width="110" height="110">
                        </div>
                        <div class="itemDescr">
                            <p class="itemName">Item 4</p>
                            <p class="itemDetails">Detailed descr of item 4</p>
                        </div>
                        <div class="itemCartTools">
                            <form class="addToCartForm" method="post" action="#">
                                <div class="quantityBlock">
                                    <button class="increaseBtn" type="button">+</button>
                                    <input class="quantity" type="number" title="quantity">
                                    <button class="decreaseBtn" type="button">-</button>
                                </div>
                                <div class="addToCartBlock">
                                    <input class="addToCartBtn" type="submit" title="addToCart" Value="Cart++">
                                </div>
                                <div class="floatClearDiv"></div>
                            </form>
                        </div>
                        <div class="floatClearDiv"></div>
                    </div>
                    <div class="item">
                        <div class="itemImgBlock">
                            <img class="itemImg" src="img/shop.png" alt="item" width="110" height="110">
                        </div>
                        <div class="itemDescr">
                            <p class="itemName">Item 5</p>
                            <p class="itemDetails">Detailed descr of item 5</p>
                        </div>
                        <div class="itemCartTools">
                            <form class="addToCartForm" method="post" action="#">
                                <div class="quantityBlock">
                                    <button class="increaseBtn" type="button">+</button>
                                    <input class="quantity" type="number" title="quantity">
                                    <button class="decreaseBtn" type="button">-</button>
                                </div>
                                <div class="addToCartBlock">
                                    <input class="addToCartBtn" type="submit" title="addToCart" Value="Cart++">
                                </div>
                                <div class="floatClearDiv"></div>
                            </form>
                        </div>
                        <div class="floatClearDiv"></div>
                    </div>
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