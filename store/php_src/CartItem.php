<?php

namespace cart;


use webstore\Item;

class CartItem
{
    /**
     * @var Item
     */
    private $item;
    /**
     * @var int
     */
    private $quantity = 0;

    /**
     * CartItem constructor.
     * @param Item $item
     * @param int $quantity
     */
    public function __construct(Item $item, $quantity)
    {
        $this->item = $item;
        $this->quantity = $quantity;
    }

    /**
     * @return float|int
     */
    public function getTotalPrice()
    {
        return $this->item->getPrice() * $this->quantity;
    }

    /**
     * @return int
     */
    public function getItemId()
    {
        return $this->item->getId();
    }

    /**
     * @return Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function increaseQuantityBy($extraQuantity)
    {
        $this->quantity += $extraQuantity;
    }
    public function decreaseQuantityBy($minusQuantity)
    {
        $this->quantity -= $minusQuantity;
    }

}