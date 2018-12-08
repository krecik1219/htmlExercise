<?php

    session_start();

    // guard against accessing logging page as logged user
    if(isset($_SESSION["user"]))
    {
        header("Location: webstore.php");
        exit();
    }

    require_once ("php_src/service/LoginService.php");
    require_once ("php_src/connection/UserConnection.php");

    use connection\UserConnection;
    use service\LoginService;

    $errors = array();
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        try
        {
            $userConnection = new UserConnection();
            $loginService = new LoginService($userConnection);
            $loginResult = $loginService->loginUser($_POST["email"], $_POST["password"]);
            if(!$loginResult)
                $errors = $loginService->getErrors();
            else
            {
                $_SESSION["user"] = $loginResult;
                unset($errors);
                header("Location: webstore.php");
                exit();
            }
        } catch (Exception $e)
        {
            die("Sorry, we had an error: ".$e->getMessage());
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="programming, languages, store, webstore, e-commerce,
        programming languages, c++, python, c, java, computer science, computing, shop,
        online, buy, payment, developers, IT, books, courses, video, audio, registration">
    <meta name="description" content="Polyglot webstore registration site">
    <title>Webstore login page</title>

    <link rel="stylesheet" href="css/logiStyle.css" type="text/css">
</head>
<body>
<div id="container">
    <header>
        <h3>Login to webstore</h3>
    </header>
    <div id="loginFormContainer">
        <form id="loginForm" name="loginForm" method="post" autocomplete="on">
            <p id="email">
                <label>Email:<br>
                    <input id="emailInput" name="email" type="email" placeholder="sample@mail.com" autofocus>
                </label>
            </p>
            <p id="Password">
                <label>Password:<br>
                    <input id="passwordInput" name="password" type="password">
                </label>
            </p>
            <?php
            if(isset($errors["logging"]))
            {
                for($i = 0; $i < count($errors["logging"]); $i++)
                    echo('<p style="color: red;">'.$errors["logging"][$i].'</p>');
                unset($errors["logging"]);
            }
            ?>
            <input id="loginSubmit" name="login" type="submit" value="login">
        </form>
    </div>
    <p>
        <a href="../index.html">Back to home page</a>
    </p>
    <footer id="contactInfo">
        <address>
            Contact mail address:
            <a href="mailto:sample@mail.com">sample@mail.com</a>
        </address>
        <h4><del>&copy;</del> Przemysław Szeliński, no rights at all.</h4>
    </footer>
</div>
</body>
</html>
