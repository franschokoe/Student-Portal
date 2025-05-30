<?php

function check_login($con){
    if (!isset($_SESSION['email']) || $_SESSION['email'] !== true) {
  
    if(isset($_SESSION['email'])){

        $StudentNo = $_SESSION['email'];
        $sql = "SELECT * from studentinfo where email = '$StudentNo' limit 1";

        $result = mysqli_query($con,$sql);

        if($result && mysqli_num_rows($result)> 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
}
    // redirect to login
    header("Location: LoginPage.php");
    die;
    

}
