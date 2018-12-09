<?php

namespace cart;

require_once ("CartItem.php");

class Cart
{
    /**
     * @var CartItem[]
     */
    private $cartItems = array();

    public function addToCart(CartItem $cartItem)
    {
        if(!isset($this->cartItems[$cartItem->getItemId()]))
        {
            $this->cartItems[$cartItem->getItemId()] = $cartItem;
        }
        else
        {
            $this->cartItems[$cartItem->getItemId()]->increaseQuantityBy($cartItem->getQuantity());
        }
    }

    public function removeFromCart($itemId, $quantityToRemove)
    {
        $currentQuantity = $this->cartItems[$itemId]->getQuantity();
        if($currentQuantity - $quantityToRemove > 0)
        {
            $this->cartItems[$itemId]->decreaseQuantityBy($quantityToRemove);
        }
        else
        {
            unset($this->cartItems[$itemId]);
        }
    }

    /**
     * @return CartItem[]
     */
    public function getCartItems()
    {
        return $this->cartItems;
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;
        foreach($this->cartItems as $cartItem)
        {
            $totalPrice += $cartItem->getTotalPrice();
        }
        return $totalPrice;
    }

    public function getTotalQuantity()
    {
        $totalQuantity = 0;
        foreach($this->cartItems as $cartItem)
        {
            $totalQuantity += $cartItem->getQuantity();
        }
        return $totalQuantity;
    }

    public function resetCart()
    {
        $this->cartItems = array();
    }
}