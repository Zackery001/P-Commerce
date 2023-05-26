<?php include "element/header.php";  ?>
<?php include 'element/navbar.php'; ?>
<?php include "core/Stock.php";  ?>
<?php

if(isset($_POST['add'])){
    $stock = new Stock;
    
    if(isset($_POST['user']) && isset($_POST['number'])){

        $number = $stock->verifyNum($_POST['number']);
        $userCount = $stock->getAccountsId($_POST['user']);
        if($number == true){
            if (count($userCount) > 0){
			    echo "<p class='alert alert-warning'>This item already exists</p>";
            }else{

                $stock->addAccount($_POST['user'], $_POST['number']);
                $user = $stock->lastAccount();
                $stock->insertDue($user[0]['id']);

                echo "<p class='alert alert-success'>
                    Your item has been successfully inserted!</p>";
            }   

            // echo "<pre>";
            // print_r($user);
            // echo "</pre>";

        }else{

            echo"<p class='alert alert-warning'>
                Invalid Number Provided.</p>";
        }

    }else{

        echo"<p class='alert alert-warning'>
            Invalid Request. Adequate information not provided</p>";
    }
}

?>

<div class="container">
    <div class="row">
        <?php include "element/home.php";  ?>

        <h3>
            <a class="btn btn-sm btn-primary mt-2" href = "user.php" >Refresh</a>
        </h3>
        <form action="" method="POST">

            <div class = "form-control mt-2">
                <label>Username :</label>
                <input class = "form-control" type="text" name = "user" required>
            </div>
            <div class = "form-control mt-2">    
                <label >Phone Number :</label>
                <input class = "form-control" type="text" name = "number" required>
            </div>
            <div class = "mt-4" ><a class = "btn btn-success btn-sm" href="accSelect.php">Check User</a></div>
            <div class = "d-grid gap-2 col-6 mx-auto">
                <input class = "btn btn-primary btn-success mt-5" type="submit" name = "add" value = "Add">
            </div>

        </form>
    </div>
</div>

<?php include "element/footer.php";  ?>