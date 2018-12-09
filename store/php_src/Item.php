<?php

namespace webstore;


class Item
{
    private $id;
    private $name;
    private $subcategory;
    private $category;
    private $price;
    private $photo_url;
    private $description;

    public function __construct($id, $name, $subcategory, $category, $price, $photo_url, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->$subcategory = $subcategory;
        $this->$category = $category;
        $this->$price = $price;
        $this->photo_url = $photo_url;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSubcategory()
    {
        return $this->subcategory;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getPhotoUrl()
    {
        return $this->photo_url;
    }

    public function getDescription()
    {
        return $this->description;
    }
}

?>