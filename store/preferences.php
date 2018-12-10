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

    $bgColor = "#daa0b8";
    if(isset($_COOKIE["websiteBGColor"]))
        $bgColor = $_COOKIE["websiteBGColor"];
    $fontFamily = "Arial";
    if(isset($_COOKIE["userFontFamily"]))
        $fontFamily = $_COOKIE["userFontFamily"];
    $fontColor = "#000000";
    if(isset($_COOKIE["userFontColor"]))
        $fontColor = $_COOKIE["userFontColor"];
    $changedStyling = false;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        setcookie("websiteBGColor", $_POST["websiteBGColor"], time() + 3600 * 24 * 5, "/");
        setcookie("userFontFamily", $_POST["userFontFamily"], time() + 3600 * 24 * 5, "/");
        setcookie("userFontColor", $_POST["userFontColor"], time() + 3600 * 24 * 5, "/");
        $bgColor = $_POST["websiteBGColor"];
        $fontFamily = $_POST["userFontFamily"];
        $fontColor = $_POST["userFontColor"];
        $changedStyling = true;
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
    <link rel="stylesheet" type="text/css" href="css/checkout.css">
    <script src="js/webstore.js" type="text/javascript"></script>
</head>
<?php
    echo('<body style="color: '.$fontColor.'; background-color: '.$bgColor.'; font-family: '.$fontFamily.'">');
?>
<div class="container">
    <div class="userPanel">
        <?php
        echo('<span class="userName">'.$_SESSION["user"]->getName().' '.$_SESSION["user"]->getSurname().'</span>');
            echo('<a href="checkout.php"><img id="cartImg" src="img/cart.png" alt="Shopping cart"></a>[<span id="cartQuantity">'.
                $_SESSION["user"]->getShoppingCart()->getTotalQuantity().'</span>]');
            echo('<button class="logoutBtn" onclick="window.location.href=\'scripts/logout.php\'">logout</button>');
        ?>

    </div>
    <header class="titleBar">
        Preferences
    </header>
    <div class="contentContainer">
        <form id="preferencesForm" method="POST">
            <p>
                <label>Background color
                    <?php
                        if(isset($_COOKIE["websiteBGColor"]) and !$changedStyling)
                            $bgColor = $_COOKIE["websiteBGColor"];
                        echo('<input name="websiteBGColor" type="color" value="'.$bgColor.'">');
                    ?>
                </label>
            </p>
            <p>
                <label>Website font
                    <?php
                    if(isset($_COOKIE["userFontFamily"]) and !$changedStyling)
                        $fontFamily = $_COOKIE["userFontFamily"];
                    $selections = array();
                    $selections["Arial"] = "";
                    $selections["Calibri"] = "";
                    $selections["Sans-serif"] = "";
                    $selections[$fontFamily] = " selected";
                    echo(
                            '<select name="userFontFamily">'.
                                '<option'.$selections["Arial"].'>Arial</option>'.
                                '<option'.$selections["Calibri"].'>Calibri</option>'.
                                '<option'.$selections["Sans-serif"].'>Sans-serif</option>'.
                            '</select>'
                    )
                    ?>
                </label>
            </p>
            <p>
                <label>Font color
                    <?php
                    if(isset($_COOKIE["userFontColor"]) and !$changedStyling)
                        $fontColor = $_COOKIE["userFontColor"];
                    echo('<input name="userFontColor" type="color" value="'.$fontColor.'">');
                    ?>
                </label>
            </p>
            <input name="submit" type="submit" value="Save">
        </form>
    </div>
    <footer class="footer">
        <a href="webstore.php">Webstore main page</a> | <del>&copy;</del> Przemysław Szeliński, no rights at all.
    </footer>
</div>
</body>
</html>