<?php
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $user_id = $_SESSION['unique_id'];
        $sql = mysqli_query( $connection,"UPDATE users SET stutus= 'Active Now' WHERE unique_id= {$user_id}");
    }else{
        header("location: signin.php");
    }
?>