<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing = mysqli_real_escape_string($connection,$_POST['outgoing_id']);
        $incomming = mysqli_real_escape_string($connection,$_POST['incoming_id']);
        $message = mysqli_real_escape_string($connection,$_POST['massege']);
        $msg_time = date("Y-m-d H:i:s") ;
        if(!empty($message)){
            $sql = mysqli_query($connection,"INSERT INTO  messages (outgoing_id, incomming_id, msg, time)
                                             VALUES ('{$outgoing}','{$incomming}','{$message}','{$msg_time}')") or die();
        }
    }else{
        header("location: ../signin.php");
    }
?>