<?php include 'element/header.php'; ?>
<?php include 'element/navbar.php'; ?>
<?php include 'element/home.php'; ?>
<?php include 'core/Stock.php'; ?>

<?php 

    if(isset($_GET['item_id'])){
        
        $stock = new Stock;
        $view = $stock->viewCat($_GET['item_id']);

        // echo "<pre>";
        // print_r($view);
        // echo "</pre>";

    }
?>



<div class="container mt-3">
    <div class="row">
        <h1>Name : <?= $view[0]['category'] ?></h1>
        <div class = "mt-3">
            <h5 style="background-color: powderblue;">Items : </h5>
        </div>
    
        <?php foreach($view as $stock): ?>
            <?php $viewLink = "detailsItem.php?item_id=".$stock[0];?>

            <div class="mt-2">
                <h5><a href="<?= $viewLink?>"><?= $stock['details'] ?></a></h5>
            </div>
            
        <?php endforeach; ?>

    </div>
</div>
    


<?php include 'element/footer.php'; ?>