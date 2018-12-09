<?php

    session_start();

    // guard against accessing registration page as logged user
    if(isset($_SESSION["user"]))
    {
        header("Location: webstore.php");
        exit();
    }

    require_once ("php_src/service/RegisterService.php");
    require_once ("php_src/UserDataValidator.php");
    require_once ("php_src/connection/UserConnection.php");

    use connection\UserConnection;
    use service\RegisterService;
    use validation\UserDataValidator;

    $errors = array();
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $userDataValidator = new UserDataValidator();
        try
        {
            $userConnection = new UserConnection();
            $registerService = new RegisterService($userDataValidator, $userConnection);
            $registrationResult = $registerService->register($_POST["name"], $_POST["surname"], $_POST["email"],
                $_POST["password1"], $_POST["password2"], $_POST["mobileNum"], $_POST["captchaFake"], $_POST["birthDate"]);
            if(!$registrationResult)
                $errors = $registerService->getErrors();
            else
            {
                echo ('<p align=center>Registration successful!</p>');
                unset($errors);
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
    <title>Webstore registartion</title>

    <link rel="stylesheet" href="css/registrationStyle.css" type="text/css">
    <script src="js/registration.js" type="text/javascript"></script>
</head>
<body>
<div id="container">
    <header>
        <h3>Fill up the form and register for free</h3>
    </header>
    <div id="regFormContainer">
        <form id="registerForm" name="registerForm" method="post" autocomplete="on">
            <p id="name">
                <label>Name:
                    <input id="nameInput" name="name" type="text" placeholder="Name" autofocus>
                </label>
            </p>
            <?php
                if(isset($errors["name"]))
                {
                    for($i = 0; $i < count($errors["name"]); $i++)
                        echo('<p style="color: red;">'.$errors["name"][$i].'</p>');
                    unset($errors["name"]);
                }
            ?>
            <p id="surname">
                <label>Surname:
                    <input id="surnameInput" name="surname" type="text" placeholder="Surname">
                </label>
            </p>
            <p>
                <label>Email:
                    <input name="email" type="email" placeholder="sample@mail.com">
                </label>
            </p>
            <?php
            if(isset($errors["email"]))
            {
                for($i = 0; $i < count($errors["email"]); $i++)
                    echo('<p style="color: red;">'.$errors["email"][$i].'</p>');
                unset($errors["email"]);
            }
            ?>
            <p>
                <label>Password:
                    <input name="password1" type="password" required>
                </label>
            </p>
            <?php
            if(isset($errors["password1"]))
            {
                for($i = 0; $i < count($errors["password1"]); $i++)
                    echo('<p style="color: red;">'.$errors["password1"][$i].'</p>');
                unset($errors["password1"]);
            }
            ?>
            <p>
                <label>Repeat password:
                    <input name="password2" type="password" required>
                </label>
            </p>
            <?php
            if(isset($errors["password2"]))
            {
                for($i = 0; $i < count($errors["password2"]); $i++)
                    echo('<p style="color: red;">'.$errors["password2"][$i].'</p>');
                unset($errors["password2"]);
            }
            ?>
            <p>
                <label>Mobile number:
                    <input name="mobileNum" type="tel" placeholder="+48 723 916 624">
                </label>
            </p>
            <?php
            if(isset($errors["mobileNum"]))
            {
                for($i = 0; $i < count($errors["mobileNum"]); $i++)
                    echo('<p style="color: red;">'.$errors["mobileNum"][$i].'</p>');
                unset($errors["mobileNum"]);
            }
            ?>
            <p>
                <label>Date of birth:
                    <input name="birthDate" type="date">
                </label>
            </p>
            <?php
            if(isset($errors["birthDate"]))
            {
                for($i = 0; $i < count($errors["birthDate"]); $i++)
                    echo('<p style="color: red;">'.$errors["birthDate"][$i].'</p>');
                unset($errors["birthDate"]);
            }
            ?>
            <p>
                <label>Theme color:
                    <input name="themeColor" type="color" value="#9ae7fa">
                </label>
            </p>
            <p>
                <label>Github account url:
                    <input name="githubUrl" type="url" placeholder="https://github.com/username">
                </label>
            </p>
            <p>
                <label>Anything:<br>
                    <textarea name="anything" rows = "4" cols = "30">Enter anything you wish.</textarea>
                </label>
            </p>
            <p>
                <label>Known languages number:
                    0<input name="knownLangsNum" type="range" min="0" max="25" value="3">25
                </label>
            </p>
            <p>
                <label>Rate this site:
                    <select id="rating" name="rating">
                        <option selected>5</option>
                        <option>4</option>
                        <option>3</option>
                        <option>2</option>
                        <option>1</option>
                    </select>
                </label>
            </p>
            <p>
                <strong>How did you get to our site?:</strong><br>
                <label>Search engine
                    <input name="howToSite" type="radio"
                           value="search engine" checked></label>
                <label>Links from another site
                    <input name="howToSite" type="radio"
                           value="link"></label>
                <label>Friends
                    <input name="howToSite" type="radio"
                           value="friends"></label>
                <label>Facebook
                    <input name="howToSite" type="radio"
                           value="facebook"></label>
                <label>Other
                    <input name="howToSite" type="radio"
                           value="other"></label>
            </p>
            <p>
                <strong>Read agreement and accept it.</strong>
                <label>
                    <input name="agreement" type="checkbox" required>
                    <span id="agreementText">I accept agreement</span>
                </label>
            </p>
            <br>
            <details>
                <summary>Click to read agreement</summary>
                There is no agreement at all.
            </details>
            <br>
            <label>This is CAPTCHA fake. What's square root of 6.25?
                <input id="captchaFake" name="captchaFake" type="text" required>
            </label>
            <br>
            <?php
            if(isset($errors["captchaFake"]))
            {
                for($i = 0; $i < count($errors["captchaFake"]); $i++)
                    echo('<p style="color: red;">'.$errors["captchaFake"][$i].'</p>');
                unset($errors["captchaFake"]);
            }
            ?>
            <input id="registerSubmit" name="submit" type="submit">
            <input name="reset" type="reset">
        </form>
    </div>
    <div id="preferences">
        <label>Font style
            <select id="fontSelect">
                <option selected>sans-serif</option>
                <option>Arial</option>
                <option>Calibri</option>
            </select>
        </label>
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