<?php include "element/header.php";  ?>
<?php include 'element/navbar.php'; ?>
<?php include "core/Stock.php";  ?>

<?php

$stock = new Stock;
$acc_id = $_GET['acc_id'];
$showStock = $stock->getStock();

// echo "<pre>";
// print_r($showAcc);
// echo "</pre>";



if(isset($_POST['add'])){
    if(isset($_POST['amount']) && isset($_POST['select'])){

        $detail = $stock->getItemDetails($_POST['select']);
        $info = $stock->retrieveDue($acc_id);
        $total = (int)$_POST['amount'] + (int)$detail[0]['selling_price'];
        $due = (int)$info[0]['due'] + $total;
        $sum = $due - (int)$info[0]['paid'];

        $stock->addDue($acc_id, $due, $sum);
        $stock->recordSold($detail[0]['id'], 1,$detail[0]['cost_price'] ,$detail[0]['selling_price'], 'pending', $acc_id);

    }else{

        echo"<p class='alert alert-warning'>
            Please Provide Amount</p>";
    }

}elseif(isset($_POST['pay'])){

    if(isset($_POST['amount'])){
        if(isset($_POST['select'])){

            $detail = $stock->getItemDetails($_POST['select']);
            $info = $stock->retrieveDue($acc_id);
            $total = (int)$_POST['amount'] + (int)$detail[0]['selling_price'];
            $paid = (int)$info[0]['paid'] + (int)$total;
            $sum = (int)$info[0]['due'] - $paid;

            if($sum < 0){

                echo"<p class='alert alert-danger'>
                    ALERT ALERT ALERT</p>";
            }else{

                $stock->payDue($acc_id, $paid, $sum);
                $check = $stock->retrieveDue($acc_id);
                if($check[0]['sum'] == 0){
                    $stock->updateSold($acc_id);
                }
            }

        }else{

            $info = $stock->retrieveDue($acc_id);
            $paid = (int)$info[0]['paid'] + (int)$_POST['amount'];
            $sum = (int)$info[0]['due'] - $paid;

            if($sum < 0){

                echo"<p class='alert alert-danger'>
                    ALERT ALERT ALERT</p>";
            }else{

                $stock->payDue($acc_id, $paid, $sum);
                $check = $stock->retrieveDue($acc_id);
                if($check[0]['sum'] == 0){
                    $stock->updateSold($acc_id);
                }
            }

        }

    }else{

        echo"<p class='alert alert-warning'>
            Please Provide Amount</p>";
    }

}

?>

<div class="container">
    <div class="row">
        <h3>
            <a class="btn btn-sm btn-primary mt-2" href = "accSelect.php" >Return</a>
        </h3>

        <div class="border border-primary row p-2 col-8 offset-2 card">
            <?php
            echo "<h2 class='mt-3'>Analytics:</h2>";
            $pending = $stock->analyticsUserDue($acc_id);
            echo "Total Due:<h3>".$pending[0][0]."</h3>";
            $paid = $stock->analyticsUserPaid($acc_id);
            echo "Total Paid:<h3>".$paid[0][0]."</h3>";
            $left = $stock->analyticsUserLeft($acc_id);
            echo "Left:<h3>".$left[0][0]."</h3>";
            ?>
        </div>

    </div>
</div>


<script type="text/javascript"  src="multiselect.js"></script>
<div class="container mt-3">
    
    <div class="border border-primary row p-2 col-8 offset-2 card">
        
        <form action="" method="POST">
            <select class="form-group mt-2" style="width:420px" name="select" multiple size=10 multiselect-search="true">
    
                <option value="0">
                <label>select</label>
                <?php foreach($showStock as $stock): ?>
                    <option value="<?= $stock['0']?>">
                    <label><?= $stock['0']?>.<?= $stock['category']?> || <?= $stock['details']?></label>
                <?php endforeach; ?>

                <!-- <option value="Tire:28inch">Tire:28inch</option>
                <option value="Helmet">Helmet</option>
                <option value="Frame:28inch">Frame:28inch</option>
                <option value="Gear:8">Gear:8</option>                -->
            </select>
            <input type="text" placeholder = "Additional Charges" name="amount">

            <div class = "form-control mt-2">
                <button class = "btn btn-primary btn-success" type="submit" name="pay" >Pay</button>
                <button class = "btn btn-primary btn-warning" type="submit" name="add" >Add</button>
                <button class = "btn btn-primary btn-danger" type="submit" name="cancel" >Cancel</button>
            </div>
                    
        </form>

    </div>
</div>

    
<?php include "element/footer.php";  ?>