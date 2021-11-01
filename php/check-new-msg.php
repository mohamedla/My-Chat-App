<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing = mysqli_real_escape_string($connection,$_POST['outgoing_id']);
        $incomming = mysqli_real_escape_string($connection,$_POST['incoming_id']);
        $last_msg = mysqli_real_escape_string($connection,$_POST['last-msg']);
        $sql = mysqli_query($connection,"SELECT * FROM messages 
                                WHERE ((outgoing_id ={$outgoing} AND incomming_id = {$incomming})
                                OR (outgoing_id ={$incomming} AND incomming_id = {$outgoing})) AND (msg_id > {$last_msg})");
        if(mysqli_num_rows($sql) > 0){echo 'new';}
    }else{
        header("location: ../signin.php");
    }
?>