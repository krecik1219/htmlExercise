<?php

namespace service;

use Exception;

class RegisterService
{
    /**
     * @var \validation\UserDataValidator
     */
    private $userDataValidator;

    /**
     * @var \connection\UserConnection
     */
    private $userConnection;

    private $errors = array();

    /**
     * RegisterService constructor.
     * @param \validation\UserDataValidator $userDataValidator
     * @param \connection\UserConnection $userConnection
     */

    public function __construct(\validation\UserDataValidator $userDataValidator, \connection\UserConnection $userConnection)
    {
        $this->userDataValidator = $userDataValidator;
        $this->userConnection = $userConnection;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param $name
     * @param $surname
     * @param $email
     * @param $password1
     * @param $password2
     * @param $mobileNum
     * @param $captchaFake
     * @param $birthDate
     * @return bool
     * @throws Exception
     */
    function register($name, $surname, $email, $password1, $password2, $mobileNum, $captchaFake, $birthDate)
    {
        $this->errors = array();
        if(!$this->userDataValidator->validateAll($name, $email, $password1, $password2, $mobileNum, $captchaFake, $birthDate))
        {
            $this->errors = $this->userDataValidator->getErrors();
            return false;
        }

        $registerSuccessful = $this->userConnection->insertUserToDb($name, $surname, $email, $password1, $mobileNum, $birthDate);
        if(!$registerSuccessful)
        {
            $this->errors = $this->userConnection->getErrors();
            return false;
        }
        else
            return true;
    }
}