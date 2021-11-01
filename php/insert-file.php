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
            $file_name = $_FILES['file']['name'];
            $file_type = $_FILES['file']['type'];
            $temp_name = $_FILES['file']['tmp_name'];
            $file_explode = explode('/', $file_type);
            $extention = end($file_explode);
            $time = time();
            $new_file_name = $time . $file_name;
            $type = $file_explode[0];
            $sql = mysqli_query($connection,"INSERT INTO  messages (outgoing_id, incomming_id, msg, time, msg_status, msg_type, msg_exten)
                            VALUES ('{$outgoing}','{$incomming}','{$new_file_name}','{$msg_time}','{$msg_status}','{$type}','{$extention}')") 
                            or die();
            switch ($type) {
                case 'image':
                    move_uploaded_file($temp_name,'images/'. $new_file_name);
                    break;
                case 'video':
                    move_uploaded_file($temp_name,'videos/'. $new_file_name);
                    break;
                case 'audio':
                    move_uploaded_file($temp_name,'audios/'. $new_file_name);
                    break;
                default:
                    move_uploaded_file($temp_name,'files/'. $new_file_name);
                    break;
            }
            
        }
    }else{
        header("location: ../signin.php");
    }
?>