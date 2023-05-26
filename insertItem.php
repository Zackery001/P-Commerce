<?php include "element/header.php";  ?>
<?php include 'element/navbar.php'; ?>
<?php include "core/Stock.php";  ?>

<div class="container">

    <?php 


$stock = new Stock; 
$showCat = $stock->getCategory();

if(isset($_POST['insert'])){
	if(!empty($_POST['select']) && $_POST['select']!=0){

		$stockCount = $stock->duplicateItem($_POST['details']);

		if (count($stockCount) > 0){
			echo "<p class='alert alert-warning'>This item already exists</p>";
		}else{
			$stock->addItem($_POST['select'], $_POST['details'], $_POST['cost_price'], $_POST['selling_price']);
			echo "<p class='alert alert-success'>
				Your item has been successfully inserted!</p>";
		}

	}else{
		echo "<p class='alert alert-warning'>Select a category</p>";
	}

}
// echo "<pre>";
// print_r($showCat);
// echo "</pre>";

?>
    <div class="row">
        <?php include "element/home.php";  ?>

        <h1>This the insert items page where new items are inserted</h1>

        <div class="container mt-3">

            <div class="border border-primary row p-2 col-8 offset-2 card">

                <form action="" method="POST">

                    <select style="width:250px" name="select">

                        <option value="0">
                            <label>select</label><br>
                            <?php foreach($showCat as $stock): ?>

                        <option value="<?= $stock['id']?>">
                            <label><?= $stock['category']?></label><br>

                            <?php endforeach;?>

                    </select>

                    <textarea name="details" class="border border-primary mt-2 form-control" rows="1"
                        required></textarea>
                    <div class="row mt-3 ps-3">
                        <input class="btn btn-bg col-md-4" name="cost_price" placeholder="Cost Price" required>
                    </div>
                    <div class="row mt-3 ps-3">
                        <input class="btn btn-bg col-md-4" name="selling_price" placeholder="Selling Price" required>
                    </div>
                    <input type="submit" name="insert" value="Insert" class="mt-2 mb-1 btn btn-sm btn-success">

                </form>

            </div>

        </div>
    </div>
</div>

<?php include "element/footer.php"; ?>