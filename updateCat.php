<?php include "element/header.php";  ?>
<?php include 'element/navbar.php'; ?>
<?php include "core/Stock.php";  ?>

<div class="container">

<?php 


$stock = new Stock;
$view = $stock->getCatDetails($_GET['item_id']);

if(isset($_POST['update'])){
	
    $stock->updateCat($view[0][0], $_POST['category']);
    header("location: viewCat.php");
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
                        <label for="">Update Category</label>
                        <input name = "category" value = "<?= $view[0]['category'] ?>" class = "border border-primary mt-2 form-control" rows="1" >
					</div>
                	<input type = "submit" name = "update" value = "Update" class = "mt-2 mb-1 btn btn-sm btn-success">
				</form>

			</div>
		</div>
	</div>
</div>

<?php include "element/footer.php"; ?>