<?php

namespace user;

require_once ("Cart.php");

use cart\Cart;

class User
{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $mobile;
    private $birthDate;

    /**
     * @var Cart
     */
    private $shoppingCart;

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
        $this->shoppingCart = new Cart();
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

    /**
     * @return Cart
     */
    public function getShoppingCart()
    {
        return $this->shoppingCart;
    }
}