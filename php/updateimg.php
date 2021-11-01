<?php
    session_start();
    include_once "config.php";
    if(isset($_SESSION['unique_id'])){
        if(isset($_FILES['image'])){
            $img_name = $_FILES['image']['name'];
            $temp_name = $_FILES['image']['tmp_name'];
            $time = time();
            $new_image_name = $time . $img_name;
            $user_id = $_SESSION['unique_id'];
            if(move_uploaded_file($temp_name,'images/'. $new_image_name)){
                $sql = mysqli_query($connection ,"UPDATE users SET img= '{$new_image_name}' WHERE unique_id= {$user_id}");
            }
        }else{
            echo 'Please Select an image';
        }
        
    }else{
        header("location: ../chat.php");
    }
?> 