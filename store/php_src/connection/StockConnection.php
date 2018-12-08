<?php

namespace connection;

use Exception;
use webstore\Item;

class StockConnection extends Connection
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
    public function insertUserToDb($name, $surname, $email, $mobileNum, $birthDate)
    {
        $result = $this->connection->query("SELECT id FROM users WHERE email='$email'");
        if(!$result)
            throw new Exception($this->connection->connect_errno);
        if($result->num_rows > 0)
        {
            $errors["email"][] = "Email już w użyciu";
            return false;
        }
        $result->free_result();
        $query = "INSERT INTO users VALUES(NULL, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssss", $name, $surname, $email, $mobileNum, $birthDate);
        return $stmt->execute();
    }

    /**
     * @param $subcategory
     * @return array
     * @throws Exception
     */
    public function fetchItemsBySubcategory($subcategory)
    {
        $query = "select id_item, item_name, subcategory_name, category_name, photo_url, description".
                 "from stock inner join subcategories on stock.id_subcategory = subcategories.id_subcategory".
                 "inner join categories on subcategories.id_category = categories.id_category".
                 "where id_subcategory = '$subcategory' order by item_name";

        $result = $this->connection->query($query);
        if(!$result)
            throw new Exception($this->connection->connect_errno);
        $items = array();
        while($item = $result->fetch_assoc())
        {
            $items[] = new Item($item["id"], $item["name"], $item["subcategory_name"],
                $item["category_name"], $item["photo_url"], $item["description"]);
        }
        return $items;
    }
}