<?php include "element/header.php";  ?>
<?php include 'element/navbar.php'; ?>
<?php include 'core/Stock.php'; ?>

<?php

$stock = new Stock;
$allStock = $stock->getCategory();

if(isset($_POST['search'])){
    $searchedStock = $stock->searchCat($_POST['search']); 
}

?>
<div class="container">
	<div class="row">
        <?php include 'element/home.php'; ?>

        <h2>This the view categories page where existing categories can be checked</h2>
        <form action="" method="POST">
            <input name = "search" class = "border border-primary mt-2 form-control" rows="1" placeholder="Search.."></input>
        </form>
        <h3>
            <a class="btn btn-sm btn-primary mt-2" href = "viewCat.php" >Refresh</a>
        </h3>
    </div>
</div>
<?php if(!isset($_POST['search'])): ?>

    <?php foreach($allStock as $stock):?>
        <?php $viewLink = "detailsCat.php?item_id=".$stock[0];?>
        <?php $updateLink = "updateCat.php?item_id=".$stock[0];?>
        <?php 
        
        // echo "<pre>";
        // print_r($stock);
        // echo "/pre";
        
        ?>
    
        <a href = "<?= $viewLink?>">
            <div class = "container">
                <div class="row">
                    <div class="mt-2 col-10 offset-1 card card-header bg-transparent border-secondary">

                        <div>
                            <h3><?= $stock['category']?></h3>
                        </div>
                        <div class = "col-12" style = "text-align: right">
                            <a href = "<?= $updateLink?>" style = "color: red">Edit</a>
                        </div>

                    </div>

                </div>
            </div>
        </a>

    <?php endforeach; ?>

<?php else: ?>

    <?php foreach($searchedStock as $stock):?>
        <?php $viewLink = "detailsCat.php?item_id=".$stock[0];?>
        <?php $updateLink = "updateCat.php?item_id=".$stock[0];?>
    
        <div class = "container">
            <div class="row">
                <div class="mt-2 col-10 offset-1 card card-header bg-transparent border-secondary">

                    <div>
                        <h5><a href="<?= $viewLink?>"><?= $stock['category']?></a></h5>
                    </div>
                    <div class = "col-12" style = "text-align: right">
                        <a href = "<?= $updateLink?>" style = "color: red">Edit</a>
                    </div>

                </div>

            </div>
        </div>

    <?php endforeach; ?>

<?php endif; ?>

<?php include "element/footer.php"; ?>