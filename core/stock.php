<?php

include_once 'core/database.php';

class Stock extends Database{

    public function addCategory($category){

        $sql = "INSERT INTO categories(category) VALUES ('$category')";
        $this->exec($sql);
    }
    
}

?>