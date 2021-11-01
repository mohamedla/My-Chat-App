<?php
    session_start();
    include_once "config.php";
    if(isset($_SESSION['unique_id'])){
        $fname  = mysqli_real_escape_string($connection, $_POST['fname']);
        $lname  = mysqli_real_escape_string($connection, $_POST['lname']);
        $user_id = $_SESSION['unique_id'];
        $sql = mysqli_query( $connection,"UPDATE users SET fname= '{$fname}', lname= '{$lname}'
                     WHERE unique_id= {$user_id}");
        echo 'soul';
    }else{
        header("location: ../chat.php");
    }
?> 