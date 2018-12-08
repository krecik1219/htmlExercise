<?php

namespace service;

use connection\UserConnection;

class LoginService
{
    /**
     * @var UserConnection
     */
    private $connection;

    private $errors = array();

    /**
     * LoginService constructor.
     * @param $connection
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param $email
     * @param $password
     * @return bool|\user\User
     * @throws \Exception
     */
    public function loginUser($email, $password)
    {
        $loginResult = $this->connection->loginUser($email, $password);
        if(!$loginResult)
        {
            $this->errors = $this->connection->getErrors();
            return false;
        }
        return $loginResult;
    }

}