<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $searchCond = mysqli_real_escape_string($connection,$_POST['searchCond']);
        $user_id = $_SESSION['unique_id'];
        $sql = mysqli_query($connection,"SELECT * FROM users 
                        WHERE NOT unique_id = {$user_id} 
                        AND (fname LIKE '%{$searchCond}%' or lname LIKE '%{$searchCond}%')");
        $output = "";
        if(mysqli_num_rows($sql)>0){
            include "usersViewer.php";
        }else{
            $output = "No Users Found";
        }
        echo $output;
    }else{
        header("location: ../signin.php");
    }
?>