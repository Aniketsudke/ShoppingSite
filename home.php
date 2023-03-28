<?php
include 'partials/_dbconnect.php';
include 'partials/_common_function.php';

session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

        $r_no = $_SESSION['user_sno'];
    }
    global $distance_lat;
     global $distance_log ;
    $dist_sql = "SELECT * FROM `location` WHERE user_no = '$r_no'";
    $dist_result = mysqli_query($conn, $dist_sql);
    while($dist_row = mysqli_fetch_assoc($dist_result)){
        $distance_lat =  $dist_row['lat'];
        $distance_log =  $dist_row['lon'];
        // echo $distance_lat ." ";
        // echo $distance_log ." ";
    }

// $distance = twopoints_on_earth();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Awesome Font Style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>E-Commerce</title>
</head>

<body>
    <!-- header contain -->
    <?php
      include 'partials/_header.php';
      ?>
    <!-- Carousel -->
    <div id="carouselExampleSlidesOnly" class="carousel slide " data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/cr-1.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/cr-2.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/cr-3.jpeg" class="d-block w-100" alt="...">
            </div>
            
        </div>
    </div>

    <!-- Product Scroll -->
    <hr>
    <h2 class="mx-0 ml-4">Browse Product</h2>
    <div class="row">

        <div class="col-md-10">
            <!-- Product -->
            <div class="row mx-2">
                <?php   
                    //   global $distance_lat;
                    //   global $distance_log ;         
                    browse_product($distance_lat,$distance_log);
                    browse_category() ;
                    browse_brand();

                ?>
                
            </div>
        </div>
        <div class="col-md-2  p-0">
          <!-- Brand Navbar -->
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-dark">
                  <a href="#" class="nav-link text-light"><h4> Brands</h4> </a>
                </li>
                <?php
                Sidebar_brand();
                
                ?>
            </ul>
            <!-- Category Navbar -->
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-dark">
                  <a href="#" class="nav-link text-light"><h4>Category</h4> </a>
                </li>
                <?php
                Sidebar_category();
                         
                ?>
            </ul>
        </div>
    </div>




    <!-- Footer Contain -->
    <?php
      include 'partials/_footer.php';
      ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>