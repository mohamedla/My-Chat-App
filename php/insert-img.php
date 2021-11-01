<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing = mysqli_real_escape_string($connection,$_POST['outgoing_id']);
        $incomming = mysqli_real_escape_string($connection,$_POST['incoming_id']);
        $msg_time = date("Y-m-d H:i:s") ;
        
        if(isset($_FILES['img'])){
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
            $img_name = $_FILES['img']['name'];
            $img_type = $_FILES['img']['type'];
            $temp_name = $_FILES['img']['tmp_name'];
            $img_explode = explode('/', $img_type);
            $extention = end($img_explode);
            $time = time();
            $new_image_name = $time . $img_name;
            $type = $img_explode[0];
            
            $sql = mysqli_query($connection,"INSERT INTO  messages (outgoing_id, incomming_id, msg, time, msg_status, msg_type, msg_exten)
                            VALUES ('{$outgoing}','{$incomming}','{$new_image_name}','{$msg_time}','{$msg_status}','{$type}','{$extention}')") 
                            or die();
            move_uploaded_file($temp_name,'images/'. $new_image_name);
        }
    }else{
        header("location: ../signin.php");
    }
?>