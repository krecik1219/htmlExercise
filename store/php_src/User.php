<?php

namespace user;


class User
{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $mobile;
    private $birthDate;

    /**
     * User constructor.
     * @param $id
     * @param $name
     * @param $surname
     * @param $email
     * @param $mobile
     * @param $birthDate
     */
    public function __construct($id, $name, $surname, $email, $mobile, $birthDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->mobile = $mobile;
        $this->birthDate = $birthDate;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }
}