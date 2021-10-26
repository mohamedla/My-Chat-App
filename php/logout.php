<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $user_id = $_SESSION['unique_id'];
        $sql = mysqli_query( $connection,"UPDATE users SET stutus= 'Offline Now' WHERE unique_id= {$user_id}");
        if($sql){
            session_unset();
            session_destroy();
            header("location: ../signin.php");
        }
    }else{
        header("location: ../signin.php");
    }
?>