<?php include "element/header.php";  ?>
<?php include 'element/navbar.php'; ?>
<?php include "core/Stock.php";  ?>

<div class="container">

<?php 


$stock = new Stock;
$view = $stock->viewItem($_GET['item_id']);

if(isset($_POST['update'])){
	
    $stock->updateItem($view[0][0], $_POST['details'], $_POST['cost_price'], $_POST['selling_price']);
    header("location: viewItem.php");
}
echo "<pre>";
print_r($view);
echo "</pre>";

?>
	<div class="row">
		<?php include "element/home.php";  ?>

		<h1>This the update items page where existing items are updated</h1>

    	<div class="container mt-3">
			<div class="border border-primary row p-2 col-8 offset-2 card">
				
				<form action="" method="POST">	

					<div>
                        <label for="">Item Name</label>
                        <input name = "details" value = "<?= $view[0]['details'] ?>" class = "border border-primary mt-2 form-control" rows="1" >
					</div>

                    <div class="row mt-3 ps-3">
                        <input class="border btn btn-bg col-md-4" name = "cost_price" value = "<?= $view[0]['cost_price'] ?>" placeholder = "Cost Price" >
                    </div>
					<div class="row mt-3 ps-3">
                        <input class="border btn btn-bg col-md-4" name = "selling_price" value = "<?= $view[0]['selling_price'] ?>" placeholder = "Selling Price" >
                    </div>
                	<input type = "submit" name = "update" value = "Update" class = "mt-2 mb-1 btn btn-sm btn-danger" >
				
				</form>

			</div>
		</div>
	</div>
</div>

<?php include "element/footer.php"; ?>