<?php
    include '../partials/_dbconnect.php';

    if(isset($_POST['loginBtn'])){
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];

        $sql = "SELECT * FROM `retailer_detail` WHERE r_email = '$inputEmail'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num){
            while($row = mysqli_fetch_assoc($result)){
                if(password_verify($inputPassword , $row['r_password'])){
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['r_sno'] = $row['r_srno'];
                    $_SESSION['r_name'] = $row['r_name'];   
                    $_SESSION['r_aadhar'] = $row['r_aadhar'];
                    $_SESSION['r_mobileNo'] = $row['r_mobileNo'];
                    $_SESSION['r_address'] = $row['r_address'];
                    $_SESSION['r_id'] = $row['r_id'];
                    
                    if($_SESSION['r_aadhar'] == 0 || $_SESSION['r_mobileNo'] == 0  ){
                        header("Location: /shop/admindash/signup2.php");
                    }
                    else{     
                        
                        header("Location: /shop/admindash/home.php");
                    }
            }
            
        }
    }
        else{
            header("Location: /shop/admindash/index.php");
        }
        
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <!-- <script src="https://kit.fontawesome.com/d0893690f1.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="../CSS/starter.css">
    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="icon" type="image/x-icon" href="./logo/logo.png">
</head>

<body>
    <div class="starter-container">
        <div class="form-box ">
            <h1 id="title" class="major-color">Log in</h1>

            <form action="" method="post">
                <p>Email id</p>
                <div class="input-field">
                    <input class="input" type="email" placeholder="Email id" name="inputEmail" required autocomplete="off">
                </div>
                <p>Password</p>
                <div class="input-field">

                    <input class="input" type="password" placeholder="Password" name="inputPassword" required>
                </div>
                <p id="forgot"><a href="#" class="url-text major-color">
                        Forgot Password</a></p>
                <div class="input-field btn-color" id="btn-field">
                    <button class="input white-color" type="submit" id="clickbtn" name="loginBtn">Login</button>
                </div>

            </form>
            <div class="starter-footer">
                <p> Create an account?<a href="signup.php" class="url-text major-color">
                        Sign up</a></p>
            </div>
        </div>

    </div>
</body>

</html>