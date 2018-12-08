<?php

namespace connection;

require_once("Connection.php");
require_once(realpath(dirname(__FILE__) . '/../User.php'));

use Exception;
use user\User;

class UserConnection extends Connection
{
    /**
     * @param $name
     * @param $surname
     * @param $email
     * @param $mobileNum
     * @param $birthDate
     * @return bool
     * @throws Exception
     */
    private $errors = array();

    public function anyErrors()
    {
        return count($this->errors) > 0;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param $name
     * @param $surname
     * @param $email
     * @param $password
     * @param $mobileNum
     * @param $birthDate
     * @return bool
     * @throws Exception
     */
    public function insertUserToDb($name, $surname, $email, $password, $mobileNum, $birthDate)
    {
        $this->errors = array();
        $result = $this->connection->query("SELECT id FROM users WHERE email='$email'");
        if(!$result)
            throw new Exception($this->connection->connect_errno);
        if($result->num_rows > 0)
        {
            $this->errors["email"][] = "Email is already used";
            return false;
        }
        $result->free_result();
        $query = "INSERT INTO users VALUES(NULL, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if(empty($mobileNum))
            $mobileNum = null;
        $stmt->bind_param("ssssss", $name, $surname, $email, $hashedPassword, $mobileNum, $birthDate);
        return $stmt->execute();
    }

    /**
     * @param $email
     * @param $password
     * @return bool|User
     * @throws Exception
     */
    public function loginUser($email, $password)
    {
        $this->errors = array();
        if($email === null or strlen($email) == 0)
            $this->errors["email"][] = "Email can't be empty";
        if($password === null or strlen($password) == 0)
            $this->errors["password"][] = "Password can't be empty";

        if(count($this->errors) > 0)
            return false;

        $email = htmlentities($email, ENT_QUOTES, "UTF-8");

        $sqlQuery = "SELECT id, name, surname, email, password, mobile, birth_date FROM users WHERE email=?";
        $stmt = $this->connection->prepare($sqlQuery);
        if(!$stmt)
            throw new Exception("Query error".$stmt->errno);
        if(!$stmt->bind_param("s", $email))
            throw new Exception("Query error".$stmt->errno);
        if(!$stmt->execute())
            throw new Exception("Error executing query ".$stmt->errno);
        $queryResult = $stmt->get_result();
        $stmt->close();
        $usersNumber = $queryResult->num_rows;
        if($usersNumber <= 0)
        {
            $this->errors["logging"][] = "Wrong email or password";
            return false;
        }
        $row = $queryResult->fetch_assoc();
        if(password_verify($password, $row['password']))
        {
            $u_id = $row["id"];
            $u_name = $row["name"];
            $u_surname = $row["surname"];
            $u_email = $row["email"];
            $u_mobile = $row["mobile"];
            $u_birthDate = $row["birth_date"];
            $queryResult->free_result();
            return new User($u_id, $u_name, $u_surname, $u_email, $u_mobile, $u_birthDate);
        }
        else
        {
            $queryResult->free_result();
            $this->errors["logging"][] = "Wrong email or password";
            return false;
        }
    }
}