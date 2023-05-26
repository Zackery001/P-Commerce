<?php include 'element/header.php'; ?>
<?php include 'element/navbar.php'; ?>
<?php include 'element/home.php'; ?>
<?php include 'core/Stock.php'; ?>

<?php 

    if(isset($_GET['item_id'])){
        
        $stock = new Stock;
        $view = $stock->viewItem($_GET['item_id']);

        // echo "<pre>";
        // print_r($view);
        // echo "</pre>";

    }
?>


<div class="container mt-3">
    <div class="row">
        <h5 style="background-color:cyan;" >Category : <?=$view[0]['category']?></h5>
        <div class = "mt-3">
            <h5>Description : <?=$view[0]['details'] ?></h5>
        </div>
        <h3 class="mt-5" style="background-color:red;">Update History :</h3>
        <?php 
        
        $history = $stock->getHistory($view[0][0]);
        // echo "<pre>";
        // print_r($history);
        // echo "</pre>";
        
        ?>
        <?php foreach($history as $stock): ?>

            <?php
            
            $profit = $stock['sell'] - $stock['cost'];
            $margin = ($profit/$stock['cost'])*100 ;
            $margin = round($margin);
            
            ?>
            <div class="mt-2">
                <h5 style="background-color:orange;" >Updated at : <?= $stock['updated_at'] ?></h5>
                <h7> Cost Price : <?= $stock['cost']?></h7><br>
                <h7> Selling Price : <?= $stock['sell']?></h7><br>
                <h7> Profit :<?= $profit?> (<?= $margin?>%)</h7>
            </div>
            
        <?php endforeach; ?>

    </div>
</div>

<?php include 'element/footer.php'; ?>