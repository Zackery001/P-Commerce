<?php include "element/header.php";  ?>
<?php include 'element/navbar.php'; ?>
<?php include "core/Stock.php";  ?>

<div class="container">
	<div class="row">
		<?php include "element/home.php";  ?>

		<h1>This the insert category page where new data(categories) are inserted</h1>

		<?php 
		
		if(isset($_POST['insert'])){

			$stock = new Stock;
			$stockCount = $stock->duplicateCategory($_POST['category']);
			if (count($stockCount) > 0){
				echo "<p class='alert alert-warning'>This category already exists</p>";
			}else{
				$stock->addCategory($_POST['category']);
				echo "<p class='alert alert-success'>
					Your category has been successfully inserted!</p>";
			}
				
		}
		
		?>

    	<div class="container mt-3">
			<div class="border border-primary row p-2 col-8 offset-2 card">
				
				<form action="" method="POST">					
					<p>Insert a category :</p>
					<textarea name = "category" id = "textarea" class = "border border-primary mt-2 form-control" rows="1" required></textarea>
                	<input type = "submit" name = "insert" value = "Insert" class = "mt-2 mb-1 btn btn-sm btn-success">
				</form>

			</div>
		</div>
	</div>
</div>

<?php include "element/footer.php"; ?>
