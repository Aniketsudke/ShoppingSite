<?php
include './partials/_dbconnect.php';

function browse_product($distance_lat,$distance_log){

            global $conn;
            if(!isset($_GET['category'])){
                if(!isset($_GET['brand'])){
                    $select_product = "SELECT * FROM `produt_detail` ORDER BY RAND() LIMIT 0,9";
                    $select_query = mysqli_query($conn,$select_product);
                    while($row_product = mysqli_fetch_assoc($select_query)){
                        $browse_title = $row_product['product_name'];
                        $browse_description = $row_product['product_description'];
                        $browse_img = $row_product['product_img'];
                        $retailer_getId = $row_product['retailer_id'];

                         $getLocation = "SELECT * FROM `retailer_detail` WHERE r_id = $retailer_getId";
                         $getLocation_query = mysqli_query($conn,$getLocation);
                         while($row_getLocation = mysqli_fetch_assoc($getLocation_query)){
                            $getRetailer_lat = $row_getLocation['r_lat'];
                            $getRetailer_log = $row_getLocation['r_log'];
                        
                            $distance = twopoints_on_earth($distance_lat,$distance_log,$getRetailer_lat,$getRetailer_log);
                            // echo $distance;
                            if($distance < 9.32057){
                                echo '<div class="col-md-4 mb-2">
                        <div class="card my-2">
                            <img src="./AdminDash/image/'.$browse_img .'" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"> '.$browse_title.'</h5>
                                <p class="card-text">'.substr($browse_description,0,90).'...</p>
                                <a href="#" class="btn btn-outline-dark">Add to Cart</a>
                                <a href="#" class="btn btn-outline-dark">View More</a>
                            </div>
                        </div>
                    </div>';
                            }
                            else{
                                echo '<h1> No Product Found </h1>';
                            }

                         }

                        
                    }
                }
            }
            }

            function browse_category(){
            global $conn;
            if(isset($_GET['category'])){
                    $category_id = $_GET['category'];
                    $select_product = "SELECT * FROM `produt_detail` WHERE product_cat_id =$category_id";
                    $select_query = mysqli_query($conn,$select_product);
                    $count_item = mysqli_num_rows($select_query);
                    
                    if($count_item == 0){
                        echo '<h4 class=" text-danger ml-4"> No result found....</h4>';
                    }
                    while($row_product = mysqli_fetch_assoc($select_query)){
                        $browse_title = $row_product['product_name'];
                        $browse_description = $row_product['product_description'];
                        $browse_img = $row_product['product_img'];
                        

                        echo '<div class="col-md-4 mb-2">
                        <div class="card my-2">
                            <img src="./AdminDash/image/'.$browse_img .'" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"> '.$browse_title.'</h5>
                                <p class="card-text">'.substr($browse_description,0,90).'...</p>
                                <a href="#" class="btn btn-outline-dark">Add to Cart</a>
                                <a href="#" class="btn btn-outline-dark">View More</a>
                            </div>
                        </div>
                    </div>';
                    }
                }
            }
            function browse_brand(){
                global $conn;
                if(isset($_GET['brand'])){
                        $brand_id = $_GET['brand'];
                        $select_product = "SELECT * FROM `produt_detail` WHERE product_brand_id =$brand_id";
                        $select_query = mysqli_query($conn,$select_product);
                        $count_item = mysqli_num_rows($select_query);
                        
                        if($count_item == 0){
                            echo '<h4 class=" text-danger ml-4"> No result found....</h4>';
                        }
                        while($row_product = mysqli_fetch_assoc($select_query)){
                            $browse_title = $row_product['product_name'];
                            $browse_description = $row_product['product_description'];
                            $browse_img = $row_product['product_img'];
                            
    
                            echo '<div class="col-md-4 mb-2">
                            <div class="card my-2">
                                <img src="./AdminDash/image/'.$browse_img .'" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"> '.$browse_title.'</h5>
                                    <p class="card-text">'.substr($browse_description,0,90).'...</p>
                                    <a href="#" class="btn btn-outline-dark">Add to Cart</a>
                                    <a href="#" class="btn btn-outline-dark">View More</a>
                                </div>
                            </div>
                        </div>';
                        }
                    }
                }
            


        function Sidebar_brand(){
            global $conn;
                $select_brand = "SELECT *  FROM `brand`";
                $result_brand = mysqli_query($conn, $select_brand);
                while($row_brand = mysqli_fetch_assoc($result_brand)){
                    $brand_title = $row_brand['brand_name'];
                    $brand_id = $row_brand['brand_id'];
                    echo '<li class="nav-item ">
                    <a href="home.php?brand='.$brand_id.'" class="nav-link text-dark"> ' . $brand_title . ' </a>
                  </li>';
                }
        }

        function Sidebar_category(){
            global $conn;
                $select_category = "SELECT *  FROM `category`";
                $result_category = mysqli_query($conn, $select_category);
                while($row_category = mysqli_fetch_assoc($result_category)){
                    $category_title = $row_category['category_name'];
                    $category_id = $row_category['category_id'];
                    echo '<li class="nav-item ">
                    <a href="home.php?category='.$category_id.'" class="nav-link text-dark"> ' . $category_title . ' </a>
                  </li>';
                }
        }


        // Find the Distance between two lat and log.
        function twopoints_on_earth($latitudeFrom, $longitudeFrom,
									$latitudeTo, $longitudeTo)
	{
		$long1 = deg2rad($longitudeFrom);
		$long2 = deg2rad($longitudeTo);
		$lat1 = deg2rad($latitudeFrom);
		$lat2 = deg2rad($latitudeTo);
			
		//Haversine Formula
		$dlong = $long2 - $long1;
		$dlati = $lat2 - $lat1;
			
		$val = pow(sin($dlati/2),2)+cos($lat1)*cos($lat2)*pow(sin($dlong/2),2);
			
		$res = 2 * asin(sqrt($val));
			
		$radius = 3958.756;
			
		return ($res*$radius);
	}

?>