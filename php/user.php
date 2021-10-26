<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $user_id = $_SESSION['unique_id'];
        $sql = mysqli_query($connection,"SELECT * FROM users WHERE NOT unique_id = {$user_id}");
        $output = "";
        if(mysqli_num_rows($sql) == 0){
            $output = "No User To Chat With Inviet Your Friend";
        }elseif(mysqli_num_rows($sql) > 0){
            include "usersViewer.php";
        }
        echo $output;
    }else{
        header("location: ../signin.php");
    }
?>