<?php

session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

   $user_no = $_SESSION['user_sno'];

}
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
include 'partials/_dbconnect.php';
$loc = file_get_contents(filename:"http://ip-api.com/json/$ip");
$store_loc = json_decode($loc);
$latitude = $store_loc->lat;
$longitude = $store_loc->lon;
$country = $store_loc->country;
$regionName = $store_loc->regionName;
$zip = $store_loc->zip;

$loc_sql = "SELECT * FROM `location` WHERE user_no = '$user_no'";
        $loc_sel_result = mysqli_query($conn, $loc_sql);
        $num = mysqli_num_rows($loc_sel_result);
        if($num){
            while($row = mysqli_fetch_assoc($loc_sel_result)){
                $update_loc = "UPDATE `location` SET `lat` = '$latitude', `lon` = '$longitude', `country` = '$country', `regionName` = '$regionName', `zip` = '$zip' WHERE `location`.`user_no` = $user_no";
                $update_query = mysqli_query($conn,$update_loc);
                header("Location: /shop/home.php");
            }
        }
        else{
            $loc_query = "INSERT INTO `location` ( `lat`, `lon`,`country`,`regionName`,`zip`, `user_no`, `timestamp`) VALUES ( '$latitude', '$longitude','$country','$regionName', '$zip','$user_no' ,current_timestamp())";
            $loc_result = mysqli_query($conn,$loc_query);
            if($loc_result){
                
                header("Location: /shop/home.php");
            }
        }







?>