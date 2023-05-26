<?php

include_once 'core/database.php';

class Stock extends Database{

    //Category
    
    public function getCategory()
    {
        $sql = 'SELECT * FROM categories';
        return $this->fetch($sql);
    }
    public function addCategory($category)
    {
        $sql = "INSERT INTO categories(category) VALUES ('$category')";
        $this->exec($sql);
    }

    //Items
    public function addItem($category_id, $details, $cost_price, $selling_price)
    {
        $sql = "INSERT INTO items(category_id, details, cost_price, selling_price) VALUES(
            '$category_id', '$details', '$cost_price', '$selling_price') ";
        $this->exec($sql);
    }

    public function duplicateItem($details)
    {
        $sql = "SELECT * FROM items WHERE details = '$details'";
        return $this->fetch($sql);
    }
    
}

?>