<?php

session_start();

define("MIN_NAME_LENGTH", 2);
define("MAX_NAME_LENGTH", 15);
define("CAPTCHA_CORRECT_ANSWER", 2.5);
define("EPSILON", 0.001);

$errors = array();

if(!isset($_POST["name"]) or empty($_POST["name"]))
    $errors["name"][] = "Name can't be empty";
else
{
    if(strlen($_POST["name"]) < MIN_NAME_LENGTH or strlen($_POST["name"]) > MAX_NAME_LENGTH)
        $errors["name"][] = "Name must be between 2 and 15 characters";
}

if(!isset($_POST["email"]) or empty($_POST["email"]))
    $errors["email"][] = "Email can't be empty";
else
{
    $_POST["email"] = preg_replace("/\(at\)/", "@", $_POST["email"]);
    if(!preg_match("/\@/", $_POST["email"]))
        $errors["email"][] = "Not valid email - missing '@' character";
}

if(isset($_POST["mobileNum"]) and !empty($_POST["mobileNum"]))
{
    if(!preg_match("/^([\+]?\d{2}\s)?(\d{3}\s\d{3}\s\d{3})$/", $_POST["mobileNum"]))
        $errors["mobileNum"][] = "Not valid phone number. Please follow pattern: (+99) 999 999 999";
}
else
    $_POST["mobileNum"] = null;

if(!isset($_POST["captchaFake"]) or empty($_POST["captchaFake"]))
    $errors["captchaFake"][] = "Please fill captcha can't be empty";
else
{
    $answer = (double)$_POST["captchaFake"];
    if(abs($answer - CAPTCHA_CORRECT_ANSWER) > EPSILON)
        $errors["captchaFake"][] = "$answer is not correct answer";
}

if(!isset($_POST["birthDate"]) or empty($_POST["birthDate"]))
    $errors["birthDate"][] = "Please provide your birth date";
else
{
    $datePieces = explode("-", $_POST["birthDate"]);
    $year = $datePieces[0];
    $month = $datePieces[1];
    $day = $datePieces[2];
    $currYear = date('Y');
    $currMonth = date('m');
    $currDay = date('d');
    if($year > $currYear)
    {
        $errors["birthDate"][] = "You were not born yet...";
    }
    if(strcmp($year, $currYear) == 0)
    {
        if($month > $currMonth)
            $errors["birthDate"][] = "You were not born yet...";
        if($month == $currMonth)
        {
            if($day > $currDay)
                $errors["birthDate"][] = "You were not born yet...";
        }
    }
}

if(count($errors) > 0)
{
    $_SESSION["errors"] = $errors;
    header("Location: registration.php");
    exit();
}

require_once "../connect.php";

$connection = new mysqli($host, $db_user, $db_password, $db_name);
if($connection->connect_errno!=0)  // check if any error occured when connecting
    die("Sorry, we had an error during database connection ".$connection->connect_errno);

$connection->set_charset("utf8");
$email = $_POST["email"];
$result = $connection->query("SELECT id FROM users WHERE email='$email'");
if(!$result)
{
    $connection->close();
    die("Sorry, we had an error ".$connection->connect_errno);
}

if($result->num_rows > 0)
{
    $validation_flag = false;
    $errors["email"][] = "Email już w użyciu";
}

$result->free_result();

if(count($errors) > 0)
{
    $connection->close();
    $_SESSION["errors"] = $errors;
    header("Location: registration.php");
    exit();
}

$query = "INSERT INTO users VALUES(NULL, ?, ?, ?, ?, ?)";
$stmt = $connection->prepare($query);
$stmt->bind_param("sssss", $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["mobileNum"], $_POST["birthDate"]);
if(!$stmt->execute())
{
    $connection->close();
    die("Sorry, we had an error ".$stmt->errno);
}

$connection->close();
echo("Good job, you have been registered!");

?>
