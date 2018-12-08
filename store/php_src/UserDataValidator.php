<?php

namespace validation;


class UserDataValidator
{
    const MIN_NAME_LENGTH = 2;
    const MAX_NAME_LENGTH = 15;
    const MIN_PASSWORD_LENGTH = 8;
    const MAX_PASSWORD_LENGTH = 30;
    const CAPTCHA_CORRECT_ANSWER = 2.5;
    const EPSILON = 0.001;

    private $errors = array();

    function getErrors()
    {
        return $this->errors;
    }

    function resetErrors()
    {
        $this->errors = array();
    }

    function validateName($name)
    {
        if($name === null or empty($name))
            $this->errors["name"][] = "Name can't be empty";
        else
        {
            if(strlen($name) < UserDataValidator::MIN_NAME_LENGTH or strlen($name) > UserDataValidator::MAX_NAME_LENGTH)
                $this->errors["name"][] = "Name must be between 2 and 15 characters";
        }
        if(isset($this->errors["name"]) and count($this->errors["name"]) > 0)
            return false;
        else
            return true;
    }

    function validateEmail($email)
    {
        if($email === null or empty($email))
            $this->errors["email"][] = "Email can't be empty";
        else
        {
            $email = preg_replace("/\(at\)/", "@", $email);
            if(!preg_match("/\@/", $email))
                $this->errors["email"][] = "Not valid email - missing '@' character";
        }
        if(isset($this->errors["email"]) and count($this->errors["email"]) > 0)
            return false;
        else
            return true;
    }

    function validatePassword($password1, $password2)
    {
        if($password1 != null and !empty($password1) and $password2 != null and !empty($password2))
        {
            if(strlen($password1) < UserDataValidator::MIN_PASSWORD_LENGTH or strlen($password1) > UserDataValidator::MAX_PASSWORD_LENGTH)
                $this->errors["password1"][] = "Password must be between ".UserDataValidator::MIN_PASSWORD_LENGTH." and ".
                    UserDataValidator::MAX_PASSWORD_LENGTH."characters";
            if($password1 != $password2)
                $this->errors["password2"][] = "Password repetition mismatch";
        }
        else if($password1 === null or empty($password1))
            $this->errors["password1"][] = "Password can't be empty";
        else if($password2 === null or empty($password2))
            $this->errors["password2"][] = "Password can't be empty";
        if(isset($this->errors["password1"]) and isset($this->errors["password2"]) and
            count($this->errors["password1"]) + count($this->errors["password2"]) > 0)
            return false;
        else
            return true;
    }

    function validateMobileNum($mobileNum)
    {
        if($mobileNum != null and !empty($mobileNum))
        {
            if(!preg_match("/^([\+]?\d{2}\s)?(\d{3}\s\d{3}\s\d{3})$/", $mobileNum))
                $this->errors["mobileNum"][] = "Not valid phone number. Please follow pattern: (+99) 999 999 999";
        }
        if(isset($this->errors["mobileNum"]) and count($this->errors["mobileNum"]) > 0)
            return false;
        else
            return true;
    }

    function validateCaptchaFake($captchaFake)
    {
        if($captchaFake === null or empty($captchaFake))
            $this->errors["captchaFake"][] = "Please fill captcha can't be empty";
        else
        {
            $answer = (double)$captchaFake;
            if(abs($answer - UserDataValidator::CAPTCHA_CORRECT_ANSWER) > UserDataValidator::EPSILON)
                $this->errors["captchaFake"][] = "$answer is not correct answer";
        }
        if(isset($this->errors["captchaFake"]) and count($this->errors["captchaFake"]) > 0)
            return false;
        else
            return true;
    }

    function validateBirthDate($birthDate)
    {
        if($birthDate === null or empty($birthDate))
            $this->errors["birthDate"][] = "Please provide your birth date";
        else
        {
            $datePieces = explode("-", $birthDate);
            $year = $datePieces[0];
            $month = $datePieces[1];
            $day = $datePieces[2];
            $currYear = date('Y');
            $currMonth = date('m');
            $currDay = date('d');
            if($year > $currYear)
            {
                $this->errors["birthDate"][] = "You were not born yet...";
            }
            if(strcmp($year, $currYear) == 0)
            {
                if($month > $currMonth)
                    $this->errors["birthDate"][] = "You were not born yet...";
                if($month == $currMonth)
                {
                    if($day > $currDay)
                        $this->errors["birthDate"][] = "You were not born yet...";
                }
            }
        }
        if(isset($this->errors["birthDate"]) and count($this->errors["birthDate"]) > 0)
            return false;
        else
            return true;
    }

    function validateAll($name, $email, $password1, $password2, $mobileNum, $captchaFake, $birthDate)
    {
        $result = $this->validateName($name);
        $result = $result && $this->validateEmail($email);
        $result = $result && $this->validatePassword($password1, $password2);
        $result = $result && $this->validateMobileNum($mobileNum);
        $result = $result && $this->validateCaptchaFake($captchaFake);
        $result = $result && $this->validateBirthDate($birthDate);
        return $result;
    }
}