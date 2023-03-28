<?php
    include '../partials/_dbconnect.php';      
            $r_id = $_SESSION['r_id'];

    $status = $statusMsg = '';
if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_keyword = $_POST['product_keyword'];
    
    $product_category = $_POST['product_category'];
    $product_brand =$_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_qunatity = $_POST['product_qunatity'];
    $status = 'true';
    $product_img = $_FILES['product_img1']['name'];
    $product_temp_img = $_FILES['product_img1']['tmp_name'];
    
    move_uploaded_file($product_temp_img,"./image/$product_img");

    $insert_query = "INSERT INTO `produt_detail` ( `product_name`, `product_description`, `product_keyword`, `product_img`, `product_cat_id`, `product_brand_id`,`product_quantity`,`retailer_id`, `product_price`, `status`, `timestamp`) VALUES ( '$product_name', '$product_description', '$product_keyword', '$product_img', '$product_category', '$product_brand', '$product_qunatity',' $r_id','$product_price', '$status', current_timestamp())";
    $result = mysqli_query($conn,$insert_query);
    if($result){
        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Addede</strong> Your Product Added Successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }


}
?>

<div class="container my-4">
    <h2 class="text-center">Insert Product</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Product Name -->
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" required autocomplete="off">
        </div>
        <!-- Product Description -->
        <div class="form-group">
            <label for="product_description">Product Description</label>
            <input type="text" class="form-control" id="product_description" name="product_description" required
                autocomplete="off">
        </div>
        <!-- Product Keyword -->
        <div class="form-group">
            <label for="product_keyword">Product Keyword</label>
            <input type="text" class="form-control" id="product_keyword" name="product_keyword" required
                autocomplete="off">
        </div>
        <!-- Product Image -->
        <div class="form-group">
            <label for="product_img">Product Image</label>
            <input type="file" class="form-control" id="product_img" name="product_img1">
        </div>
        <!-- Product Category -->
        <div class="form-group">
            <select class="form-control" name = "product_category" >
                <option> Select Category</option>
                <?php
                include '../partials/_dbconnect.php';
                $select_category = "SELECT *  FROM `category`";
                $result_category = mysqli_query($conn, $select_category);
                while($row_category = mysqli_fetch_assoc($result_category)){
                    $category_title = $row_category['category_name'];
                    $category_id = $row_category['category_id'];
                    echo '<option value="'.$category_id.'"> '.$category_title.'</option>';
                }
                ?>
            </select>
        </div>
        <!-- Product Brand -->
        <div class="form-group">
            <select class="form-control" name="product_brand">
                <option> Select Brand</option>
                <?php
                $select_brand = "SELECT *  FROM `brand`";
                $result_brand = mysqli_query($conn, $select_brand);
                while($row_brand = mysqli_fetch_assoc($result_brand)){
                    $brand_title = $row_brand['brand_name'];
                    $brand_id = $row_brand['brand_id'];
                    echo '<option value ="'.$brand_id.'"> '. $brand_title.'</option>';
                }
                
                ?>
             </select>  
        </div>

        <!-- Product Quantity -->
        <div class="form-group">
            <label for="product_qunatity">Product Qunatity</label>
            <input type="text" class="form-control" id="product_qunatity" name="product_qunatity" required
                autocomplete="off">
        </div>
        <!-- Product Price -->
        <div class="form-group">
            <label for="product_price">Product Price</label>
            <input type="text" class="form-control" id="product_price" name="product_price" required
                autocomplete="off">
        </div>

        <!--Submit Button -->
        <button type="submit" class="btn btn-dark" name="submit">Submit</button>
    </form>
</div>