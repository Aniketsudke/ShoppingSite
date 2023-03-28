<?php
    include '../partials/_dbconnect.php';
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

        $r_no = $_SESSION['r_sno'];

}

//Location Fetching Function
function get_IP_address()
{
    foreach (array('HTTP_CLIENT_IP',
                   'HTTP_X_FORWARDED_FOR',
                   'HTTP_X_FORWARDED',
                   'HTTP_X_CLUSTER_CLIENT_IP',
                   'HTTP_FORWARDED_FOR',
                   'HTTP_FORWARDED',
                   'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $IPaddress){
                $IPaddress = trim($IPaddress); // Just to be safe

                if (filter_var($IPaddress,
                               FILTER_VALIDATE_IP,
                               FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)
                    !== false) {

                    return $IPaddress;
                }
            }
        }
    }
}
$ip = get_IP_address();
$loc = file_get_contents(filename:"http://ip-api.com/json/$ip");
$store_loc = json_decode($loc);
$latitude = $store_loc->lat;
$longitude = $store_loc->lon;

    $status = true;
    if(isset($_POST['signUpBtn'])){
        $inputShopName = $_POST['inputShopName'];
        $inputAddress = $_POST['inputAddress'];
        $inputMobile = $_POST['inputMobile'];
        $inputAadhar = $_POST['inputAadhar'];
       echo '<script>alert("Can we take your current location")</script>';
        if($inputShopName != '' || $inputAddress  != '' || $inputMobile != '' || $inputAadhar != ''){
            $sqlQ = "UPDATE `retailer_detail` SET `r_shopName` = '$inputShopName', `r_aadhar` =  $inputAadhar,`r_mobileNo`= $inputMobile ,`r_address`= '$inputAddress',`r_lat` = $latitude  ,`r_log`= $longitude  WHERE `retailer_detail`.`r_srno` = $r_no";
            $r_result = mysqli_query($conn,$sqlQ);
            header("location: /shop/admindash/home.php");
        }
            
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="../CSS/starter.css">
    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="icon" type="image/x-icon" href="./logo/logo.png">
</head>
<body>
    <div class="starter-container">
        <div class="form-box ">
            <h1 id="title" class="major-color">Shop Detail</h1>
            
            <form action="#" method="post">
                <p>Shop Name</p>
                <div class="input-field">
                    <input  class="input"type="text" placeholder="Shop Name" autocomplete="off" maxlength="50" name="inputShopName" required>  
                </div>
                <p>Shop Address</p>
                <div class="input-field">
                    <input  class="input"type="text" placeholder="Shop Address" name="inputAddress" autocomplete="off" required>
                </div>
                <p>Mobile Number</p>
                <div class="input-field">
                    <input  class="input" type="text" placeholder="Mobile Number" name="inputMobile" required>
                </div>
                <p>Aadhar Number</p>
                <div class="input-field">
                    
                    <input  class="input"type="text" placeholder="Aadhar Number" name="inputAadhar" required>
                </div>
                <div class="input-field btn-color" id="btn-field">
                    <button  class="input white-color"type="submit" id="clickbtn" name="signUpBtn">Sign Up</button>
                </div>
               
            </form>
            <!-- <div class="starter-footer">
                <p> Already have an account?<a href="index.php" class="url-text major-color">
                    Log in</a></p>
            </div> -->
        </div>
        
    </div>
</body>
</html>

























<!-- Error : Mobile Number is not save inside the Database  -->