<?php
    include '../partials/_dbconnect.php';

    $status = true;
    if(isset($_POST['signUpBtn'])){
        $inputName = $_POST['inputName'];
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];
        $inputCPassword = $_POST['inputCPassword'];
        
        if($inputName != '' || $inputEmail  != '' || $inputPassword != '' || $inputCPassword != ''){
            $user_select = "SELECT * FROM `retailer_detail` WHERE r_email = '$inputEmail'";
            $select_query = mysqli_query($conn,$user_select);
            $count_user = mysqli_num_rows($select_query);
            if($count_user >0 ){
                $status = "Username Already Exists";
            }
            else{
                if($inputPassword == $inputCPassword){
                    $hash = password_hash($inputPassword, PASSWORD_DEFAULT);
                    $r_id = rand(999999, 111111);
                    $user_query = "INSERT INTO `retailer_detail` ( `r_id`, `r_name`, `r_email`, `r_password`, `r_shopName`, `r_aadhar`, `r_mobileNo`, `r_address`, `r_lat`, `r_log`, `timestamp`) VALUES ( '$r_id', ' $inputName', '$inputEmail', '$hash', '0', '0', '0', '0', '0', '0',current_timestamp())";
                    $user_result = mysqli_query($conn,$user_query);
                    if($user_result){
                        header("Location: /shop/admindash/index.php");
                        $status = 'Submitted Successfully';
                    }
                }
                else{
                    $status = 'Password does not match';
                }
            }
        }
        else{
            $status = 'Fill all details.';
        }
        echo '<script>alert("'.$status.'")</script>';
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
            <h1 id="title" class="major-color">Sign up</h1>
            
            <form action="#" method="post">
                <p>Name</p>
                <div class="input-field">
                    <input  class="input"type="text" placeholder="Name" autocomplete="off" maxlength="50" name="inputName" required>  
                </div>
                <p>Email id</p>
                <div class="input-field">
                    <input  class="input"type="email" placeholder="Email id" name="inputEmail" autocomplete="off" required>
                </div>
                <p>Password</p>
                <div class="input-field">
                    
                    <input  class="input"type="password" placeholder="Password" name="inputPassword" required>
                </div>
                <p>Confirm Password</p>
                <div class="input-field">
                    <input  class="input"type="password" placeholder="Confirm Password" name="inputCPassword" required>
                </div>
                <div class="input-field btn-color" id="btn-field">
                    <button  class="input white-color"type="submit" id="clickbtn" name="signUpBtn">Sign Up</button>
                </div>
               
            </form>
            <div class="starter-footer">
                <p> Already have an account?<a href="index.php" class="url-text major-color">
                    Log in</a></p>
            </div>
        </div>
        
    </div>
</body>
</html>