<?php 

include_once 'core/database.php';

class Stock extends Database{

    public function analyticsIncomingCost(){

        $sql = "SELECT SUM(cost_price) FROM incoming";
        return $this->fetch($sql);
    }

    public function analyticsIncomingProfit(){

        $sql = "SELECT SUM(selling_price) FROM incoming";
        return $this->fetch($sql);
    }

    public function analyticsSoldCost(){

        $sql = "SELECT SUM(costed) FROM sold WHERE status = 'paid'";
        return $this->fetch($sql);
    }

    public function analyticsSoldProfit(){

        $sql = "SELECT SUM(sold_at) FROM sold WHERE status = 'paid'";
        return $this->fetch($sql);
    }

    public function analyticsDue(){

        $sql = "SELECT SUM(sum) FROM due";
        return $this->fetch($sql);
    }

    public function analyticsUserDue($id){

        $sql = "SELECT due FROM due WHERE acc_id = '$id'";
        return $this->fetch($sql);
    }

    public function analyticsUserPaid($id){

        $sql = "SELECT paid FROM due WHERE acc_id = '$id'";
        return $this->fetch($sql);
    }

    public function analyticsUserLeft($id){

        $sql = "SELECT sum FROM due WHERE acc_id = '$id'";
        return $this->fetch($sql);
    }

    public function addAccount($name, $number){

        $sql = "INSERT INTO accounts(name, number) VALUES('$name', '$number')";
        $this->exec($sql);
    }

    public function lastAccount(){

        $sql = "SELECT * FROM accounts ORDER BY id DESC LIMIT 1;";
        return $this->fetch($sql);
    }

    public function verifyNum($number){
        
        if(strlen($number) == 11){
            return true;
        }else{
            return false;
        }
    }

    public function getStock(){
        
        $sql = "SELECT * FROM items JOIN categories ON categories.id = items.category_id";
        return $this->fetch($sql);
    }

    public function getAccounts(){

        $sql = "SELECT * FROM accounts";
        return $this->fetch($sql);
    }

    public function getAccountsId($name){

        $sql = "SELECT * FROM accounts WHERE name='$name'";
        return $this->fetch($sql);
    }

    public function addCategory($category){

        $sql = "INSERT INTO categories(category) VALUES ('$category')";
        $this->exec($sql);
    }

    public function duplicateCategory($category){

        $sql = "SELECT * FROM categories WHERE category = '$category'";
        return $this->fetch($sql);
    }

    public function getCategory(){

        $sql = 'SELECT * FROM categories';
        return $this->fetch($sql);
    }

    public function addItem($category_id, $details, $cost_price, $selling_price){

        $sql = "INSERT INTO items(category_id, details, cost_price, selling_price) VALUES(
            '$category_id', '$details', '$cost_price', '$selling_price') ";
        $this->exec($sql);
    }

    public function duplicateItem($details){

        $sql = "SELECT * FROM items WHERE details = '$details'";
        return $this->fetch($sql);
    }

    public function getItemDetails($item_id){

        $sql = "SELECT * FROM items WHERE id='$item_id'";

        $result = $this->fetch($sql);
        return $result;
    }

    public function getCatDetails($item_id){

        $sql = "SELECT * FROM categories WHERE id='$item_id'";

        $result = $this->fetch($sql);
        return $result;
    }
    
    public function recordSold($item_id, $amount, $costed, $sold_at, $status, $acc_id){

        $at_time = date('Y-m-d H:i:s');
        $sql = "INSERT INTO sold(item_id, amount, costed, sold_at, at_time, status, acc_id) VALUES(
            '$item_id', '$amount', '$costed', '$sold_at', '$at_time', '$status', '$acc_id')";
        $this->exec($sql);
    }

    public function updateSold($acc_id){

        $sql = "UPDATE sold SET status = 'paid' WHERE acc_id = '$acc_id'";
        $this->exec($sql);
    }

    public function recordIncoming($item_id, $amount, $cost_price, $selling_price){

        $at_time = date('Y-m-d H:i:s');
        $sql = "INSERT INTO incoming(item_id, amount, cost_price, selling_price, at_time ) VALUES(
            '$item_id', '$amount', '$cost_price', '$selling_price', '$at_time')";
        $this->exec($sql);
    }

    public function searchItem($reference){

        $sql = "SELECT * FROM items JOIN categories ON categories.id = items.category_id WHERE details LIKE '%$reference%'";
        return $this->fetch($sql);
    }

    public function searchCat($reference){

        $sql = "SELECT * FROM categories WHERE category LIKE '%$reference%'";
        return $this->fetch($sql);
    }

    public function searchAcc($reference){

        $sql = "SELECT * FROM accounts WHERE name LIKE '%$reference%'";
        return $this->fetch($sql);
    }

    public function viewItem($id){

        $sql = "SELECT * FROM items JOIN categories ON categories.id = items.category_id WHERE items.id = '$id'";
        return $this->fetch($sql);
    }

    public function viewCat($id){

        $sql = "SELECT * FROM items JOIN categories ON categories.id = items.category_id WHERE items.category_id = '$id'";
        return $this->fetch($sql);
    }

    public function updateItem($id, $details, $cost_price, $selling_price){

        $at_time = date('Y-m-d H:i:s');
        $sql = "UPDATE items SET details = '$details', cost_price = '$cost_price', selling_price = '$selling_price' 
            WHERE id = '$id'; 
            INSERT INTO updated(item_id, cost, sell, updated_at) 
            VALUES('$id', '$cost_price', '$selling_price', '$at_time'); ";
        $this->exec($sql);
    }

    public function updateCat($id, $category){

        $sql = "UPDATE categories SET category = '$category' WHERE id = '$id'"; 
        $this->exec($sql);
    }


    public function getHistory($item_id){

        $sql = "SELECT updated.*,items.id FROM updated JOIN items ON items.id = updated.item_id WHERE item_id = '$item_id'";
        return $this->fetch($sql);
    }

    public function insertDue($acc_id){

        $sql = "INSERT INTO due(acc_id, paid, due, sum) VALUES ('$acc_id', 0, 0, 0)";
        // $sql = "UPDATE due SET acc_id='$acc_id', paid='$paid', due='$due', sum='$sum'";
        $this->exec($sql);
    }

    
    public function addDue($acc_id, $due, $sum){

        // $sql = "INSERT INTO due(acc_id, paid, due, sum) VALUES ('$acc_id', '$paid', '$due', '$sum')";
        $sql = "UPDATE due SET acc_id='$acc_id', due='$due', sum='$sum'";
        $this->exec($sql);
    }

    public function payDue($acc_id, $paid, $sum){

        // $sql = "INSERT INTO due(acc_id, paid, due, sum) VALUES ('$acc_id', '$paid', '$due', '$sum')";
        $sql = "UPDATE due SET acc_id='$acc_id', paid='$paid', sum='$sum'";
        $this->exec($sql);
    }

    public function retrieveDue($acc_id){

        $sql = "SELECT * FROM due WHERE acc_id = '$acc_id'";
        return $this->fetch($sql);
    }

    public function removeDue($acc_id){

        $sql = "UPDATE due SET paid='0', due='0' sum='0' WHERE acc_id = '$acc_id'";
        $this->exec($sql);
    }

}
?>