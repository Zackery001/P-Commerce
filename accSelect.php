<?php include "element/header.php";  ?>
<?php include 'element/navbar.php'; ?>
<?php include "core/Stock.php";  ?>

<?php

$stock = new Stock;
$showAcc = $stock->getAccounts();

// echo "<pre>";
// print_r($showAcc);
// echo "</pre>";

if(isset($_POST['search'])){
    $searchedAcc = $stock->searchAcc($_POST['search']); 
}

?>

<div class="container">
    <div class="row">
        <?php include 'element/home.php'; ?>

        <form action="" method="POST">
            <input name = "search" class = "border border-primary mt-2 form-control" rows="1" placeholder="Search.."></input>
        </form>
        <h3>
            <a class="btn btn-sm btn-primary mt-2" href = "accSelect.php" >Refresh</a>
        </h3>
    </div>
</div>

<?php if(!isset($_POST['search'])): ?>    

    <?php foreach($showAcc as $stock): ?>
        <?php $dueLink = "due.php?acc_id=".$stock['id'];?>
        
        <div class="container mt-3">   
            <div class="row">

                <a href="<?= $dueLink?>">
                <div class="mt-2 col-10 offset-1 card card-header bg-transparent border-secondary">
                    <div>
                        <h5><?= $stock['name']?></h5>
                    </div>
                </div>                      
            </div>
        </div>
    <?php endforeach; ?>

<?php else:?>   

    <?php foreach($searchedAcc as $stock): ?>
        <?php $dueLink = "due.php?acc_id=".$stock['id'];?>

        <div class="container mt-3">   
            <div class="row">
                <a href="<?= $dueLink?>">
                <div class="mt-2 col-10 offset-1 card card-header bg-transparent border-secondary">
                    <div>
                        <h5><?= $stock['name']?></h5>
                    </div>
                </div>  
            </div>
        </div>

    <?php endforeach; ?>

<?php endif;?>

<?php include "element/footer.php";  ?>