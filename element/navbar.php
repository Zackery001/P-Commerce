<div class="container">
    <div class="row">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <form class="d-flex">
                    <div class = "text-center">

                        <a class="btn btn-primary btn-sm ms-3" href = "incoming.php">Incoming</a>
                        
                        <div class="btn-group">
                            <a href="viewItem.php" type="button" class="btn btn-primary btn-sm">Stock</a>
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="viewCat.php">Category</a></li>
                                <li><a class="dropdown-item" href="viewItem.php">Item</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <a href="insertItem.php" type="button" class="btn btn-danger btn-sm">Add</a>
                            <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="insertCat.php">Category</a></li>
                                <li><a class="dropdown-item" href="insertItem.php">Item</a></li>
                            </ul>
                        </div>
                    
                    </div>
                </form>
            </div>
        </nav>
    </div>
</div>
