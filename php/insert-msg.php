<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing = mysqli_real_escape_string($connection,$_POST['outgoing_id']);
        $incomming = mysqli_real_escape_string($connection,$_POST['incoming_id']);
        $message = mysqli_real_escape_string($connection,$_POST['massege']);
        $msg_time = date("Y-m-d H:i:s") ;
        
        if(!empty($message)){
            $sql2 = mysqli_query($connection, "SELECT stutus FROM users WHERE  unique_id='{$incomming}'");
            if(mysqli_num_rows($sql2) > 0){
                $row = mysqli_fetch_assoc($sql2);
                if($row['stutus'] == "Active Now"){
                    $msg_status = "receive";
                }else{
                    $msg_status = "send";
                }
            }else{
                $msg_status = "send";
            }
            $sql = mysqli_query($connection,"INSERT INTO  messages (outgoing_id, incomming_id, msg, time, msg_status)
                            VALUES ('{$outgoing}','{$incomming}','{$message}','{$msg_time}','{$msg_status}')") or die();
        }
    }else{
        header("location: ../signin.php");
    }
?>