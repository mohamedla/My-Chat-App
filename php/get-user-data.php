<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $incomming = mysqli_real_escape_string($connection,$_POST['incoming_id']);
        $output = "";
        $sql = mysqli_query($connection, "SELECT * FROM users WHERE unique_id = '{$incomming}'");
        if(mysqli_num_rows($sql)>0){
            $row = mysqli_fetch_assoc($sql);
        }
        $output = "<span>".$row['fname'] . " " . $row['lname']."</span>
                    <p>".$row['stutus']."</p>";

        echo $output;
    }else{
        header("location: ../signin.php");
    }
?>