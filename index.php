<?php include 'element/header.php'; ?>
<?php if(!isset($_POST['submit'])): ?>
    <?php include 'element/navbar.php'; ?>
<?php endif; ?>
<?php include 'core/Stock.php'; ?>

<div class="container">
    <div class="row">

        <h2>Hello, from P-Commerce!</h2>

        <?php

        $stock = new Stock; 
        $showStock = $stock->getStock();
        ?>

         <h3>
            <a class="btn btn-sm btn-primary mt-2" href = "index.php" >Refresh</a>
        </h3>
        <h3>
            <a class="btn btn-sm btn-primary mt-2" href = "account.php" >Accounts</a>
        </h3>

        <div class = "container">
            <div class="row">
                <div class="border border-primary row p-2 col-8 offset-2 card">

                    <?php
                        echo "<h2 class='mt-3'>Analytics:</h2>";

                        $incoming = $stock->analyticsIncomingCost();
                        $incoming = $incoming[0][0] + 0;
                        $item = $stock->analyticsIncomingProfit();
                        $item = $item[0][0] + 0;
                        $estimatedProfit = $item - $incoming;
                        $soldProfit = $stock->analyticsSoldProfit();
                        $soldCost = $stock->analyticsSoldCost();
                        $madeProfit = $soldProfit[0][0] - $soldCost[0][0];
                        $due = $stock->analyticsDue();
                        $due = $due[0][0] + 0;

                        echo "Total Cost Price:<h3>".$incoming."</h3>";
                        echo "Total Selling Price :<h3>".$item."</h3>";
                        echo "Estimated Profit on Products :<h3>".$estimatedProfit."</h3>";
                        echo "Profit Made :<h3>".$madeProfit."</h3>";
                        echo "Pending :<h3>".$due."</h3>";

                    ?>
                    
                </div>
            </div>
        </div>

        <?php

        if(isset($_POST['continue'])){

            if(!empty($_POST['select']) &&  $_POST['select']!=0){
                $detail = $stock->getItemDetails($_POST['select']);
                
                // echo "<pre>";
                // print_r($detail);
                // echo "</pre>";

                if(!empty($_POST['amount'])){

                    $selling_price = $detail[0]['selling_price'] * $_POST['amount'] ;
                    $cost_price = $detail[0]['cost_price'] * $_POST['amount'];
                    $stock->recordSold($detail[0]['id'], $_POST['amount'], $cost_price, $selling_price, 'paid', '0');
                    echo "<p class='alert alert-success'>
                        Successfully Recorded.</p>";
                }else{

                    echo "<p class='alert alert-danger'>
                        Amount not mentioned.</p>";
                }
                
            }else{
                echo "<p class='alert alert-warning'>
                    Something went wrong :( </p>";
            }
        }

        ?>

    </div>

        <script type="text/javascript"  src="multiselect.js"></script>
        <div class="container mt-3">
            
            <div class="border border-primary row p-2 col-8 offset-2 card">

                <h2>Sell Products:</h2>
                
                <form action="" method="POST">
                    <select style="width:420px" name="select" multiple size=10 multiselect-search="true">

                        <option value="0">
                        <label>select</label><br>    
                        <?php foreach($showStock as $stock): ?>
                            <option value="<?= $stock['0']?>">
                            <label><?= $stock['0']?>.<?= $stock['category']?> || <?= $stock['details']?></label>
                        <?php endforeach; ?>

                        <!-- <option value="Tire:28inch">Tire:28inch</option>
                        <option value="Helmet">Helmet</option>
                        <option value="Frame:28inch">Frame:28inch</option>
                        <option value="Gear:8">Gear:8</option>                -->
                    </select>
                    
                    <input type="number" name = "amount" class = "border border-primary mt-2 form-control" rows="1" placeholder="Amount"></input>
                    <div class = "row col-8 offset-2">
                        <input class = "form-control btn btn-sm btn-success mt-2" name = "continue" type = "submit" value = "Confirm" >
                        <input class = "form-control btn btn-sm btn-danger mt-1" name = "cancel" type = "submit" value = "Cancel" >
                    </div>
                            
                </form>

            </div>
        </div>
</div>

<?php include 'element/footer.php'; ?>