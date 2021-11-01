<?php
    session_start();
    include_once "config.php";
    if(isset($_SESSION['unique_id'])){
        $password  = mysqli_real_escape_string($connection, $_POST['pass']);
        $user_id = $_SESSION['unique_id'];
        $password = base64_encode($password);
        $sql = mysqli_query( $connection,"UPDATE users SET password= '{$password}' WHERE unique_id= {$user_id}");
        echo 'soul';
    }else{
        header("location: ../chat.php");
    }
?> 