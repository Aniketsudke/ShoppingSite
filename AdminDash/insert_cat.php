<?php
include '../partials/_dbconnect.php';
if(isset($_POST['cat_submit'])){
  $cat_title = $_POST['cat_title'];
  // Check Duplicates
  $SelectQuery = "SELECT * FROM `category` WHERE  category_name =  '$cat_title'";
  $resultSelect = mysqli_query($conn, $SelectQuery);
  $num = mysqli_num_rows($resultSelect);

  if ($num > 0){
    echo '<div class="alert alert-warning  alert-dismissible fade show" role="alert">
    <strong>Already Present Category</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>';
  }
  else{
    $insertQuery = "INSERT INTO `category` (`category_name`) VALUES ( '$cat_title');";
    $result = mysqli_query($conn, $insertQuery);
    if ($result) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Added Catagory.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>';
      }
  }
}
?>

<form class="form-inline m-3" action="" method="post">

  <label class="sr-only" for="inlineFormInputGroupUsername2">Catagory</label>
  <div class="input-group mb-2 mr-sm-2">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fa-solid fa-list"></i></div>
    </div>
    <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Add Catagory" name="cat_title">
  </div>

  <button type="submit" class="btn btn-outline-dark mb-2" name="cat_submit">Add Catagory</button>
</form>

<div class="container mb-5">
<ul class="list-group">
  <li class="list-group-item list-group-item-dark">All Category</li>
  <?php
      global $conn;
      $select_category = "SELECT *  FROM `category`";
      $result_category = mysqli_query($conn, $select_category);
      while($row_category = mysqli_fetch_assoc($result_category)){
          $category_title = $row_category['category_name'];
          // $category_id = $row_category['category_id'];
          echo '<li class="list-group-item">'. $category_title .'</li>';
      }
  
  ?>
  

</ul>
</div>
