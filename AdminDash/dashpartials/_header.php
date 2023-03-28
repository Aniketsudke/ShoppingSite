<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="../AdminDash/index.php">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav mr-auto">
            <a class="nav-link active" href="../AdminDash/home.php">Home </a>
            <a class="nav-link" href="#">Orders</a>
            <a class="nav-link" href="#">Inventory</a>
            <a class="nav-link" href="home.php?insert_item">Insert Items</a>
            <a class="nav-link" href="home.php?catagory">Catagory</a>
            <a class="nav-link" href="home.php?brand">Brand</a>
            <a class="nav-link" href="#">Payments</a>
            <a class="nav-link" href="logout.php">Log Out</a>

        </div>
        <span class="navbar-text">
            <button class="btn btn-outline-light my-2 my-sm-0 mx-1" type="submit">Login</button>
            <button class="btn btn-outline-light my-2 my-sm-0 mx-1" type="submit">Sign up</button>

            <div class="btn-group dropleft ">
                <button type="button" class="btn  m-0 p-0" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa-solid fa-user" ></i>
                </button>
                <div class="dropdown-menu  bg-dark my-4">
                    <a class="dropdown-item  text-white" href="#">Action</a>
                    <a class="dropdown-item text-white" href="#">Another action</a>
                    <a class="dropdown-item text-white" href="#">Something else here</a>
                </div>
            </div>

        </span>
    </div>
</nav>